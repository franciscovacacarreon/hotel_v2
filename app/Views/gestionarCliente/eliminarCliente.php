<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h4 class="mt-4"><?php echo $titulo ?></h4>
      <div>
        <p>
          <a href="<?php echo base_url(); ?>cliente" class="btn btn-info">Clientes</a>
        </p>
      </div>
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
            <th></th>
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
              <td>
                <a href="#" data-href="<?php echo base_url() . 'cliente/restaurar/' . $cliente['id_cliente']; ?>" data-bs-toggle="modal" data-bs-target="#modal-confirma" data-placement="top" title="Reingresar Registro">
                  <i class="fas fa-arrow-alt-circle-up"></i>
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