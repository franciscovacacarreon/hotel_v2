<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h4 class="mt-4"><?php echo $titulo ?></h4>
      <div>
        <p>
          <a href="<?php echo base_url() ?>tipoServicio/crear" class="btn btn-info">Agregar</a>
          <a href="<?php echo base_url() ?>tipoServicio/eliminados" class="btn btn-warning">Eliminados</a>
        </p>
      </div>
      <table id="datatablesSimple">
        <thead>
          <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>estado</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($datos as $dato) { ?>
            <tr>
              <td><?php echo $dato['id_tipoServicio'] ?></td>
              <td><?php echo $dato['nombre'] ?></td>
              <td><?php echo $dato['descripcion'] ?></td>
              <td><?php echo $dato['estado'] ?></td>
              <!-- boton para editar -->
              <td>
                <a href="<?php echo base_url() ?>tipoServicio/editar/<?=$dato['id_tipoServicio']?>" class="btn btn-warning" ><i class="fa-sharp fa-light fa-pencil"></i>
                </a>
              </td>
              <!-- boton para eliminar -->
              <td>
                <a data-href="<?php echo base_url() ?>tipoServicio/eliminar/<?=$dato['id_tipoServicio']?>" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-confirma" data-placement="top" title="Eliminar Registro"><i class="fa-sharp fa-solid fa-trash"></i>
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
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
          <a class="btn btn-danger btn-ok">Si</a>
        </div>
      </div>
    </div>
  </div>