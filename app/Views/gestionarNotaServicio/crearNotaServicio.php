<?php
$id_notaServicio = uniqid();
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
        <h4 class="mt-4"><?php echo $titulo ?></h4>
            <div>
                <input type="hidden" class="alert alert-danger w-100" id="alerta">
                </input>

            </div>

            <form method="POST" id="form-nota-servicio" name="form-nota-servicio" action="<?php echo base_url() ?>notaservicio/guarda" autocomplete="off">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <!-- input para captura el id de producto y compra -->
                            <input type="hidden" id="id_servicio" name="id_servicio">
                            <input type="hidden" id="id_notaServicio" name="id_notaServicio" value="<?php echo $id_notaServicio ?>">

                            <label for="">Nro servicio</label>
                            <div class="d-flex">
                                <input class="form-control" id="nro_servicio" name="nro_servicio" type="text" placeholder="Escribe el número y enter" onkeyup="buscarServicio(event, this, this.value)" autofocus>
                                <!-- (evento, this(nombre de elemento "nro_servicio"), valor del input) -->

                                <!-- boton para el modal -->
                                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#lista"><i class="fas fa-list-ol"></i></button>
                            </div>
                            <label for="nro_servicio" id="resultado_error" style="color: red"></label>
                        </div>

                        <div class="col-12 col-sm-4">
                            <label for="">Nombre del servicio</label>
                            <input class="form-control" id="nombre" name="nombre" type="text" disabled>
                        </div>

                        <div class="col-12 col-sm-4">
                            <label for="">Cantidad</label>
                            <!--set_value cuando de actualiza el formulario no se pierde lo que el usuario escribio -->
                            <input class="form-control" id="cantidad" name="cantidad" type="text">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <label for="">Precio del servicio</label>
                            <!--set_value cuando de actualiza el formulario no se pierde lo que el usuario escribio -->
                            <input class="form-control" id="precio" name="precio" type="text" disabled>
                        </div>

                        <div class="col-12 col-sm-4">
                            <label for="">Subtotal</label>
                            <input class="form-control" id="subtotal" name="subtotal" type="text" disabled>
                        </div>

                        <div class="col-12 col-sm-4">
                            <label for="">Cliente</label>
                            <!--set_value cuando de actualiza el formulario no se pierde lo que el usuario escribio -->
                            <select class="form-control" name="id_cliente" id="id_cliente" required>
                                <option value="">Seleccionar cliente</option>

                                <?php foreach ($clientes as $cliente) { ?>

                                    <option value="<?php echo $cliente['id_cliente'] ?>">
                                        <?php echo $cliente['nombre'] . " " . $cliente['paterno'] ?>
                                    </option>

                                <?php } ?>
                            </select>
                        </div>

                        
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        
                        <div class="col-12 col-sm-4">
                            <label for="">Hospedaje</label>
                            <!--set_value cuando de actualiza el formulario no se pierde lo que el usuario escribio -->
                            <select class="form-control" name="id_notaHospedaje" id="id_notaHospedaje">
                                <option value="">Seleccionar hospedaje</option>
                                <option value="0">Sin hospedaje</option>

                                <?php foreach ($notaHospedajes as $notahospedaje) {
                                ?>

                                <option value="<?php echo $notahospedaje['id_notaHospedaje']
                                                ?>">
                                    <?php echo $notahospedaje['id_notaHospedaje']
                                    ?>
                                </option>

                                <?php }
                                ?>
                            </select>
                        </div>

                        <div class="col-12 col-sm-4">
                            <!-- &nbsp espacio en blanco -->
                            <label for=""> <br> &nbsp;</label>
                            <!--set_value cuando de actualiza el formulario no se pierde lo que el usuario escribio -->
                            <button id="agregar_servicio" name="agregar_servicio" type="button" class="btn btn-primary" onclick="agregarServicio(id_servicio.value, cantidad.value, '<?php echo $id_notaServicio; ?>')">Agregar servicio</button>
                        </div>
                    </div>
                </div>

                <div class="row my-3">
                    <table id="tablaServicios" class="table table-hover table-striped table-sm table-responsive tablaServicios" width="100%">
                        <thead class="bg-dark text-light">
                            <th>Nro servicio</th>
                            <th>Nombre servicio</th>
                            <th>cantidad</th>
                            <th>precio</th>
                            <th>subtotal</th>
                            <th>Cliente</th>
                            <th>Hospedaje</th>
                            <th whidth="1%"></th>
                        </thead>
                        <tbody>
                        </tbody>

                    </table>
                </div>

                <div class="row">
                    <div class="col-12 col-sm-6 offset-md-6">
                        <label style="font-weight: bold; font-size: 30px; text-align: center;" for="">
                            Total Bs.
                        </label>
                        <input type="text" id="total" name="total" size="7" readonly="true" value="0.00" style="font-weight: bold; font-size: 30px; text-align: center;">
                        <button type="button" id="completa-servicio" class="btn btn-success">Completar servicio</button>
                    </div>
                </div>
            </form>
        </div>
    </main>


    <!-- Modal lista de servicios-->
    <div class="modal fade" id="lista" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title w-100 text-center fw-bold" id="exampleModalLabel">LISTA DE SERVICIOS</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Nro</th>
                                    <th>Nombre de servicio</th>
                                    <th>Descripción</th>
                                    <th>Precio</th>
                                    <th width="1%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($servicios as $servicio) { ?>
                                    <tr>
                                        <td class="align-middle"> <?php echo $servicio['id_servicio'] ?></td>
                                        <td class="align-middle"> <?php echo $servicio['nombre'] ?></td>
                                        <td class="align-middle"> <?php echo $servicio['descripcion'] ?></td>
                                        <td class="align-middle"> <?php echo $servicio['precio'] ?></td>
                                        <td>
                                            <a class="badge bg-dark" onclick="buscarServicio2(<?php echo $servicio['id_servicio'] ?>)" rel="tooltip" data-placement="top" title="Seleccionar"> <i class="fas fa-plus"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


    <!-- ajax -->
    <script>
        const botonCompletar = document.getElementById("completa-servicio");
        const tablaServicio = document.getElementById("tablaServicios");
        const form = document.getElementById("form-nota-servicio");
        botonCompletar.addEventListener("click", function() {
            let nFila = tablaServicio.rows.length; // Usar tablaServicio.rows.length para obtener la cantidad de filas en la tabla
            if (nFila < 2) {
                //mostrar mensaje
                alert("¡No hay servicio agregados!");
            } else {
                form.submit();
            }
        });


        // $(document).ready(function(){

        //     $('#completa-servicio').click(function(){
        //         //longitu de las filas de la tabla
        //         let nFila = $('#tablaServicios').length;
        //         //si hay mas de 2 filas (la primera es el header)
        //         if (nFila < 2) {
        //             //mostrar mensaje;
        //         } else {
        //             //enviar la compra con el id del form
        //             $('#form-nota-servicio').submit();
        //         }
        //     });

        // });

        function buscarServicio(e, tagCodigo, nro_servicio) {
            let enterKey = 13; //codigo ascii del enter
            if (nro_servicio != '') {

                if (e.which == enterKey) {
                    //usando ajax
                    $.ajax({
                        url: '<?php echo base_url(); ?>servicio/buscarPorId/' + nro_servicio,
                        dataType: 'json',

                        
                        success: function(resultado) {
                            if (resultado == 0) {
                                $(tagCodigo).val('');
                            } else {
                                $(tagCodigo).removeClass('has-error'); //clase eliminada
                                $("#resultado_error").html(resultado.error);

                                if (resultado.existe) {
                                    $('#id_servicio').val(resultado.datos.id_servicio);
                                    $('#nombre').val(resultado.datos.nombre);
                                    $('#cantidad').val(1);
                                    $('#precio').val(resultado.datos.precio);
                                    $('#subtotal').val(resultado.datos.precio);
                                    $('#cantidad').focus();
                                } else {
                                    $('#id_servicio').val('');
                                    $('#nombre').val('');
                                    $('#cantidad').val(1);
                                    $('#precio').val('');
                                    $('#subtotal').val('');
                                }
                            }
                        }
                    });
                }
            }
        }


        function buscarServicio2(nro_servicio) {
            $.ajax({
                url: '<?php echo base_url(); ?>servicio/buscarPorId/' + nro_servicio,
                dataType: 'json',
                success: function(resultado) {
                    if (resultado == 0) {
                        $(tagCodigo).val('');
                    } else {
                        $("#resultado_error").html(resultado.error);
                        if (resultado.existe) {
                            $('#id_servicio').val(resultado.datos.id_servicio);
                            $('#nro_servicio').val(resultado.datos.id_servicio);
                            $('#nombre').val(resultado.datos.nombre);
                            $('#cantidad').val(1);
                            $('#precio').val(resultado.datos.precio);
                            $('#subtotal').val(resultado.datos.precio);
                            $('#cantidad').focus();
                            document.getElementById('cantidad').disabled = false;
                        }
                        $('#lista').modal('hide');
                    }
                }
            });
        }

        function agregarServicio(id_servicio, cantidad, id_notaServicio) {

            const alerta = document.getElementById('alerta');

            //capturar el id_cliente y id_notaHospedaje
            var id_cliente = $('#id_cliente').val();
            var id_notaHospedaje = $('#id_notaHospedaje').val();

            //para las validaciones
            var mensajeAlerta = "";
            alerta.setAttribute('type', 'hidden');
            alerta.value = mensajeAlerta;
            var existeClienteHospedaje = true;

            //validando campos
            if (id_cliente == '') {
                alerta.setAttribute('type', 'text');
                existeClienteHospedaje = false;
                mensajeAlerta = "- Debe llenar el campo *Cliente";
            }
            if (id_notaHospedaje == '') {
                alerta.setAttribute('type', 'text');
                existeClienteHospedaje = false;
                mensajeAlerta += " - Debe llenar el campo *Hospedaje";
            }
            alerta.value = mensajeAlerta;


            if (id_servicio != null && id_notaServicio != 0 && cantidad > 0 && existeClienteHospedaje) {
                //utilizando ajax
                //primero va a la url, y hace todo lo que se le indica
                $.ajax({
                    url: '<?php echo base_url(); ?>temporalservicio/insertar/' + id_servicio + "/" + cantidad + "/" + id_notaServicio + "/" + id_cliente + "/" + id_notaHospedaje,

                    //una vez haya hecho todo, captura todo en resultado
                    success: function(resultado) {
                        if (resultado == 0) {

                        } else {
                            //transforma los datos a json
                            var resultado = JSON.parse(resultado);
                            if (resultado != '') {
                                //busca el body y lo limpia con empy
                                $('#tablaServicios tbody').empty();
                                $('#tablaServicios tbody').append(resultado.datos);
                                $('#total').val(resultado.total);

                                //limpiar los input
                                $("#id_servicio").val('');
                                $("#nro_servicio").val('');
                                $("#nombre").val('');
                                $("#cantidad").val('');
                                $("#precio").val('');
                                $("#subtotal").val('');
                            }
                        }
                    }
                });
            }
        }

        function eliminarServicio(id_servicio, id_notaServicio) {
            //usando ajax
            $.ajax({
                url: '<?php echo base_url(); ?>temporalservicio/eliminar/' + id_servicio + "/" + id_notaServicio,
                success: function(resultado) {
                    if (resultado == 0) {
                        //$(tagCodigo).val('');
                    } else {
                        var resultado = JSON.parse(resultado);
                        $('#tablaServicios tbody').empty();
                        $('#tablaServicios tbody').append(resultado.datos);
                        $('#total').val(resultado.total);
                    }
                }
            });
        }
    </script>