
<?php 
  $session = session();
?>


<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h4 class="mt-4"><?php echo $titulo ?></h4>
      
      <?php if ($session->id_rol == 1) {?>
          <div class="my-3">
            <p>
              <a href="<?php echo base_url() ?>tiposervicio/crear" class="btn btn-info">Agregar</a>
              <a href="<?php echo base_url() ?>tiposervicio/eliminados" class="btn btn-warning">Eliminados</a>
            </p>
          </div>
      <?php }?>

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
            <th>Id</th>
            <th>Nombre</th>
            <th>Descripcion</th>
            <?php if ($session->id_rol == 1) {?>
              <th></th>
              <th></th>
            <?php }?>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($datos as $dato) { ?>
            <tr>
              <td><?php echo $dato['id_tipoServicio'] ?></td>
              <td><?php echo $dato['nombre'] ?></td>
              <td><?php echo $dato['descripcion'] ?></td>

              <?php if ($session->id_rol == 1) {?>
              <!-- boton para editar -->
              <td>
                <a href="<?php echo base_url() ?>tiposervicio/editar/<?= $dato['id_tipoServicio'] ?>" class="btn btn-warning btn-sm">
                  <i class="fa-sharp fa-light fa-pencil"></i> Editar
                </a>
              </td>
              <!-- boton para eliminar -->
              <td>
                <a data-href="<?php echo base_url() ?>tiposervicio/eliminar/<?= $dato['id_tipoServicio'] ?>" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal-confirma" data-placement="top" title="Eliminar Registro">
                  <i class="fa fa-trash"></i> Eliminar
                </a>
              </td>

              <?php }?>

            </tr>
          <?php  } ?>
        </tbody>
      </table>
    </div>
  </main>


  <!-- Modal -->
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
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
          <a class="btn btn-danger btn-ok">Si</a>
        </div>
      </div>
    </div>
  </div>