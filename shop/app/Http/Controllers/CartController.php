<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Shoe;
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

        if ($this->isUserAuthenticated()) {
            $cartItem = Cart::where('user_id', auth()->id())->where('shoe_id', $shoe->id)->first();
        
            if ($cartItem) {
                $cartItem->quantity += $quantity;
                $cartItem->save();
            } else {
                Cart::create([
                    'user_id' => auth()->id(),
                    'shoe_id' => $shoe->id,
                    'quantity' => $quantity,
                ]);
            }
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$shoe->id])) {
                $cart[$shoe->id]['quantity'] += $quantity;
            } else {
                $cart[$shoe->id] = [
                    "name" => $shoe->brand->name . ' ' . $shoe->model->name,
                    "price" => $shoe->price,
                    "quantity" => $quantity,
                    "image" => $shoe->image
                ];
            }
            session()->put('cart', $cart);
        }

        return response()->json(['message' => 'Zapato agregado al carrito']);
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

    // Obtener los productos del carrito
    $cartItems = Cart::where('user_id', auth()->id())->with('shoe.brand', 'shoe.model')->get();

    if ($cartItems->isEmpty()) {
        return redirect()->route('cart.index')->with('error', 'Tu carrito está vacío.');
    }

    // Crear los items para la sesión de pago
    $lineItems = [];

    foreach ($cartItems as $item) {
        $name = ($item->shoe->brand->name ?? '') . ' ' . ($item->shoe->model->name ?? 'Zapato desconocido');
        $basePrice = $item->shoe->price ?? 0;
        $discount = $item->shoe->discount ?? 0;

        $finalPrice = $discount > 0
            ? round($basePrice * (1 - $discount / 100), 2)
            : $basePrice;

        $lineItems[] = [
            'price_data' => [
                'currency' => 'eur',
                'product_data' => [
                    'name' => $name,
                ],
                'unit_amount' => intval($finalPrice * 100), // Stripe requiere céntimos
            ],
            'quantity' => $item->quantity,
        ];
    }

    try {
        // Crear la sesión de pago de Stripe con PayPal
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
        return redirect()->route('cart.index')->with('error', 'Error al crear la sesión de pago: ' . $e->getMessage());
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

    
    



   
       // Página de éxito
       
       public function success()
       {
           return view('cart.success');
       }
    

    /*
    public function success(Request $request)
{
    // Si el usuario está autenticado, vaciar el carrito en la base de datos
    if (auth()->check()) {
        $userCart = Cart::where('user_id', auth()->id())->first();

        // Eliminar todos los productos del carrito del usuario (de la tabla intermedia cart_shoe)
        if ($userCart) {
            $userCart->shoe()->detach();  // Elimina los productos asociados con el carrito
        }
    }

    // Otras acciones que necesites (por ejemplo, marcar el pedido como pagado en la base de datos)
    return view('cart.success');
}

       */





}
