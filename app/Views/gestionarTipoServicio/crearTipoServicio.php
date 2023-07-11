<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h4 class="mt-4"><?php echo $titulo ?></h4>

      <!-- para la lista de errores -->
      <?php if (isset($validation)) { ?>
        <div class="alert alert-danger">
          <?php echo $validation->listErrors(); ?>
        </div>
      <?php } ?>

      <!-- FORMULARIO PAPRA INGRESAR LOS DATOS -->
      <form method="post" action="<?php echo base_url(); ?>tipoServicio/insertar" autocomplete="off">
        <div class="form-group">
          <div class="row">
            <!-- Nombre para el tipo servicio -->
            <div class="col-12 col-sm-6">
              <label for="">Nombre</label>
              <input class="form-control" id="nombre" name="nombre" type="text" autofocus required>
            </div>
            <!-- Drescripcion para el tipo servicio -->
            <div class="col-12 col-sm-6">
              <label for="">Descripción</label>
              <input class="form-control" id="descripcion" name="descripcion" type="text" required>
            </div>
          </div>
        </div>

        <!-- Botones -->
        <a href="<?php echo base_url(); ?>tipoServicio" class="btn btn-primary my-3">Regresar</a>
        <button type="submit" class="btn btn-success my-3">Guardar</button>
      </form>

    </div>
  </main>