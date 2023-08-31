<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h4 class="mt-4"><?php echo $titulo ?></h4>
      <div>
        <p>
          <a href="<?php echo base_url(); ?>recepcionista/crear" class="btn btn-info">Agregar</a>
          <a href="<?php echo base_url(); ?>recepcionista/eliminados" class="btn btn-warning">Eliminados</a>
        </p>
      </div>
      <table id="datatablesSimple">
        <thead>
          <tr>
            <th>Nro</th>
            <th>Nombre</th>
            <th>Paterno</th>
            <th>Materno</th>
            <th>Teléfono</th>
            <th>Fecha de Nacimiento</th>
            <th>Sexo</th>
            <th>Sueldo</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($recepcionistas as $recepcionista) { ?>
            <tr>
              <td><?php echo $recepcionista['id_recepcionista'] ?></td>
              <td><?php echo $recepcionista['nombre'] ?></td>
              <td><?php echo $recepcionista['paterno'] ?></td>
              <td><?php echo $recepcionista['materno'] ?></td>
              <td><?php echo $recepcionista['telefono'] ?></td>
              <td><?php echo $recepcionista['fecha_nacimiento'] ?></td>
              <td><?php echo $recepcionista['sexo'] ?></td>
              <td><?php echo $recepcionista['sueldo'] ?></td>
              <td>
                <a href="<?php echo base_url() . 'recepcionista/editar/' . $recepcionista['id_recepcionista']; ?>" class="btn btn-warning btn-sm">
                  <i class="fa-sharp fa-light fa-pencil"></i> Editar
                </a>
              </td>
              <td>
                <a href="" data-href="<?php echo base_url() . 'recepcionista/eliminar/' . $recepcionista['id_recepcionista']; ?>" data-bs-toggle="modal" data-bs-target="#modal-confirma" class="btn btn-danger btn-sm">
                  <i class="fa fa-trash"></i> Eliminar
                </a>
              </td>
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