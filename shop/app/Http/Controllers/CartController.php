<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Shoe;
use App\Models\Order;

//use Illuminate\Support\Facades\Session;

use Stripe\Stripe;
use Stripe\Checkout\Session as SessionStripe;

class CartController extends Controller
{
    /**
     * Verifica si el usuario está autenticado.
     *
     * @return bool
     * @private
     */
    private function isUserAuthenticated()
    {
        return auth()->check();
    }

    /**
     * Muestra la vista del carrito con los productos agregados.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (auth()->check()) {
            $this->importLocalCart();
            $cartItems = Cart::where('user_id', auth()->id())->with('shoe')->get();
        } else {
            $cartItems = session()->get('cart', []);
        }

        return view('cart.index', compact('cartItems'));
    }

    /**
     * Obtiene la cantidad total de productos en el carrito.
     *
     * @return int
     */
    public function getCartItemCount()
    {
        if (auth()->check()) {
            return Cart::where('user_id', auth()->id())->sum('quantity');
        } else {
            $cart = session()->get('cart', []);
            return array_sum(array_column($cart, 'quantity'));
        }
    }

    /**
     * Agrega un zapato al carrito.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addToCart(Request $request)
    {
        Log::info($request);
        $shoe = Shoe::findOrFail($request->product_id);
        $quantity = $request->quantity ?? 1;
        
        // Verificar si hay suficiente stock
        if ($shoe->stock < $quantity) {
            // Devolver mensaje de error si no hay suficiente stock
            return response()->json([
                'message' => "Este producto está agotado.",
            ], 400); // Código de error 400 para indicar una solicitud incorrecta
        }
    
        // Si el usuario está autenticado
        if ($this->isUserAuthenticated()) {
            $cartItem = Cart::where('user_id', auth()->id())->where('shoe_id', $shoe->id)->first();
    
            if ($cartItem) {
                // Verificar si la cantidad total supera el stock disponible
                if ($shoe->stock < ($cartItem->quantity + $quantity)) {
                    return response()->json([
                        'message' => "Este producto está agotado.",
                    ], 400);
                }
    
                // Si hay stock suficiente, actualizamos la cantidad en el carrito
                $cartItem->quantity += $quantity;
                $cartItem->save();
    
                // Producto añadido correctamente
                return response()->json(['message' => 'Zapato agregado al carrito'], 200);
            } else {
                // Si el producto no está en el carrito, lo agregamos con la cantidad
                Cart::create([
                    'user_id' => auth()->id(),
                    'shoe_id' => $shoe->id,
                    'quantity' => $quantity,
                ]);
    
                // Producto añadido correctamente
                return response()->json(['message' => 'Zapato agregado al carrito'], 200);
            }
        } else {
            // Si el usuario no está autenticado, trabajamos con la sesión
            $cart = session()->get('cart', []);
            if (isset($cart[$shoe->id])) {
                // Verificar si la cantidad total supera el stock disponible
                if ($shoe->stock < ($cart[$shoe->id]['quantity'] + $quantity)) {
                    return response()->json([
                        'message' => "Este producto está agotado.",
                    ], 400);
                }
    
                // Si hay stock suficiente, actualizamos la cantidad en el carrito
                $cart[$shoe->id]['quantity'] += $quantity;
            } else {
                // Si el producto no está en el carrito, lo agregamos con la cantidad
                $cart[$shoe->id] = [
                    "name" => $shoe->brand->name . ' ' . $shoe->model->name,
                    "price" => $shoe->price,
                    "quantity" => $quantity,
                    "image" => $shoe->image
                ];
            }
            session()->put('cart', $cart);
    
            // Producto añadido correctamente
            return response()->json(['message' => 'Zapato agregado al carrito'], 200);
        }
    }
    
    







    /**
     * Elimina un zapato del carrito.
     *
     * @param int $id ID del zapato
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeFromCart($id)
    {
        if (auth()->check()) {
            Cart::where('user_id', auth()->id())->where('shoe_id', $id)->delete();
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);
            }
        }

        return redirect()->route('cart.index')->with('success', 'Zapato eliminado del carrito.');
    }

    /**
     * Vacía completamente el carrito del usuario.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clearCart()
    {
        if (auth()->check()) {
            Cart::where('user_id', auth()->id())->delete();
        } else {
            session()->forget('cart');
        }

        return redirect()->route('cart.index')->with('success', 'Carrito vaciado correctamente.');
    }

    /**
     * Actualiza la cantidad de un zapato en el carrito (aumentar o disminuir).
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateQuantity(Request $request)
    {
        $shoeId = $request->product_id;
        $action = $request->action;

        if ($this->isUserAuthenticated()) {
            $cartItem = Cart::where('user_id', auth()->id())->where('shoe_id', $shoeId)->first();

            $isIncreasing = $action === 'increase';
            $isDecreasing = $action === 'decrease' && $cartItem->quantity > 1;

            if ($cartItem) {
                if ($isIncreasing) {
                    $cartItem->quantity += 1;
                } elseif ($isDecreasing) {
                    $cartItem->quantity -= 1;
                }
                $cartItem->save();
            }
        } else {
            $cart = session()->get('cart', []);

            if (isset($cart[$shoeId])) {
                $isIncreasing = $action === 'increase';
                $isDecreasing = $action === 'decrease' && $cart[$shoeId]['quantity'] > 1;

                if ($isIncreasing) {
                    $cart[$shoeId]['quantity'] += 1;
                } elseif ($isDecreasing) {
                    $cart[$shoeId]['quantity'] -= 1;
                }

                session()->put('cart', $cart);
            }
        }

        return response()->json(['success' => true]);
    }

    /**
     * Importa los productos del carrito local (en sesión) al carrito del usuario autenticado en la base de datos.
     *
     * @return void
     * @private
     */
    private function importLocalCart()
    {
        $localCart = session()->get('cart', []);

        if (!empty($localCart)) {
            foreach ($localCart as $key => $item) {
                $shoe = Shoe::find($key);
                if ($shoe) {
                    $cartItem = Cart::where('user_id', auth()->id())->where('shoe_id', $shoe->id)->first();

                    if ($cartItem) {
                        $cartItem->quantity += $item['quantity'];
                        $cartItem->save();
                    } else {
                        Cart::create([
                            'user_id' => auth()->id(),
                            'shoe_id' => $shoe->id,
                            'quantity' => $item['quantity'],
                        ]);
                    }
                }
            }

            session()->forget('cart');
            session()->flash('success', 'Se ha importado tu carrito local.');
        }
    }

