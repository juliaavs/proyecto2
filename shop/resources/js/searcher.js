class Buscador {
    constructor(inputId) {
        this.input = $(`#${inputId}`);
        this.container = $('.mct');
        this.originalContent = this.container.html();
        this.timer = null;
        this.searchButton = $(".searchButton");

        this.init();
    }

    init() {
        this.input.on("keyup", (e) => {
            clearTimeout(this.timer);
            const query = e.target.value.trim();

            this.timer = setTimeout(() => {
                this.buscar(query);
            }, 300); // Espera 300ms antes de hacer la búsqueda
        });
        this.searchButton.on("click", (e) => {
            e.preventDefault();
            const query = this.input.val().trim();
            if (query.length > 2) {
                this.buscar(query);
            }
        });
    }

    buscar(query) {
        if (query.length > 2) {
            $.ajax({
                url: `/buscar-productos`,
                method: "GET",
                data: { q: query },
                dataType: "json",
                success: (productos) => {
                    this.container.stop(true, true).slideUp(200, () => {
                        this.mostrarResultados(productos);
                        this.container.stop(true, true).slideDown(200);
                    });
                },
                error: (xhr, status, error) => {
                    console.error("Error en la búsqueda:", error);
                    this.container.html("<p>Error al buscar productos.</p>");
                }
            });
        } else {
            this.container.stop(true, true).slideUp(200, () => {
                this.container.html(this.originalContent);
                this.container.stop(true, true).slideDown(200);
            });
        }
    }

    mostrarResultados(productos) {
        if (!productos.length) {
            this.container.html("<p>No se encontraron productos.</p>");
            return;
        }
    
        const cards = productos.map(prod => {
            const precio = Number(prod.price);
            const descuento = Number(prod.discount);
    
            const precioFinal = descuento > 0
                ? `<del>€${precio.toFixed(2)}</del> <span class="text-danger">€${(precio * (1 - descuento / 100)).toFixed(2)}</span>`
                : `€${precio.toFixed(2)}`;
    
            const badge = descuento > 0
                ? `<span class="badge bg-danger position-absolute top-0 end-0 m-2">-${descuento}%</span>`
                : "";
    
            return `
                <div class="col-6 col-md-3 position-relative text-center">
                    <a href="/shoes/${prod.id}">
                        <img src="${prod.image}" alt="${prod.name}" class="img-fluid mb-2">
                    </a>
                    <div>
                        <strong>${prod.brand_name} ${prod.model_name}</strong><br>
                        ${precioFinal}
                    </div>
                    ${badge}
                </div>
            `;
        }).join("");
    
        // Añadir título antes de los resultados
        const query = this.input.val();
    
        this.container.html(`
            <div class="container mt-4">
                <h4>Resultados de la búsqueda: <em>${query}</em></h4>
                <div class="row">${cards}</div>
            </div>
        `);
    }
    
}

document.addEventListener("DOMContentLoaded", () => {
    new Buscador("search");
});
