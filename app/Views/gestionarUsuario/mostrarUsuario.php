<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h4 class="mt-4"><?php echo $titulo ?></h4>
            <div>
                <p>
                    <a href="<?php echo base_url(); ?>usuario/crear" class="btn btn-info">Agregar</a>
                    <a href="<?php echo base_url(); ?>usuario/eliminados" class="btn btn-warning">Eliminados</a>
                </p>
            </div>
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Usuario</th>
                        <th>Recepcionista</th>
                        <!-- <th>Cliente</th> -->
                        <th>Rol</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($usuarios as $usuario) { ?>
                        <tr>
                            <td><?php echo $usuario['id_usuario'] ?></td>
                            <td><?php echo $usuario['usuario'] ?></td>
                            <td><?php echo $usuario['nombre_recepcionista'] ?></td>
                            <!-- <td><?php //echo $usuario['id_cliente'] ?></td> -->
                            <td><?php echo $usuario['rol'] ?></td>
                            <td>
                                <a href="<?php echo base_url() . 'usuario/editar/' . $usuario['id_usuario']; ?>" class="btn btn-warning btn-sm">
                                    <i class="fa-sharp fa-light fa-pencil"></i> Editar
                                </a>
                            </td>
                            <td>
                                <a href="#" data-href="<?php echo base_url() . 'usuario/eliminar/' . $usuario['id_usuario']; ?>" data-bs-toggle="modal" data-bs-target="#modal-confirma" data-placement="top" title="Eliminar Registro" class="btn btn-danger btn-sm">
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <a class="btn btn-danger btn-ok">Si</a>
                </div>
            </div>
        </div>
    </div>