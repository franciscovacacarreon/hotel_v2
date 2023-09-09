<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 container">
            <h3 class="text-center my-3">
                Reporte Categoria de habitaciones
            </h3>
            <div class="d-flex justify-content-center align-items-center my-3">
                <div class="col-10">
                    <!-- panel -->
                    <div class="panel">
                        <!-- embebido, para mostrar el pdf-->
                        <iframe class="col-12" style="height: 500px" src="<?php echo base_url() . 'reporte/generaReporteHabitacionPdf/' . $fecha_inicio . '/' . $fecha_fin; ?>">

                        </iframe>
                    </div>
                </div>
            </div>
        </div>
        <div class="container d-flex justify-content-center">
            <div class="row">
                <div class="row" style="margin-top: 30px;">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header bg-info text-dark">
                                <i class="fas fa-chart-area me-1"></i>
                                Ingresos por categoria de habitación
                            </div>
                            <div class="card-body">
                                <canvas id="myChart" width="100%" height="50" style="position: relative; height: 20vh; width: 20vw; margin-top: 10px;"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5 col-md-3 col-lg-3 col-xl-3 my-3">
                        <label class="form-label">Tipo de gráfico</label>
                        <select class="form-control" name="" id="tipo-grafico">
                            <option value="bar">Barras</option>
                            <option value="pie">Torta</option>
                            <option value="line">Línea</option>
                        </select>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 my-1">
                        <br>
                        <button class="btn btn-primary" id="boton-mes" style="width: 180px;">
                            Gráfica por mes
                        </button>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 my-1">
                        <br>
                        <button class="btn btn-secondary" id="boton-categoria" style="width: 180px;">
                            Gráfica por categoria
                        </button>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 my-1">
                        <br>
                        <button class="btn btn-secondary" id="boton-descargar-grafica" style="width: 180px;">
                            Descargar gráfica
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <!-- 
        <div class="card">
                        <div class="card-header">Ingresos por categoria</div>
                        <div class="card-body">
                            <canvas id="myChart" class="" style="position: relative; height: 20vh; width: 20vw; margin-top: 100px;">
                            </canvas>
                        </div>
                    </div>
     -->


    <!-- para chartjs -->
    <script src="<?= base_url() ?>js/chartjs/cdn.jsdelivr.net_npm_chart.js"></script>
    <!-- Incluir enlaces a las bibliotecas para descargar el pdf de graficas -->
    <script src="<?= base_url() ?>js/chartjs/cdnjs.cloudflare.com_ajax_libs_dom-to-image_2.6.0_dom-to-image.min.js"></script>
    <script src="<?= base_url() ?>js/chartjs/cdnjs.cloudflare.com_ajax_libs_FileSaver.js_2.0.5_FileSaver.min.js"></script>


    <script>
        const ctx = document.getElementById('myChart');
        const tipoGrafico = document.getElementById('tipo-grafico');
        const botonCategoria = document.getElementById('boton-categoria');
        const botonMes = document.getElementById('boton-mes');
        const botonDescargar = document.getElementById('boton-descargar-grafica');

        imprimirGraficaPorMes();

        botonCategoria.addEventListener("click", () => {
            imprimirGraficaPorCategoria();
        });

        botonMes.addEventListener("click", () => {
            imprimirGraficaPorMes();
        });


        document.getElementById('boton-descargar-grafica').addEventListener('click', function() {
            var canvas = document.getElementById('myChart');

            // Convertir el gráfico en una imagen utilizando dom-to-image
            domtoimage.toBlob(canvas, {
                    style: {
                        width: '1000px',
                        height: '400px'
                    }
                })
                .then(function(blob) {
                    // Descargar la imagen utilizando FileSaver.js
                    saveAs(blob, 'grafico_categorias.png');
                });
        });

        tipoGrafico.addEventListener("click", function() {
            var selectedOption = tipoGrafico.options[tipoGrafico.selectedIndex];
            var selectedValue = selectedOption.value;
            myChart.config._config.type = selectedOption.value;
            myChart.update();
        });

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                datasets: [{
                    label: 'Ingresos de categorias',
                    borderColor: ['black'],
                    borderWidth: 1,
                    backgroundColor: [
                        "#FF5733", // Naranja
                        "#FFC300", // Amarillo
                        "#36A2EB", // Azul claro
                        "#4BC0C0", // Turquesa
                        "#9966FF", // Morado
                        "#FF6384", // Rosa
                        "#33FF33", // Verde claro
                        "#FF9933", // Naranja claro
                        "#FFCC33", // Amarillo claro
                        "#3366FF" // Azul
                    ],
                }]
            },
            options: {
                scales: {
                    //si no empieza en cero, empieza desde el menor valor
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Gráfico de ingresos por categoria'
                    },
                    subtitle: {
                        display: true,
                        text: ''
                    }
                },
                //indexAxis: 'y',
            }
        });

        function imprimirGraficaPorMes() {
            $.ajax({
                url: '<?= base_url() ?>/reporte/datosReporteHabitacionTotalMes/<?= $fecha_inicio ?>/<?= $fecha_fin ?>',
                dataType: 'json',
                success: function(resultado) {
                    if (resultado == 0) {
                        $(tagCodigo).val('');
                    } else {
                        console.log(resultado);
                        cargarDatos(resultado);
                    }
                }
            });
        }

        function cargarDatos(datos) {
            myChart.data['labels'] = [];
            myChart.data['datasets'][0].data = [];
            datos.forEach(dato => {
                myChart.data['labels'].push(mostrarMes(dato.mes));
                myChart.data['datasets'][0].data.push(dato.monto);
                myChart.update();
            });
            // console.log(); 
        }

        function mostrarMes(mes) {
            const meses = ["", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
            return meses[mes];
        }

        function imprimirGraficaPorCategoria() {
            $.ajax({
                url: '<?= base_url() ?>/reporte/datosReportePorCategoria/<?= $fecha_inicio ?>/<?= $fecha_fin ?>',
                dataType: 'json',
                success: function(resultado) {
                    if (resultado == 0) {
                        $(tagCodigo).val('');
                    } else {
                        console.log(resultado);
                        cargarDatosPorCategoria(resultado);
                    }
                }
            });
        }

        function cargarDatosPorCategoria(datos) {
            labels = [];
            data = [];
            myChart.data['labels'] = [];
            myChart.data['datasets'][0].data = [];
            datos.forEach(dato => {
                myChart.data['labels'].push(dato.nombre);
                myChart.data['datasets'][0].data.push(dato.monto);
                myChart.update();
            });

        }
    </script>