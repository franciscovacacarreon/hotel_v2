<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h4 class="mt-4"><?php echo $titulo ?></h4>
            <div>
                <p>
                    <!-- boton para regresar a usuarios -->
                    <a href="<?php echo base_url(); ?>usuario" class="btn btn-info">Regresar a Usuarios</a>
                </p>
            </div>

            <!-- tabla para mostrar las usuarios eliminadas -->
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Usuario</th>
                        <th>Recepcionista</th>
                        <!-- <th>Cliente</th> -->
                        <th>Rol</th>

                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Foreach para mostrar los registros de la consulta en la tabla -->
                    <?php
                    foreach ($usuarios as $usuario) { ?>
                        <tr>
                            <td><?php echo $usuario['id_usuario'] ?></td>
                            <td><?php echo $usuario['usuario'] ?></td>
                            <td><?php echo $usuario['nombre_recepcionista'] ?></td>
                            <!-- <td><?php //echo $usuario['id_cliente'] 
                                        ?></td> -->
                            <td><?php echo $usuario['rol'] ?></td>
                            <td>
                                <!-- boton para restaurar el registro -->
                                <a href="#" data-href="<?php echo base_url() . 'usuario/restaurar/' . $usuario['id_usuario']; ?>" data-bs-toggle="modal" data-bs-target="#modal-confirma" data-placement="top" title="Reingresar Registro">
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