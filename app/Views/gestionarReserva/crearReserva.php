<?php
$id_notaReserva = uniqid();
$fecha_actual = date("d/m/Y");
?>

<style>
    body {
        background-color: #f5f5f5;
    }

    .container-fluid {
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 30px;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-success:hover {
        background-color: #1f8d3f;
        border-color: #1f8d3f;
    }

    .form-label {
        font-weight: bold;
    }

    .table {
        font-size: 14px;
    }

    .table thead th {
        background-color: #343a40;
        color: #ffffff;
    }

    .table tbody tr:hover {
        background-color: rgba(52, 58, 64, 0.1);
    }

    .btn-outline-secondary {
        border-color: #ced4da;
        color: #495057;
    }
</style>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
        <h4 class="mt-4"><?php echo $titulo ?></h4>

            <div>
                <input type="hidden" class="alert alert-danger w-100" id="alerta">
                </input>

            </div>

            <form method="POST" id="form-nota-reserva" name="form-nota-reserva" action="<?php echo base_url() ?>reserva/guarda" autocomplete="off">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <!-- input para captura el id de producto y compra -->
                            <input type="hidden" id="nro_habitacion" name="nro_habitacion">
                            <input type="hidden" id="id_notaReserva" name="id_notaReserva" value="<?php echo $id_notaReserva ?>">

                            <label for="">Nro Habitación</label>
                            <div class="d-flex">
                                <input class="form-control" id="nro_habitacion_temp" name="nro_habitacion_temp" type="text" placeholder="Escribe el número y enter" onkeyup="buscarHabitacion(event, this, this.value)" autofocus>
                                <!-- (evento, this(nombre_categoria de elemento "nro_habitacion"), valor del input) -->

                                <!-- boton para el modal -->
                                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#lista" title="Lista de habitaciones"><i class="fas fa-list-ol"></i></button>
                            </div>
                            <label for="nro_habitacion" id="resultado_error" style="color: red"></label>
                        </div>

                        <div class="col-12 col-sm-4">
                            <label for="">Fecha de entrada</label>
                            <!--set_value cuando de actualiza el formulario no se pierde lo que el usuario escribio -->
                            <input  class="form-control" id="fechaEntrada" name="fechaEntrada" type="date">
                        </div>

                        <div class="col-12 col-sm-4">
                            <label for="">Fecha de salida</label>
                            <!--set_value cuando de actualiza el formulario no se pierde lo que el usuario escribio -->
                            <input class="form-control" id="fechaSalida" name="fechaSalida" type="date">
                        </div>

                    </div>
                </div>

                <div class="form-group">
                    <div class="row">

                        <div class="col-12 col-sm-4">
                            <label for="">Nombre de la categoria</label>
                            <input class="form-control" id="nombre_categoria" name="nombre_categoria" type="text" disabled>
                        </div>

                        <div class="col-12 col-sm-4">
                            <label for="">Precio de la habitación</label>
                            <!--set_value cuando de actualiza el formulario no se pierde lo que el usuario escribio -->
                            <input class="form-control" id="precio" name="precio" type="text" disabled>
                        </div>

                        <div class="col-12 col-sm-4">
                            <label for="">Subtotal</label>
                            <input class="form-control" id="subtotal" name="subtotal" type="text" disabled>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">

                        <div class="col-12 col-sm-4">
                            <label for="">Cliente</label>

                            <div class="d-flex">
                                <!--set_value cuando de actualiza el formulario no se pierde lo que el usuario escribio -->
                                <input class="form-control" id="id_cliente" name="id_cliente" type="hidden">
                                <input class="form-control" id="cliente_nombre" name="cliente_nombre" type="text" disabled>


                                <button class="btn btn-outline-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" title="Lista clientes"><i class="fas fa-list-ol"></i></button>
                            </div>
                        </div>

                        <!-- <div class="col-12 col-sm-4">
                            <label for="">Reserva</label>
                            <select class="form-control" name="id_reserva" id="id_reserva">
                                <option value="">Seleccionar reserva</option>
                                <option value="0">Sin reserva</option>
                            </select>
                        </div> -->

                        <div class="col-12 col-sm-4">
                            <!-- &nbsp espacio en blanco -->
                            <label for=""> <br> &nbsp;</label>
                            <!--set_value cuando de actualiza el formulario no se pierde lo que el usuario escribio -->
                            <button id="agregar_servicio" name="agregar_servicio" type="button" class="btn btn-primary" onclick="agregarReserva(nro_habitacion.value, 0, '<?php echo $id_notaReserva; ?>')">Agregar habitación</button>
                        </div>
                    </div>
                </div>

                <div class="row my-3">
                    <table id="tablaReservas" class="table table-hover table-striped table-sm table-responsive tablaReservas" width="100%">
                        <thead class="bg-dark text-light text-center">
                            <th>#</th>
                            <th>Nro habitación</th>
                            <th>Nombre categoria</th>
                            <th>precio</th>
                            <th>subtotal</th>
                            <th>Cliente</th>
                            <!-- <th>Reserva</th> -->
                            <th>Cantidad de días</th>
                            <th whidth="1%"></th>
                        </thead>
                        <tbody>
                        </tbody>

                    </table>
                </div>

                <div class="row">
                    <div class="col-12 col-sm-8 offset-md-6">
                        <label style="font-weight: bold; font-size: 30px; text-align: center;" for="">
                            Total $
                        </label>
                        <input type="text" id="total" name="total" size="7" readonly="true" value="0.00" style="font-weight: bold; font-size: 30px; text-align: center;">
                        <button type="button" id="completa-hospedaje" class="btn btn-success my-3">Agregar reserva</button>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <!-- modal para la lista de habitaciones -->
    <div class="modal fade modal-fullscreen-md-down" id="lista" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title w-100 text-center fw-bold" id="exampleModalLabel">HABITACIONES DISPONIBLES</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Nro</th>
                                    <th>Numero de camas</th>
                                    <th>Categoria</th>
                                    <th>Estado habitación</th>
                                    <th>Estado Activo</th>
                                    <th width="1%"></th>
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
                                            <a class="badge bg-dark" onclick="buscarHabitacion2(<?php echo $habitacion['nro_habitacion'] ?>)" rel="tooltip" data-placement="top" title="Seleccionar"> <i class="fas fa-plus"></i></a>
                                        </td>
                                    </tr>
                                <?php  } ?>
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


    <!-- OFFCANVAS para clientes-->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel" style="width: 450px;">
        <div class="offcanvas-header">
            <h3 class="offcanvas-title" id="offcanvasRightLabel">Lista de clientes</h3>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <table id="datatablesSimple" class="table">
                <thead>
                    <tr>
                        <th>Nro</th>
                        <th>CI</th>
                        <th>Nombre</th>
                        <th>Paterno</th>
                        <th>Sexo</th>
                        <th width="1%"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clientes as $cliente) { ?>
                        <tr>
                            <td><?php echo $cliente['id_cliente'] ?></td>
                            <td><?php echo $cliente['ci'] ?></td>
                            <td><?php echo $cliente['nombre'] ?></td>
                            <td><?php echo $cliente['paterno'] ?></td>
                            <td><?php echo $cliente['sexo'] ?></td>
                            <td>
                                <a class="badge bg-dark" data-bs-toggle="tooltip" onclick="buscarCliente(<?php echo $cliente['id_cliente'] ?>)" data-bs-placement="top" title="Seleccionar">
                                    <i class="fas fa-plus"></i>
                                </a>
                            </td>
                        </tr>
                    <?php  } ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        const botonCompletar = document.getElementById("completa-hospedaje");
        const tablaHospedaje = document.getElementById("tablaReservas");
        const form = document.getElementById("form-nota-reserva");

        botonCompletar.addEventListener("click", function() {
            let nFila = tablaHospedaje.rows.length; // Usar tablaServicio.rows.length para obtener la cantidad de filas en la tabla
            if (nFila < 2) {
                //mostrar mensaje
                alert("¡No hay hospedaje agregados!");
            } else {
                form.submit();
            }
        });


        function buscarHabitacion(e, tagCodigo, nro_habitacion) {
            let enterKey = 13; //codigo ascii del enter
            if (nro_habitacion != '') {

                if (e.which == enterKey) {
                    //usando ajax
                    $.ajax({
                        url: '<?php echo base_url(); ?>habitacion/buscarPorId/' + nro_habitacion,
                        dataType: 'json',


                        success: function(resultado) {
                            if (resultado == 0) {
                                $(tagCodigo).val('');
                            } else {
                                $(tagCodigo).removeClass('has-error'); //clase eliminada
                                $("#resultado_error").html(resultado.error);

                                if (resultado.existe) {
                                    $('#nro_habitacion').val(resultado.data.nro_habitacion);
                                    $('#nombre_categoria').val(resultado.data.nombre_categoria);
                                    $('#precio').val(resultado.data.precio);
                                    $('#subtotal').val(resultado.data.precio);
                                    $('#fechaEntrada').focus();

                                } else {
                                    $('#nro_habitacion').val('');
                                    $('#nombre_categoria').val('');
                                    $('#precio').val('');
                                    $('#subtotal').val('');
                                }
                            }
                        }
                    });
                }
            }
        }

        function buscarHabitacion2(nro_habitacion) {
            $.ajax({
                url: '<?php echo base_url(); ?>habitacion/buscarPorId/' + nro_habitacion,
                dataType: 'json',
                success: function(resultado) {
                    if (resultado == 0) {
                        $(tagCodigo).val('');
                    } else {
                        $("#resultado_error").html(resultado.error);
                        if (resultado.existe) {
                            $('#nro_habitacion').val(resultado.data.nro_habitacion);
                            $('#nro_habitacion_temp').val(resultado.data.nro_habitacion);
                            $('#nombre_categoria').val(resultado.data.nombre_categoria);
                            $('#precio').val(resultado.data.precio);
                            $('#subtotal').val(resultado.data.precio);
                            $('#fechaEntrada').focus();
                        }
                        $('#lista').modal('hide');
                    }
                }
            });
        }

        function buscarCliente(id_cliente) {
            $.ajax({
                url: '<?php echo base_url(); ?>cliente/buscarPorId/' + id_cliente,
                dataType: 'json',
                success: function(resultado) {
                    if (resultado == 0) {
                        $(tagCodigo).val('');
                    } else {
                        $("#resultado_error").html(resultado.error);
                        if (resultado.existe) {
                            $('#id_cliente').val(resultado.data.id_cliente);
                            $('#cliente_nombre')
                                .val(resultado.data.nombre + " " + resultado.data.paterno);
                        }
                    }
                }
            });
        }


        function buscarReserva(id_cliente) {
            $.ajax({
                url: '<?php echo base_url(); ?>reserva/buscarPorIdCliente/' + id_cliente,
                dataType: 'json',
                success: function(resultado) {
                    if (resultado == 0) {
                        $(tagCodigo).val('');
                    } else {
                        $("#resultado_error").html(resultado.error);
                        if (resultado.existe) {
                            
                            
                        }
                    }
                }
            });
        }


        function agregarReserva(nro_habitacion, cantidad, id_notaReserva) {

            const alerta = document.getElementById('alerta');
            cantidad = diferenciaEnDias($('#fechaEntrada').val(), $('#fechaSalida').val());

            //capturar el id_cliente y id_reserva
            var id_cliente = $('#id_cliente').val();
            id_reserva = 0;

            //para las validaciones
            var mensajeAlerta = "";
            alerta.setAttribute('type', 'hidden');
            alerta.value = mensajeAlerta;
            var existeClienteReserva = true;

            //validando campos
            if (id_cliente == '') {
                alerta.setAttribute('type', 'text');
                existeClienteReserva = false;
                mensajeAlerta = "- Debe llenar el campo *Cliente";
            }
            /*if (id_reserva == '') {
                alerta.setAttribute('type', 'text');
                existeClienteReserva = false;
                mensajeAlerta += " - Debe llenar el campo *Reserva";
            }*/
            alerta.value = mensajeAlerta;


            if (nro_habitacion != null && id_notaReserva != 0 && cantidad >= 0 && existeClienteReserva) {
                //utilizando ajax
                //primero va a la url, y hace todo lo que se le indica
                $.ajax({
                    url: '<?php echo base_url(); ?>temporalReserva/insertar/' + nro_habitacion + "/" + cantidad + "/" + id_notaReserva + "/" + id_cliente + "/" + id_reserva,

                    //una vez haya hecho todo, captura todo en resultado
                    success: function(resultado) {
                        if (resultado == 0) {

                        } else {
                            //transforma los datos a json
                            var resultado = JSON.parse(resultado);
                            if (resultado != '') {

                                //busca el body y lo limpia con empy
                                $('#tablaReservas tbody').empty();
                                $('#tablaReservas tbody').append(resultado.datos);
                                $('#total').val(resultado.total);

                                //limpiar los input
                                $('#nro_habitacion').val('');
                                $('#nombre_categoria').val('');
                                $('#precio').val('');
                                $('#subtotal').val('');
                            }
                        }
                    }
                });
            }
        }

        function eliminarHabitacion(nro_habitacion, id_notaReserva) {
            //usando ajax
            $.ajax({
                url: '<?php echo base_url(); ?>temporalReserva/eliminar/' + nro_habitacion + "/" + id_notaReserva,
                success: function(resultado) {
                    if (resultado == 0) {
                        //$(tagCodigo).val('');
                    } else {
                        var resultado = JSON.parse(resultado);
                        $('#tablaReservas tbody').empty();
                        $('#tablaReservas tbody').append(resultado.datos);
                        $('#total').val(resultado.total);
                    }
                }
            });
        }

        function diferenciaEnDias(fechaInicio, fechaFin) {
            const fechaInicial = new Date(fechaInicio);
            const fechaFinal = new Date(fechaFin);

            // Calcula la diferencia en milisegundos entre las dos fechas
            const diferenciaMilisegundos = fechaFinal - fechaInicial;

            // Convierte la diferencia de milisegundos a días
            const milisegundosPorDia = 1000 * 60 * 60 * 24;
            const diferenciaDias = Math.floor(diferenciaMilisegundos / milisegundosPorDia);

            return diferenciaDias;
        }
    </script>