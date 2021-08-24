// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_REP = '../../app/api/dashboard/reparaciones.php?action=';
const ENDPOINT_CITA = '../../app/api/dashboard/reparaciones.php?action=readAll2';
const ENDPOINT_ESTADO = '../../app/api/dashboard/reparaciones.php?action=readAll3';
const ENDPOINT_AUTO = '../../app/api/dashboard/reparaciones.php?action=readAll4';
// Método manejador de eventos que se ejecuta cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', function () {
    // Se llama a la función que obtiene los registros para llenar la tabla. Se encuentra en el archivo components.js
    readRows(API_REP);
});

// Función para llenar la tabla con los datos de los registros. Se manda a llamar en la función readRows().
function fillTable(dataset) {
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
            <tr>
                <td>${row.placa}</td>
                <td>${row.estado_reparacion}</td>
                <td>${row.nombres_u}</td>
                <td>${row.repuesto}</td>
                <td>${row.precio_repuesto}</td>
                <td>${row.mano_obra}</td>
                <td>
                    <a href="#" onclick="openUpdateDialog(${row.id_detalle_rep})" class="btn waves-effect blue tooltipped" data-tooltip="Actualizar"><i class="material-icons">mode_edit</i></a>
                    <a href="#" onclick="openDeleteDialog(${row.id_detalle_rep})" class="btn waves-effect red tooltipped" data-tooltip="Eliminar"><i class="material-icons">delete</i></a>
                    <a href="../../app/reports/dashboard/factura.php?id=${row.id_detalle_rep}" target="_blank" class="btn waves-effect amber tooltipped" data-tooltip="Factura"><i class="material-icons">receipt</i></a>
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
    searchRows(API_REP, 'search-form');
});

// Función para preparar el formulario al momento de insertar un registro.
function openCreateDialog() {
    // Se restauran los elementos del formulario.
    document.getElementById('save-form').reset();
    // Se abre la caja de dialogo (modal) que contiene el formulario.
    let instance = M.Modal.getInstance(document.getElementById('save-modal'));
    instance.open();
    // Se asigna el título para la caja de dialogo (modal).
    document.getElementById('modal-title').textContent = 'Insertar reparación';
    // Se habilitan los campos de alias y contraseña.
    fillSelect(ENDPOINT_CITA, 'auto', null);
    fillSelect(ENDPOINT_ESTADO, 'estado', null);
}

// Función para preparar el formulario al momento de modificar un registro.
function openUpdateDialog(id) {
    // Se restauran los elementos del formulario.
    document.getElementById('save-form').reset();
    // Se abre la caja de dialogo (modal) que contiene el formulario.
    let instance = M.Modal.getInstance(document.getElementById('save-modal'));
    instance.open();
    // Se asigna el título para la caja de dialogo (modal).
    document.getElementById('modal-title').textContent = 'Actualizar reparación';


    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('id_reparacion', id);

    fetch(API_REP + 'readOne', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('id_reparacion').value = response.dataset.id_detalle_rep;
                    fillSelect(ENDPOINT_CITA, 'cita', response.dataset.id_cita);
                    fillSelect(ENDPOINT_ESTADO, 'estado', response.dataset.id_estado_rep);
                    document.getElementById('repuesto').value = response.dataset.repuesto;
                    document.getElementById('precio_repuesto').value = response.dataset.precio_repuesto;
                    document.getElementById('obra').value = response.dataset.mano_obra;
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
    (document.getElementById('id_reparacion').value) ? action = 'update' : action = 'create';
    // Se llama a la función para guardar el registro. Se encuentra en el archivo components.js
    saveRow(API_REP, action, 'save-form', 'save-modal');
});

// Función para establecer el registro a eliminar y abrir una caja de dialogo de confirmación.
function openDeleteDialog(id) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('id_reparacion', id);
    // Se llama a la función que elimina un registro. Se encuentra en el archivo components.js
    confirmDelete(API_REP, data);
}

//Funcion para cargar los modelos de los automoviles a partir de su marca
function cargarAuto()
{
    let value = document.getElementById('auto').value;
    fillSelect(ENDPOINT_AUTO+'&cliente='+value, 'auto', null);

}
