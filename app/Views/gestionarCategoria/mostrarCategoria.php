<?php
  $session = session();
?>

<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h4 class="mt-4"><?php echo $titulo ?></h4>
      <div class="my-3">
        <!-- botones para agregar y ver eliminados -->
        <?php if ($session->id_rol == 1) {?>
        
          <a href="<?php echo base_url();?>categoria/crear" class="btn btn-info">Agregar</a>
          <a href="<?php echo base_url();?>categoria/eliminados" class="btn btn-warning">Eliminados</a>
        <?php }?>
      </div>


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

      <!-- tabla para mostrar los registros de la base de datos -->
      <table id="datatablesSimple" class="table table-striped">
        <thead>
          <tr>
            <th>Nro</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Descripción</th>
            
            <?php if ($session->id_rol == 1) {?>
            <th></th>
            <th></th>
            <?php }?>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($datos as $dato) { ?>
            <tr>
              <td><?php echo $dato['id'] ?></td>
              <td><?php echo $dato['nombre'] ?></td>
              <td><?php echo $dato['precio'] ?></td>
              <td><?php echo $dato['descripcion'] ?></td>
             
              <?php if ($session->id_rol == 1) {?>
              <td>
                <!-- botón para editar el registro -->
                <a href="<?php echo base_url().'categoria/editar/'.$dato['id'];?>" class="btn btn-warning btn-sm">
                  <i class="fa fa-pencil"></i> Editar
                </a>
              </td>
              <td>
                <!-- botón para eliminar el registro -->
                <a href="#" data-href="<?php echo base_url().'categoria/eliminar/'.$dato['id'];?>" data-bs-toggle="modal" data-bs-target="#modal-confirma" class="btn btn-danger btn-sm">
                  <i class="fa fa-trash"></i> Eliminar
                </a>
              </td>

              <?php }?>

            </tr>
          <?php } ?>
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
        <a class="btn btn-danger btn-ok">Sí</a>
      </div>
    </div>
  </div>
</div>
