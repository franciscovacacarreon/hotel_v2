<div id="layoutSidenav_content">
  <div class="container-fluid">
    <h4 class="mt-4"><?php echo $titulo ?></h4>

    <!-- para la lista de errores -->
    <?php if (isset($validation)) { ?>
      <div class="alert alert-danger">
        <?php echo $validation->listErrors(); ?>
      </div>
    <?php } ?>

    <div class="card">
      <div class="card-header p-2">
        <ul class="nav nav-pills">
          <li class="nav-item"><a id="link-submodulos" class="hyperlink nav-link active" href="#submodulos" data-toggle="tab"><i class="fas fa-user"></i>&nbsp;&nbsp;Submodulos</a></li>
          <li class="nav-item"><a id="link-agregar" class="hyperlink nav-link text-dark" href="#submodulos-agregar" data-toggle="tab"><i class="fas fa-plus"></i>&nbsp;&nbsp;Agregar</a></li>
          <li class="nav-item"><a id="link-eliminados" class="hyperlink nav-link text-dark" href="#submodulo-eliminados" data-toggle="tab"><i class="far fa-trash-alt"></i>&nbsp;&nbsp;Eliminados</a></li>
        </ul>
      </div>

      <div class="card-body">
        <div class="tab-content">
          <div class="active tab-pane" id="submodulos">
            <table id="datatable-submodulos" class="table-submodulos table table-responsive-xl table-bordered table-sm table-hover table-striped my-3">
              <thead>
                <tr>
                  <th> ID </th>
                  <th>Nombre</th>
                  <th>Modulo</th>
                  <th width="10%">Acción</th>
                </tr>
              </thead>
            </table>
          </div>
          <div class="tab-pane" id="submodulos-eliminados">
            <table id="" class="table table-responsive-xl table-bordered table-sm table-hover table-striped" style="width: 100%;">
              <thead>
                <tr>
                  <th width="4%"> ID </th>
                  <th>Nombre</th>
                  <th>Modulo</th>
                  <th>Acción</th>
                </tr>
              </thead>
            </table>
          </div>
          <div class="tab-pane" id="submodulo-agregar">
            <form id="form-agregar" method="POST" enctype="multipart/form-data" autocomplete="off" class="needs-validation" novalidate>
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label class="form-label" for="nombre">Nombre</label>
                    <input class="form-control" id="nombre" name="nombre" type="text" placeholder="Ingrese el nombre" autofocus required>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label class="form-label" for="id_modulo">Modulo</label>
                    <select class="form-select" name="id_modulo" id="id_modulo">
                      <option disabled value="">Seleccione un módulo</option>
                    </select required>
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-success my-3">Guardar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

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

  <script>
    const datatableSubmodulos = document.getElementById("datatable-submodulos");
    const submodulos = document.getElementById("submodulos");
    const submodulosEliminados = document.getElementById("submodulos-eliminados");
    const submoduloAgregar = document.getElementById("submodulo-agregar");
    const hyperlinks = document.querySelectorAll(".hyperlink");
    const form = $('#form-agregar');


    $(document).ready(function() {
      submoduloActivo(datatableSubmodulos);
      hyperlinksActive(hyperlinks);
      createSelectOption();
      agregar(form);
    });

    function hyperlinksActive(hyperlinks) {
      hyperlinks.forEach(hyperlink => {
        hyperlink.addEventListener("click", (event) => {
          event.preventDefault();
          event.target.className = "hyperlink nav-link active";
          tabPaneActive(event.target.id);

          hyperlinks.forEach(hyper => {
            if (event.target !== hyper) {
              hyper.className = "hyperlink nav-link text-dark";
            }
          });
        });
      });
    }

    function tabPaneActive(dataPane) {
      switch (dataPane) {
        case "link-submodulos":
          submodulos.className = "active tab-pane";
          submodulosEliminados.className = "tab-pane";
          submoduloAgregar.className = "tab-pane";
          break;
        case "link-eliminados":
          submodulos.className = "tab-pane";
          submodulosEliminados.className = "active tab-pane";
          submoduloAgregar.className = "tab-pane";
          break;
        case "link-agregar":
          submodulos.className = "tab-pane";
          submodulosEliminados.className = "tab-pane";
          submoduloAgregar.className = "active tab-pane";
          break;

        default:
          break;
      }
    }

    function createSelectOption() {
      const options = <?= json_encode($modulos) ?>;
      const selectElement = document.getElementById("id_modulo");
      options.forEach(option => {
        const optionElement = document.createElement("option");
        optionElement.value = option.id;
        optionElement.textContent = option.nombre;
        selectElement.appendChild(optionElement);
      });
    }

    function agregar(form) {
      form.submit((e) => {
        e.preventDefault();
        const URL = "submodulo/insertar";
        console.log(form[0]);
        $.ajax({
          url: URL,
          type: "POST",
          processData: false,
          contentType: false,
          data: new FormData(form[0]),
          success: (response) => {
            if (response === "true") {
              alertSwal("Registro insertado", "El registro se ha insertado correctamente.", "success");
              submoduloActivo(datatableSubmodulos); //recargar la tabla
            } else {
              alertSwal("Registro no insertado", "Debe llenar todos los campos.", "error");
            }
          },
          error: function(xhr, status, error) {
            console.error("Error en la petición actualizar nombre: ", error);
          }
        });

      });
    }

    function submoduloActivo(table) {
      $(table).DataTable({
        processing: true,
        serverSide: false,
        responsive: true,
        autoWidth: false,
        ordering: true,
        destroy: true,
        ajax: {
          url: "submodulo/indexJSON",
          dataType: 'json',
          type: 'GET',
          dataSrc: function(response) {
            return response.submodulos;
          }
        },
        columns: [
          {
            data: 'id_submodulo'
          },
          {
            data: 'nombre'
          },
          {
            data: 'id_modulo'
          },
          {
            data: 'accion'
          }
        ],
        searching: true,
        paging: true,
        language: {
          url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
        },
      });
    }

    function alertSwal(title, text, icon) {
      Swal.fire({
        title: title,
        text: text,
        icon: icon, // Icono de la alerta ('success', 'error', 'warning', 'info')
        timer: 3000,
        confirmButtonText: 'Aceptar' // Texto del botón de confirmación
      });
    }
  </script>