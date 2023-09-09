//buscador
$(document).ready(function () {
    setupEditableCells();
});

//metodos para actualizar datos en la tabla
function setupEditableCells() {
    const editableCells = document.querySelectorAll(".editable");

    editableCells.forEach(cell => {
        cell.addEventListener("dblclick", handleCellDoubleClick);
    });
}

//controla el evento doble click para insertar los input y select
function handleCellDoubleClick(event) {
    if (event.target.textContent === "" ||
        event.target.parentNode.querySelector("td:first-child") === null) {
        return;
    }
    const targetCell = event.target;
    const field = targetCell.getAttribute("data-field");
    const currentValue = targetCell.textContent.trim(); //valor actual
    const idPermiso = targetCell.parentNode.querySelector("td:first-child").textContent; //valor del id (primer celda)

    if (field === "nombre_td") {
        //crear el input para editar
        createEditableInput(targetCell, idPermiso, field, currentValue);
    }
    if (field === "nombre_tipoPermiso" || field === "nombre_submodulo") {
        createEditableSelect(targetCell, idPermiso, field, currentValue);
    }

}

//crea el input para reemplazarlo con el td
function createEditableInput(cell, idPermiso, field, value) {
    const inputElement = document.createElement("textarea");
    inputElement.type = "text";
    inputElement.className = "edit-elemento";
    // inputElement.style.width = "170px"
    inputElement.style.height = "25px";
    inputElement.value = value;
    inputElement.setAttribute("data-original", value);
    inputElement.setAttribute("data-field", field);
    inputElement.setAttribute("data-id", idPermiso);

    cell.innerHTML = "";
    cell.appendChild(inputElement);
    inputElement.focus();

    inputElement.addEventListener("blur", handleInputBlur); //evento al perder el foco, funcion
}

//controla el evento blur del input
function handleInputBlur(event) {
    const inputElement = event.target;
    const newValue = inputElement.value.trim();
    const originalValue = inputElement.getAttribute("data-original");
    const idPermiso = inputElement.getAttribute("data-id");

    if (newValue !== originalValue && newValue !== "") {
        //método par actualizar el registro (nombre)
        updatePermisoNombre(idPermiso, newValue, inputElement);
        inputElement.parentNode.innerHTML = newValue;
    } else {
        if (newValue == "") {
            alertSwal('Campo vacío', 'No puede dejar el campo nombre vacío.', 'error');
        }
        inputElement.parentNode.innerHTML = originalValue;
    }
}

//crea el select para reemplazar con el td
function createEditableSelect(cell, idPermiso, field, value) {
    const options = field == "nombre_tipoPermiso" ? tipoPermisosJSON : submodulosJSON; //JSON viene de la vista
    const selectElement = document.createElement("select");
    selectElement.className = "edit-elemento";
    selectElement.setAttribute("data-original", value);
    selectElement.setAttribute("data-field", field);
    selectElement.setAttribute("data-id", idPermiso);

    options.forEach(option => {
        const optionElement = document.createElement("option");
        optionElement.value = option.id;
        optionElement.textContent = option.nombre;
        if (option.nombre === value) {
            optionElement.selected = true;
        }
        selectElement.appendChild(optionElement);
    });

    cell.innerHTML = "";
    cell.appendChild(selectElement);
    selectElement.focus();

    selectElement.addEventListener("blur", handleSelectBlur);
}

//controla el evento blur del select
function handleSelectBlur(event) {
    const selectElement = event.target;
    const newValue = selectElement.options[selectElement.selectedIndex].textContent;
    const originalValue = selectElement.getAttribute("data-original");
    const idPermiso = selectElement.getAttribute("data-id");
    const field = selectElement.getAttribute("data-field");

    if (newValue !== originalValue && document.body.contains(selectElement)) {
        if (field === "nombre_tipoPermiso") {
            //método para actualizar tipo permiso
            updatePermisoTipo(idPermiso, selectElement.value);
        } else {
            //método para actualizar el submodulo del permiso
            updatePermisoModulo(idPermiso, selectElement.value);
        }
    }
    selectElement.parentNode.innerHTML = newValue;
}

//actualiza el nombre del permiso a travéz de la petición ajax
function updatePermisoNombre(idPermiso, newValue) {
    $.ajax({
        url: "permiso/actualizarNombre/" + idPermiso + "/" + newValue,
        success: function (resultado) {
            const result = JSON.parse(resultado);
            if (result) {
                alertSwal('Realizado', 'Campo actualizado correctamente.', 'success');
            }
        },
        error: function (xhr, status, error) {
            console.error("Error en la petición actualizar nombre: ", error);
        }
    });
}

//actualiza el tipo de permiso del permisos a travéz de la petición ajax
function updatePermisoTipo(idPermiso, idPermisoTipo) {
    $.ajax({
        url: "permiso/actualizarTipoPermiso/" + idPermiso + "/" + idPermisoTipo,
        error: function (xhr, status, error) {
            console.error("Error en la petición actualizar permiso tipo: ", error);
        }
    });
}

//actualiza el submodulo del permiso a travéz de la petición ajax
function updatePermisoModulo(idPermiso, idPermisoSubmodulo) {
    $.ajax({
        url: "permiso/actualizarSubmodulo/" + idPermiso + "/" + idPermisoSubmodulo,
        error: function (xhr, status, error) {
            console.error("Error en la petición actualizar submodulo: ", error);
        }
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

///// Ya fue................ :D




