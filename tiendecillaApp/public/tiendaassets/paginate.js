/*global fetch*/
/*global localStorage*/
(() => {

    //let urlBase = 'https://carmelo.ieszaidinvergeles.es/laraveles/ajaxApp/public';
    const urlBase = document.querySelector('meta[name="url-base"]')['content'] + '/';
    let carrito = [];

    let llamadaAjax = (url, procesarRespuesta) => {
        fetch(url, {
          method: 'GET',
          headers: {
            'Accept': 'application/json'
          }
        })
        .then(response => response.json())
        .then(data => {
            procesarRespuesta(data);
        })
        .catch(error => {
            console.log(error);
        });
    };

    let generarTextoProducto = (producto) => {
        return `
        <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
					<div class="block2">
						<div class="block2-pic hov-img0">
                            <img src="data:imagen/jpeg;base64,${producto.cover}">
							<a id="btnChart" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1" data-producto-id="${producto.id}">
								Add to chart
							</a>
						</div>

						<div class="block2-txt flex-w flex-t p-t-14">
							<div class="block2-txt-child1 flex-col-l ">
								<a href="#" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
									${producto.nombre}
								</a>

								<span class="stext-105 cl3">
									$${producto.precio}
								</span>
							</div>

							<div class="block2-txt-child2 flex-r p-t-3">
								<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
									<img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png" alt="ICON">
									<img class="icon-heart2 dis-block trans-04 ab-t-l" src="images/icons/icon-heart-02.png" alt="ICON">
								</a>
							</div>
						</div>
					</div>
				</div>
        `;
    };
    
let agregarEventoAddChart = (data) => {
        let addChartButtons = document.querySelectorAll('#btnChart');
        addChartButtons.forEach(button => {
            button.addEventListener('click', (event) => {
                let idProducto = event.target.id; 
                let producto = data.productos.data.find(p => p.id == idProducto);
                console.log(data.productos.data);
                if (producto) {
                    carrito.push(producto);
                    localStorage.setItem('carrito', JSON.stringify(carrito));
                    generarCarrito();
                    
                }
                
            });
        });
    };

    let generarContenidoAjax = (data) => {
        let todo = '';
        data.productos.data.forEach(producto => {
            todo += generarTextoProducto(producto);
        });
        let contenidoAjax = document.getElementById('contenidoAjax');
        contenidoAjax.innerHTML = todo;
    };

    let generarEnlacePagina = (link, index) => {
       return ` 
        <li class="page-item"><a id="pagina-${index}" class="page-link"
          href="//">${link.label}</a>
        </li>`;
    };

    let agregarEventosPaginacion = (data) => {
      data.productos.links.forEach((link, index) => {
        let botonPagina = document.getElementById(`pagina-${index}`);
        botonPagina.addEventListener('click', function(event) {
          event.preventDefault(); 
          shopProducto(link.url);
        });
      });
    };

    let generarPaginacionAjax = (data) => {
        let todo = '';
        data.productos.links.forEach((link, index) => {
            todo += generarEnlacePagina(link, index);
        });
        let paginacionAjax = document.getElementById('paginacionAjax');
        paginacionAjax.innerHTML = todo;
        agregarEventosPaginacion(data);
        agregarEventoAddChart(data);
    };


    let generarCarrito = () => {
        let carritoElement = document.getElementById('container-chart');
        carritoElement.innerHTML = '';

        carrito.forEach(producto => {
             let productoElement = document.createElement('li');
             productoElement.classList.add('header-cart-item', 'flex-t m-b-12');
             productoElement.innerHTML = `
						<div class="header-cart-item-img">
							<img src="data:imagen/jpeg;base64,${producto.cover}">
						</div>

						<div class="header-cart-item-txt p-t-8">
							<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
							    ${producto.nombre}
							</a>

							<span class="header-cart-item-info">
								$${producto.precio}
							</span>
						
							 <div>
                                <a href="#" class="product-remove" id="btnDelete">Remove</a>
                            </div>
						</div>`
                    ;
            // Agrega un evento de clic al enlace "Remove"
        let enlaceEliminar = productoElement.querySelector('.product-remove');
        enlaceEliminar.addEventListener('click', (event) => {
            let idProducto = event.target.dataset.id;
            carrito.splice(idProducto, 1);
            localStorage.setItem('carrito', JSON.stringify(carrito));
            generarCarrito();
        });

        // Agrega el elemento del producto al carrito
        carritoElement.appendChild(productoElement);
        });
    };
    
    
    let shopProducto = (url) => {
        llamadaAjax(url, (data) => {
            console.log(data);
            generarContenidoAjax(data);
            generarPaginacionAjax(data);
            generarCarrito();
        });
    };



    document.addEventListener('DOMContentLoaded', function() {
      let url = urlBase + 'tienda?page=1';
      shopProducto(url);
      let carritoGuardado = localStorage.getItem('carrito');
        if (carritoGuardado) {
            carrito = JSON.parse(carritoGuardado);
            generarCarrito();
        }
    });
})();