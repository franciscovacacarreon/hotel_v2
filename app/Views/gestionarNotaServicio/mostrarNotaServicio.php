
<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h4 class="mt-4"><?php echo $titulo ?></h4>

      <!-- tabla para mostrar los registros de la base de datos -->
      <table id="datatablesSimple" class="table table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>Total</th>
            <th>ID Cliente</th>
            <th>ID Nota hospedaje</th>
            <th>Fecha</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($notaServicios as $notaServicio) { ?>
            <tr>
              <td><?php echo $notaServicio['id_notaServicio'] ?></td>
              <td><?php echo $notaServicio['monto_total'] ?></td>
              <td><?php echo $notaServicio['id_cliente'] ?></td>
              <td><?php echo $notaServicio['id_notaHospedaje'] ?></td>
              <td><?php echo $notaServicio['fecha_ingreso'] ?></td>
              <td>
                <!-- botón para editar el registro -->
                <a href="<?php echo base_url() . 'notaServicio/muestraNotaServicioPdf/' . $notaServicio['id_notaServicio']; ?>" class="btn btn-primary btn-sm">
                <i class="fa-sharp fa-light fa-file"></i> Detalle
                </a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </main>

  <!-- Modal par confirmar eliminación-->
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