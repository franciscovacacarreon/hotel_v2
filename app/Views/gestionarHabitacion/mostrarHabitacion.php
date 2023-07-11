<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h4 class="mt-4"><?php echo $titulo ?></h4>
      <div>
        <p>
          <a href="<?php echo base_url();?>habitacion/crear" class="btn btn-info">Agregar</a>
          <a href="<?php echo base_url();?>habitacion/eliminados" class="btn btn-warning">Eliminados</a>
        </p>
      </div>
      <table id="datatablesSimple">
        <thead>
          <tr>
            <th>Nro</th>
            <th>Numero de camas</th>
            <th>Categoria</th>
            <th>Estado habitación</th>
            <th>Estado Activo</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($habitaciones as $habitacion) { ?>
            <tr>
              <td><?php echo $habitacion['nro_habitacion'] ?></td>
              <td><?php echo $habitacion['numero_camas'] ?></td>
              <td><?php echo $habitacion['nombre_categoria'] ?></td>
              <td><?php echo $habitacion['estado_habitacion'] ?></td>
              <td><?php echo $habitacion['estado'] ?></td>
              <td>
                <a href="<?php echo base_url().'habitacion/editar/'.$habitacion['nro_habitacion'];?>" class="btn btn-warning"><i class="fa-sharp fa-light fa-pencil"></i>
                </a>
              </td>
              <td>
                <a href="" data-href="<?php  echo base_url().'habitacion/eliminar/'.$habitacion['nro_habitacion'];?>"  data-bs-toggle="modal" data-bs-target="#modal-confirma" class="btn btn-danger" ><i class="fa-sharp fa-solid fa-trash"></i>
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