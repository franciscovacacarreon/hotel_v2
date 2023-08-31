<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h3 class="text-center my-3">
                Reporte de servicios
            </h3>
            <div class="col-xs-12 col-sm-12 col-md-12 col-12">
                <!-- panel -->
                <div class="panel">
                    <!-- embebido, para mostrar el pdf-->
                    <div class="row" style="margin-top: 30px;">
                    <iframe class="col-12" style="height: 500px" src="<?php echo base_url().'reporte/generaReporteServicioPdf/'.$fecha_inicio.'/'.$fecha_fin;?>">
                        
                    </iframe> 
                    </div>
                </div>
            </div>
        </div>
    </main>