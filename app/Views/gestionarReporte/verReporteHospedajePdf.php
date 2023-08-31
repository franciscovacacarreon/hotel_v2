<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 container">
            <h3 class="text-center my-3">
                Reporte de hospedajes
            </h3>
            <div class="d-flex justify-content-center align-items-center my-3">
                <div class="col-10">
                    <!-- panel -->
                    <div class="panel">
                        <!-- embebido, para mostrar el pdf-->
                        <div class="row" style="margin-top: 30px;">
                            <iframe class="col-12" style="height: 500px" src="<?php echo base_url().'reporte/generaReporteHospedajePdf/'.$fecha_inicio.'/'.$fecha_fin;?>">

                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <div class="row">
                    <canvas id="myChart" class="" style="position: relative; height: 20vh; width: 20vw; margin-top: 100px;">
                    </canvas>
                    <div class="col-3 my-3">
                        <label class="form-label" for="">Tipo de gráfico</label>
                        <select class="form-control" name="" id="tipo-grafico">
                            <option value="bar">Barras</option>
                            <option value="pie">Torta</option>
                            <option value="line">Línea</option>
                        </select>
                    </div>
                    <div class="col-3 my-3">
                        <br>
                        <button class="btn btn-primary" id="boton-mes">
                            Gráfica por mes
                        </button>
                    </div>
                    <div class="col-3 my-3">
                        <br>
                        <button class="btn btn-secondary" id="boton-descargar-grafica">
                            Descargar gráfica
                        </button>
                    </div>
                    <!-- <div class="col-3 my-3">
                        <br>
                        <button class="" id="boton-semana">
                            Gráfica por semana
                        </button>
                    </div> -->
                    
                </div>
            </div>

        </div>
    </main>

    <!-- para chartjs -->
    <script src="<?=base_url()?>js/chartjs/cdn.jsdelivr.net_npm_chart.js"></script>
     <!-- Incluir enlaces a las bibliotecas para descargar el pdf de graficas -->
    <script src="<?=base_url()?>js/chartjs/cdnjs.cloudflare.com_ajax_libs_dom-to-image_2.6.0_dom-to-image.min.js"></script>
    <script src="<?=base_url()?>js/chartjs/cdnjs.cloudflare.com_ajax_libs_FileSaver.js_2.0.5_FileSaver.min.js"></script>

    <script>
        const ctx = document.getElementById('myChart');
        const tipoGrafico = document.getElementById('tipo-grafico');
        //const botonSemana = document.getElementById('boton-semana');
        const botonMes = document.getElementById('boton-mes');
        const botonDescargar = document.getElementById('boton-descargar-grafica');

        // botonSemana.addEventListener("click", () => {
        //     imprimirGraficaPorSemana();
        // });

        botonMes.addEventListener("click", () => {
            imprimirGraficaPorMes();
        });

        tipoGrafico.addEventListener("click", function() {
            var selectedOption = tipoGrafico.options[tipoGrafico.selectedIndex];
            var selectedValue = selectedOption.value;
            myChart.config._config.type = selectedOption.value;
            myChart.update();
        });

        document.getElementById('boton-descargar-grafica').addEventListener('click', function() {
            var canvas = document.getElementById('myChart');

            // Convertir el gráfico en una imagen utilizando dom-to-image
            domtoimage.toBlob(canvas, { style: { width: '1000px', height: '400px' } })
                .then(function(blob) {
                    // Descargar la imagen utilizando FileSaver.js
                    saveAs(blob, 'grafico_hospedajes.png');
                });
        });


        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                datasets: [{
                    label: 'Ingresos de por hospedajes',
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
                        text: 'Gráfico de ganancias por hospedaje'
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
                url: '<?= base_url() ?>/reporte/datosReportePorHospedajeMes/<?= $fecha_inicio ?>/<?= $fecha_fin ?>',
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
            console.log();
        }

        function imprimirGraficaPorSemana(){
            $.ajax({
                url: '<?= base_url() ?>/reporte/datosReportePorHospedajeSemana/<?= $fecha_inicio ?>/<?= $fecha_fin ?>',
                dataType: 'json',
                success: function(resultado) {
                    if (resultado == 0) {
                        $(tagCodigo).val('');
                    } else {
                        console.log(resultado);
                        cargarDatosPorSemana(resultado);
                    }
                }
            });
        }

        function cargarDatosPorSemana(datos) {
            labels = [];
            data = [];
            myChart.data['labels'] = [];
            myChart.data['datasets'][0].data = [];
            let contador = 1;
            datos.forEach(dato => {
                myChart.data['labels'].push(mostrarSemana(contador) + " - " + mostrarMes([dato.mes]));
                myChart.data['datasets'][0].data.push(dato.monto);
                myChart.update();
                contador++;
                if (contador == 5) {
                    contador = 1;
                }
            });
            
        }

        function mostrarMes(mes) {
            const meses = ["", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
            return meses[mes]
        }

        function mostrarSemana(semana) {
            const datosSemana = ["", "Semana 1", "Semana 2", "Semana 3", "Semana 4"];
            return datosSemana[semana];
        }
    </script>