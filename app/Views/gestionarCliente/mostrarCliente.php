<?php
$session = session();
?>

<div id="layoutSidenav_content">
  <main class="">
    <div class="container-fluid px-4">
      <h4 class="mt-4"><?php echo $titulo ?></h4>

      <?php if ($session->id_rol == 1) { ?>
        <div>
          <p>
            <a href="<?php echo base_url(); ?>cliente/crear" class="btn btn-info">Agregar</a>
            <a href="<?php echo base_url(); ?>cliente/eliminados" class="btn btn-warning">Eliminados</a>
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
            <th>CI</th>
            <th>Nombre</th>
            <th>Paterno</th>
            <th>Materno</th>
            <th>Teléfono</th>
            <th>Fecha de Nacimiento</th>
            <th>Sexo</th>

            <?php if ($session->id_rol == 1) { ?>
              <th></th>
              <th></th>
            <?php } ?>

          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($clientes as $cliente) { ?>
            <tr>
              <td><?php echo $cliente['id_cliente'] ?></td>
              <td><?php echo $cliente['ci'] ?></td>
              <td><?php echo $cliente['nombre'] ?></td>
              <td><?php echo $cliente['paterno'] ?></td>
              <td><?php echo $cliente['materno'] ?></td>
              <td><?php echo $cliente['telefono'] ?></td>
              <td><?php echo $cliente['fecha_nacimiento'] ?></td>
              <td><?php echo $cliente['sexo'] ?></td>

              <?php if ($session->id_rol == 1) { ?>
                <td>
                  <a href="<?php echo base_url() . 'cliente/editar/' . $cliente['id_cliente']; ?>" class="btn btn-warning btn-sm">
                    <i class="fa-sharp fa-light fa-pencil"></i> Editar
                  </a>
                </td>
                <td>
                  <a href="" data-href="<?php echo base_url() . 'cliente/eliminar/' . $cliente['id_cliente']; ?>" data-bs-toggle="modal" data-bs-target="#modal-confirma" class="btn btn-danger btn-sm">
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
          <a class="btn btn-danger btn-ok">Si</a>
        </div>
      </div>
    </div>
  </div>