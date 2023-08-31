<style>
  .disabled-link {
    color: gray;
    pointer-events: none;
    /* Evita que el enlace sea clickeable */
  }
</style>

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
            <th>Cliente</th>
            <th>ID Reserva</th>
            <th>Fecha Entrada</th>
            <th>Fecha Salida</th>
            <?php
            if ($botonDetalle) {
              echo "<th></th>";
            }
            ?>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($notaHospedajes as $notaHospedaje) { ?>
            <tr>
              <td><?php echo $notaHospedaje['id_notaHospedaje'] ?></td>
              <td><?php echo $notaHospedaje['monto_total'] ?></td>
              <td><?php echo $notaHospedaje['nombre_cliente'] ?></td>
              <td><?php echo $notaHospedaje['id_reserva'] ?></td>
              <td><?php echo $notaHospedaje['fechaEntrada'] ?></td>
              <td><?php echo $notaHospedaje['fechaSalida'] ?></td>

              <?php if ($botonDetalle) { ?>
                <td>
                  <!-- botón para editar el registro -->
                  <a href="<?php echo base_url() . 'notaHospedaje/muestraNotaHospedajePdf/' . $notaHospedaje['id_notaHospedaje']; ?>" class="btn btn-primary btn-">
                    <i class="fa-sharp fa-light fa-file"></i> Detalle
                  </a>
                </td>
              <?php } ?>

              <td>
                <?php if ($notaHospedaje['estado_hospedaje'] === 'Finalizado') { ?>
                  <label class="btn btn-success btn-sm" style="width: 100px;">
                    <i class="fa-solid fa-check"></i> Finalizado
                  </label>
                <?php } else { ?>
                  <a href="<?php echo base_url() . 'notaHospedaje/finalizarHospedaje/' . $notaHospedaje['id_notaHospedaje']; ?>" class="btn btn-warning btn-sm <?= $botonFinalizar ?>" style="width: 100px;">
                    <i class="fa-solid fa-calendar"></i> Finalizar
                  </a>
                <?php } ?>
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