// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_Detalle_rep = '../../app/api/dashboard/reparaciones.php?action=';
const ENDPOINT_MARCA = '../../app/api/dashboard/automoviles.php?action=readAll2';
const ENDPOINT_MODELO = '../../app/api/dashboard/automoviles.php?action=readAll3';
// Método manejador de eventos que se ejecuta cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', function () {
    // Se llama a la función que obtiene los registros para llenar la tabla. Se encuentra en el archivo components.js
    readRows(API_AUTO);
});

// Función para llenar la tabla con los datos de los registros. Se manda a llamar en la función readRows().
function fillTable(dataset) {
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
            <tr>
                <td>${row.marca}</td>
                <td>${row.apellidos}</td>
                <td>${row.email_u}</td>
                <td>${row.tipo_usuario}</td>
                <td>${row.alias_u}</td>
                <td>${row.telefono_u}</td>
                <td>${row.dui_u}</td>
                <td><i class="material-icons">${icon}</i></td>
                <td>${row.sueldo}</td>
                <td>${row.especialidad}</td>
                <td>${row.fecha_nacimiento}</td>
                <td>
                    <a href="#" onclick="openUpdateDialog(${row.id_usuario})" class="btn waves-effect blue tooltipped" data-tooltip="Actualizar"><i class="material-icons">mode_edit</i></a>
                    <a href="#" onclick="openDeleteDialog(${row.id_usuario})" class="btn waves-effect red tooltipped" data-tooltip="Eliminar"><i class="material-icons">delete</i></a>
                </td>
            </tr>
        `;
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('tbody-rows').innerHTML = content;
    // Se inicializa el componente Tooltip asignado a los enlaces para que funcionen las sugerencias textuales.
    M.Tooltip.init(document.querySelectorAll('.tooltipped'));
}

// Método manejador de eventos que se ejecuta cuando se envía el formulario de buscar.
document.getElementById('search-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Se llama a la función que realiza la búsqueda. Se encuentra en el archivo components.js
    searchRows(API_USUARIOS, 'search-form');
});

// Función para preparar el formulario al momento de insertar un registro.
function openCreateDialog() {
    // Se restauran los elementos del formulario.
    document.getElementById('save-form').reset();
    // Se abre la caja de dialogo (modal) que contiene el formulario.
    let instance = M.Modal.getInstance(document.getElementById('save-modal'));
    instance.open();
    // Se asigna el título para la caja de dialogo (modal).
    document.getElementById('modal-title').textContent = 'Insertar automovil';
    // Se habilitan los campos de alias y contraseña.
    fillSelect(ENDPOINT_MARCA, 'marca', null);
    fillSelect(ENDPOINT_MODELO, 'modelo', null);
}

// Función para preparar el formulario al momento de modificar un registro.
function openUpdateDialog(id) {
    // Se restauran los elementos del formulario.
    document.getElementById('save-form').reset();
    // Se abre la caja de dialogo (modal) que contiene el formulario.
    let instance = M.Modal.getInstance(document.getElementById('save-modal'));
    instance.open();
    // Se asigna el título para la caja de dialogo (modal).
    document.getElementById('modal-title').textContent = 'Actualizar usuario';
    // Se deshabilitan los campos de alias y contraseña.
    document.getElementById('alias').disabled = true;
    document.getElementById('clave1').disabled = true;
    document.getElementById('clave2').disabled = true;

    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('id_usuario', id);

    fetch(API_USUARIOS + 'readOne', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('id_usuario').value = response.dataset.id_usuario;
                    document.getElementById('nombres').value = response.dataset.nombres_u;
                    document.getElementById('apellidos').value = response.dataset.apellidos;
                    document.getElementById('correo').value = response.dataset.email_u;
                    fillSelect(ENDPOINT_USUARIOS, 'tipo_usuario', response.dataset.id_tipo_usuario);
                    fillSelect(ENDPOINT_ESPECIALIDAD, 'especialidad', response.dataset.id_especialidad);
                    document.getElementById('telefono').value = response.dataset.telefono_u;
                    document.getElementById('dui_u').value = response.dataset.dui_u;
                    document.getElementById('sueldo').value = response.dataset.sueldo;
                    document.getElementById('fecha_nacimiento').value = response.dataset.fecha_nacimiento;
                    if (response.dataset.estado_usuario) {
                        document.getElementById('estado_usuario').checked = true;
                    } else {
                        document.getElementById('estado_usuario').checked = false;
                    }
                    // Se actualizan los campos para que las etiquetas (labels) no queden sobre los datos.
                    M.updateTextFields();
                } else {
                    sweetAlert(2, response.exception, null);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}

// Método manejador de eventos que se ejecuta cuando se envía el formulario de guardar.
document.getElementById('save-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Se define una variable para establecer la acción a realizar en la API.
    let action = '';
    // Se comprueba si el campo oculto del formulario esta seteado para actualizar, de lo contrario será para crear.
    (document.getElementById('id_usuario').value) ? action = 'update' : action = 'create';
    // Se llama a la función para guardar el registro. Se encuentra en el archivo components.js
    saveRow(API_AUTO, action, 'save-form', 'save-modal');
    fillSelect(ENDPOINT_USUARIOS, 'marca', null);
});

// Función para establecer el registro a eliminar y abrir una caja de dialogo de confirmación.
function openDeleteDialog(id) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('id_usuario', id);
    // Se llama a la función que elimina un registro. Se encuentra en el archivo components.js
    confirmDelete(API_USUARIOS, data);
}