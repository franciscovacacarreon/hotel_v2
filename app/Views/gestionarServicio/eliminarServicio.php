<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h4 class="mt-4"><?php echo $titulo ?></h4>
      <div>
        <p>
          <a href="<?php echo base_url(); ?>servicio" class="btn btn-info">Regresar</a>
        </p>
      </div>
      <table id="datatablesSimple" class="table table-striped">
        <thead>
          <tr>
            <th>Nro</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Descripción</th>
            <th>Tipo de Servicio</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($servicios as $servicio) { ?>
            <tr>
              <td><?php echo $servicio['id_servicio'] ?></td>
              <td><?php echo $servicio['nombre'] ?></td>
              <td><?php echo $servicio['precio'] ?></td>
              <td><?php echo $servicio['descripcion'] ?></td>
              <td><?php echo $servicio['nombre_tipoServicio'] ?></td>
              <td>
                <a href="#" data-href="<?php echo base_url() . 'servicio/restaurar/' . $servicio['id_servicio']; ?>" data-bs-toggle="modal" data-bs-target="#modal-confirma" data-placement="top" title="Reingresar Registro">
                  <i class="fas fa-arrow-alt-circle-up"></i>
                </a>
              </td>
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
          <h5 class="modal-title" id="exampleModalLabel">Restaurar registro</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>¿Desea restaurar este registro?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <a class="btn btn-danger btn-ok">Si</a>
        </div>
      </div>
    </div>
  </div>