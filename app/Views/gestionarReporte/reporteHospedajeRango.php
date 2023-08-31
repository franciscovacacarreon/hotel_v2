<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4"> 
            <h2 class=" mb-3 mt-3 fw-bold"><?php echo $titulo; ?></h2>
            <form method="POST" action="<?php echo base_url(); ?>/reporte/muestraReporteHospedajePdf" enctype="multipart/form-data" autocomplete="off" id="form-reporte-hospedaje">
            <?php echo csrf_field(); ?> 

                <div class="form-group">
                    <div class="row mb-2">
                        <div class="col-12 col-sm-4">
                            <label class="form-label fw-bold"><i class="text-danger">*</i> Fecha de inicio:</label>                   
                            <input type='date' id="fecha_inicio" name="fecha_inicio" class="form-control mb-2" value="" required />
                        </div>
                        <div class="col-12 col-sm-4">
                            <label class="form-label fw-bold" ><i class="text-danger">*</i> Fecha de fin:</label>
                            <input type='date' id="fecha_fin" name="fecha_fin" class="form-control mb-2" required/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="mb-3">
                        <div class="col-12 col-sm-6 mb-3">
                            <i class="text-danger"> ( * ) Campos obligatorios</i>
                        </div>
                        <div class="d-flex justify-content-start align-items-center">
                        <button type="button" class="btn btn-success mx-3" id="boton-hospedaje">Reporte de hospedajes</button>
                        <button type="button" class="btn btn-secondary mx-3" id="boton-habitacion">Reporte de categoria de habitaciones</button>
                        <!-- <button type="submit" class="btn btn-primary mx-3">Generar de reservas</button> -->
                        </div>
                        
                    </div>
                </div>

                <?php if(isset($validation)){?>
                    <div class="alert alert-danger">
                        <?php echo $validation->listErrors(); ?>
                    </div>
                <?php } ?>
            </form>
        </div>
    </main>

    <script>
        const formulario = document.getElementById("form-reporte-hospedaje");
        const botonHospedaje = document.getElementById("boton-hospedaje");
        const botonHabitacion = document.getElementById("boton-habitacion");

        botonHospedaje.addEventListener("click", () => {
            formulario.setAttribute('action', '<?php echo base_url(); ?>/reporte/muestraReporteHospedajePdf');
            formulario.submit();
        });

        botonHabitacion.addEventListener("click", () => {
            formulario.setAttribute('action', '<?php echo base_url(); ?>/reporte/muestraReporteHabitacionPdf');
            formulario.submit();
        });
    </script>