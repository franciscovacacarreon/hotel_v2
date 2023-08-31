<?php
$session = session();
?>

<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h4 class="mt-4"><?php echo $titulo ?></h4>

      <?php if ($session->id_rol == 1) { ?>
        <div>
          <p>
            <a href="<?php echo base_url(); ?>habitacion/crear" class="btn btn-info">Agregar</a>
            <a href="<?php echo base_url(); ?>habitacion/eliminados" class="btn btn-warning">Eliminados</a>
            <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modal-estado"> Estado de habitaciones</button>
          </p>
        </div>
      <?php } ?>
      <?php
      if (isset($error)) {
        echo "<div id='error-alert' class='alert alert-danger'>
                $error
                </div>";

        echo "

          <script>
            // Mostrar la etiqueta temporal durante 3 segundos
            var etiquetaTemporal = document.getElementById('error-alert');
            etiquetaTemporal.style.display = 'block'; // Mostrar la etiqueta
            setTimeout(function() {
              etiquetaTemporal.style.display = 'none'; // Ocultar la etiqueta después de 3 segundos
            }, 5000); // 000 milisegundos = 3 segundos
          </script>

          ";
      }
      ?>
      <table id="datatablesSimple">
        <thead>
          <tr>
            <th>Nro</th>
            <!-- <th>Numero de camas</th> -->
            <th>Categoria</th>
            <th>Estado habitación</th>

            <?php if ($session->id_rol == 1) { ?>
              <th></th>
              <th></th>
            <?php } ?>

          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($habitaciones as $habitacion) { ?>
            <tr>
              <td><?php echo $habitacion['nro_habitacion'] ?></td>
              <!-- <td><?php //echo $habitacion['numero_camas'] 
                        ?></td> -->
              <td><?php echo $habitacion['nombre_categoria'] ?></td>
              <td><?php echo $habitacion['estado_habitacion'] ?></td>

              <?php if ($session->id_rol == 1) { ?>
                <td>
                  <a href="<?php echo base_url() . 'habitacion/editar/' . $habitacion['nro_habitacion']; ?>" class="btn btn-warning btn-sm">
                    <i class="fa-sharp fa-light fa-pencil"></i> Editar
                  </a>
                </td>
                <td>
                  <a href="" data-href="<?php echo base_url() . 'habitacion/eliminar/' . $habitacion['nro_habitacion']; ?>" data-bs-toggle="modal" data-bs-target="#modal-confirma" class="btn btn-danger btn-sm">
                    <i class="fa fa-trash"></i> Eliminar
                  </a>
                </td>
              <?php } ?>

            </tr>
          <?php  } ?>
        </tbody>
      </table>
    </div>
  </main>


  <!-- Modal para confirmar eliminación-->
  <div class="modal fade" id="modal-confirma" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Eliminar registro</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>¿Desea eliminar este registro?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <a class="btn btn-danger btn-ok">Si</a>
        </div>
      </div>
    </div>
  </div>

  <!-- modal para ver los estados de las habitaciones -->
  <div class="modal fade" id="modal-estado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Estado de habitaciones</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="card-body">
            <table id="datatablesSimple">
              <thead>
                <tr>
                  <th>Nro.</th>
                  <th>Descripcion</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                
              </tbody>
            </table>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <a class="btn btn-danger btn-ok">Si</a>
        </div>
      </div>
    </div>
  </div>