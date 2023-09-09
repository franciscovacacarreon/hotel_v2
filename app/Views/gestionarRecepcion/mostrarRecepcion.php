<div id="layoutSidenav_content">
    <main class="container my-3">

        <h2 class="my-3 text-center">
            Hospedajes en estadía
        </h2>

        <!-- barra de busqueda -->
        <div class="row d-flex justify-content-center mb-3">
            <div class="col-md-6">
                <input type="text" id="searchInput" class="form-control" placeholder="Buscar por cliente...">
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary" onclick="searchCards()">Buscar</button>
            </div>
        </div>

        <div class="row d-flex justify-content-center align-items-center" id="cardContainer">

        <!-- todos los datos se estan cargando desde javaScript -->
            <?php //foreach ($datos as $data) { ?>
                <!-- <div class="card text-center mx-3 my-3" style="width: 18rem;">
                    <div class="card-header my-2 bg-primary text-white">
                        <h5 class="card-title">Fecha: <?php // $data['fechaEntrada'] ?></h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Nro. Habitacion: <?php // $data['nro_habitacion'] ?></p>
                        <p class="card-text">Cliente: <?php // $data['nombre_cliente'] ?></p>
                        <p class="card-text">ID hospedaje: <?php // $data['id_notaHospedaje'] ?></p>
                        <a href="<?php //echo base_url() . 'notaHospedaje/finalizarHospedaje/' . $data['id_notaHospedaje']; ?>" class="btn btn-primary visually-hidden-focusable">
                            <i class="fa-solid fa-calendar"></i></i> Finalizar
                        </a>
                    </div>
                </div> -->

            <?php //} ?>

        </div>
    </main>


    <script>
        const inputSearch = document.getElementById("searchInput");

        inputSearch.addEventListener("keyup", () => {
            searchCards();
        });

        function searchCards() {
            var searchText = document.getElementById('searchInput').value.toLowerCase();
            var cardContainer = document.getElementById('cardContainer');
            var cards = <?= json_encode($datos) ?>; // Datos en formato JSON desde PHP
            const botonFinalizar = <?= json_encode($botonFinalizar) ?>;

            cardContainer.innerHTML = '';

            cards.forEach(function(data) {
                if (data.nombre_cliente.toLowerCase().includes(searchText)) {
                    var cardHtml = `
                    <div class="card text-center mx-3 my-3" style="width: 18rem;">
                        <div class="card-header my-2 bg-primary text-white">
                            <h5 class="card-title">Fecha: ${data.fechaEntrada}</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Nro. Habitacion: ${data.nro_habitacion}</p>
                            <p class="card-text">Cliente: ${data.nombre_cliente}</p>
                            <p class="card-text">ID hospedaje: ${data.id_notaHospedaje}</p>
                            <a href="<?php echo base_url() . 'recepcion/finalizarHospedaje/'; ?>${data.id_notaHospedaje}" class="btn btn-primary ${botonFinalizar}">
                                <i class="fa-solid fa-calendar"></i></i> Finalizar
                            </a>
                        </div>
                    </div>
                `;
                    cardContainer.innerHTML += cardHtml;
                }
            });
        }

        // Mostrar todas las tarjetas al cargar la página
        window.onload = function() {
            searchCards();
        };
    </script>