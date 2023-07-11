<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h4 class="mt-4"><?php echo $titulo ?></h4>
      <div>
        <p>
          <!-- botones para agregar y ver eliminados -->
          <a href="<?php echo base_url();?>categoria/crear" class="btn btn-info">Agregar</a>
          <a href="<?php echo base_url();?>categoria/eliminados" class="btn btn-warning">Eliminados</a>
        </p>
      </div>

      <!-- tabla para mostrar los registros de la base de datos -->
      <table id="datatablesSimple">
        <thead>
          <tr>
            <th>Nro</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>descripcion</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($datos as $dato) { ?>
            <tr>
              <td><?php echo $dato['id'] ?></td>
              <td><?php echo $dato['nombre'] ?></td>
              <td><?php echo $dato['precio'] ?></td>
              <td><?php echo $dato['descripcion'] ?></td>
              <td>
                <!-- boton para editar el registro -->
                <a href="<?php echo base_url().'categoria/editar/'.$dato['id'];?>" class="btn btn-warning"><i class="fa-sharp fa-light fa-pencil"></i>
                </a>
              </td>
              <td>
                <!-- boton para eliminar el registro -->
                <a href="" data-href="<?php  echo base_url().'categoria/eliminar/'.$dato['id'];?>"  data-bs-toggle="modal" data-bs-target="#modal-confirma" class="btn btn-danger" ><i class="fa-sharp fa-solid fa-trash"></i>
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