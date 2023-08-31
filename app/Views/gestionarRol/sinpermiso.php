<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h2 class="my-3 mx-3">
            <i class="fa-solid fa-lock"></i> No tiene acceso a este módulo
            </h2>
            <div>
                <label for="" class="form-label fw-bold"><i class="text-danger">*</i>
                    Contacte con el administrador del sistema.
                </label>
            </div>

            <div class="modal fade" id="modal-acceso" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <h5 class="modal-title" id="exampleModalLabel">
                            <i class="fa-solid fa-triangle-exclamation" style="color: #ffe53d;"></i> No autorizado
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="fst-italic">No tiene permiso para acceder a este módulo.</p>
                            <p class='fst-italic'>Por favor contacte con el administrador.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Entendido</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        $(document).ready(function() {
            $('#modal-acceso').modal('show');
        });
    </script>