    public function checkout(Request $request)
    {
        $user = auth()->user();
        $cartItems = Cart::where('user_id', auth()->id())->with('shoe.brand', 'shoe.model')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Tu carrito está vacío.');
        }

        return view('cart.review', compact('user', 'cartItems'));
    }

    public function startPayment(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $cartItems = Cart::where('user_id', auth()->id())->with('shoe.brand', 'shoe.model')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Tu carrito está vacío.');
        }

        // Verificamos si hay suficiente stock
        foreach ($cartItems as $item) {
            if ($item->quantity > $item->shoe->stock) {
                return redirect()->route('cart.index')->with('error', "No hay suficiente stock para {$item->shoe->brand->name} {$item->shoe->model->name}.");
            }
        }

        $lineItems = [];

        foreach ($cartItems as $item) {
            $name = ($item->shoe->brand->name ?? '') . ' ' . ($item->shoe->model->name ?? 'Zapato desconocido');
            $basePrice = $item->shoe->price ?? 0;
            $discount = $item->shoe->discount ?? 0;

            $finalPrice = $discount > 0 ? round($basePrice * (1 - $discount / 100), 2) : $basePrice;

            $lineItems[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => ['name' => $name],
                    'unit_amount' => intval($finalPrice * 100), // Stripe requiere céntimos
                ],
                'quantity' => $item->quantity,
            ];
        }

        try {
            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card', 'paypal'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => route('payment.success'),
                'cancel_url' => route('cart.index'),
            ]);

            return redirect($session->url);
        } catch (\Exception $e) {
            Log::error('Stripe error: ' . $e->getMessage());
            return redirect()->route('cart.index')->with('error', 'Error al crear la sesión de pago.');
        }
    }

    public function saveShipping(Request $request)
    {
        $request->validate([
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip_code' => 'required|string|max:20',
            'country' => 'required|string|max:255',
        ]);

        $user = auth()->user();
        $user->update([
            'street' => $request->street,
            'number' => $request->number,
            'city' => $request->city,
            'state' => $request->state,
            'zip_code' => $request->zip_code,
            'country' => $request->country,
        ]);

        return redirect()->route('cart.checkout');
    }

    public function success()
    {
        $cartItems = Cart::where('user_id', auth()->id())->with('shoe')->get();

        foreach ($cartItems as $item) {
            if ($item->shoe && $item->shoe->stock >= $item->quantity) {
                $item->shoe->stock -= $item->quantity;
                $item->shoe->save();
            }
        }

        // Crear el pedido en la base de datos
        $order = Order::create([
            'user_id' => auth()->id(),
            'total' => ($item->shoe->price * $item->quantity), // Método para calcular el total
            'status' => 'completado', // O el estado que desees
        ]);

        /*
        // Asociamos los productos del carrito con el pedido
        foreach ($cartItems as $item) {
            $order->products()->attach($item->shoe->id, [
                'quantity' => $item->quantity,
                'size' => $item->size ?? null, // Si tienes tamaño
                'color' => $item->color ?? null, // Si tienes color
            ]);
        }
        */

        // Vaciar el carrito
        Cart::where('user_id', auth()->id())->delete();

        return view('cart.success')->with('success', '¡Pago completado!');
    }
}
