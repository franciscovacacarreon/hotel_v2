<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h4 class="mt-4"><?php echo $titulo ?></h4>
            
            <!-- para la lista de errores -->
            <?php if(isset($validation)) {?>
                <div class="alert alert-danger">
                    <?php   echo $validation->listErrors();?>
                </div>
            <?php }?>

            <!-- formulario -->
            <form method="POST" action="<?php echo base_url() ?>usuario/actualizar" autocomplete="off">
                
                <!-- hidden para enviar el id -->
                <input type="hidden" value="<?php  echo $usuario['id_usuario']?>" name="id_usuario">
             
                <div class="form-group">     
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="">Usuario</label>
                            <input class="form-control" id="usuario" name="usuario" 
                            type="text" value="<?php echo $usuario['usuario']?>" autofocus required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="">Contraseña</label>
                             <!--set_value cuando de actualiza el formulario no se pierde lo que el usuario escribio -->
                            <input class="form-control" id="password" name="password" 
                            type="password" value="<?php echo set_value('password')?>" required>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="">Confirmar Contraseña</label>
                            <input class="form-control" id="re_password" name="re_password" type="password" value="<?php echo set_value('re_passoword')?>" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">

                        <!-- recepcionistas -->
                        <div class="col-12 col-sm-6">
                            <label for="">Recepcionista</label>
                            <select class="form-control" name="id_recepcionista" id="id_recepcionista" required>
                                
                                <!--Selecionar el recepcionista de la base de datos -->
                                <option value="">Seleccione un recepcionista</option>
                                
                                <?php foreach ($recepcionistas as $recepcionista) { ?>
                                    
                                    <option value="<?php echo $recepcionista['id_recepcionista']?>"
                                    
                                    <?php 
                                        if ($usuario['id_recepcionista'] == 
                                            $recepcionista['id_recepcionista']) {

                                                echo 'selected';

                                        }
                                    ?>
                                    >
                                        <?php echo $recepcionista['nombre']?> 
                                        <?php echo $recepcionista['paterno']?> 
                                    </option>
   
                                <?php }?>
                            </select>
                        </div>

                        <!-- Roles -->
                        <div class="col-12 col-sm-6">

                            <label for="">Rol</label>
                            
                            <!-- seleccionar el rol de la base de datos -->
                            <select class="form-control" name="id_rol" id="id_rol" required>

                                <option value="">Selecionar rol</option>
                                
                                <?php foreach ($roles as $rol) { ?>
                                    
                                    <option value="<?php echo $rol['id_rol']?>"
                                    
                                    <?php 
                                        if ($usuario['id_rol'] == $rol['id_rol']) {

                                                echo 'selected';

                                        }
                                    ?>
                                    >

                                    <?php echo $rol['nombre']?></option>
                                    
                                <?php }?>
                            </select>
                        </div>
                    </div>
                </div>

                <a href="<?php echo base_url() ?>usuario" class="btn btn-primary my-3">Regresar</a>
                <button type="submit" class="btn btn-success my-3">Guardar</button>
            </form>

        </div>
    </main>