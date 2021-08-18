// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_AUTO = '../../app/api/dashboard/automoviles.php?action=';
const ENDPOINT_MARCA = '../../app/api/dashboard/automoviles.php?action=readAll2';
const ENDPOINT_MODELO = '../../app/api/dashboard/automoviles.php?action=readAll3';
const ENDPOINT_CLASE = '../../app/api/dashboard/automoviles.php?action=readAll4';
const ENDPOINT_CLIENTE = '../../app/api/dashboard/automoviles.php?action=readAll5';
const ENDPOINT_DETALLE = '../../app/api/dashboard/automoviles.php?action=readAll6';
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
                <td>${row.modelo}</td>
                <td>${row.color}</td>
                <td>${row.numero_motor}</td>
                <td>${row.clase_auto}</td>
                <td>${row.repuesto}</td>
                <td>${row.placa}</td>
                <td>${row.nombres_c}</td>
                <td>
                    <a href="#" onclick="openUpdateDialog(${row.id_automovil})" class="btn waves-effect blue tooltipped" data-tooltip="Actualizar"><i class="material-icons">mode_edit</i></a>
                    <a href="#" onclick="openDeleteDialog(${row.id_automovil})" class="btn waves-effect red tooltipped" data-tooltip="Eliminar"><i class="material-icons">delete</i></a>
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
    searchRows(API_AUTO, 'search-form');
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
    fillSelect(ENDPOINT_CLASE, 'clase', null);
    fillSelect(ENDPOINT_CLIENTE, 'cliente', null);
    fillSelect(ENDPOINT_DETALLE, 'detalle', null);
}

// Función para preparar el formulario al momento de modificar un registro.
function openUpdateDialog(id) {
    // Se restauran los elementos del formulario.
    document.getElementById('save-form').reset();
    // Se abre la caja de dialogo (modal) que contiene el formulario.
    let instance = M.Modal.getInstance(document.getElementById('save-modal'));
    instance.open();
    // Se asigna el título para la caja de dialogo (modal).
    document.getElementById('modal-title').textContent = 'Actualizar automovil';


    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('id_automovil', id);

    fetch(API_AUTO + 'readOne', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('id_automovil').value = response.dataset.id_automovil;
                    fillSelect(ENDPOINT_MARCA, 'marca', response.dataset.id_marca);
                    fillSelect(ENDPOINT_MODELO, 'modelo', response.dataset.id_modelo);
                    document.getElementById('color').value = response.dataset.color;
                    document.getElementById('motor').value = response.dataset.numero_motor;
                    fillSelect(ENDPOINT_CLASE, 'clase', response.dataset.id_clase_auto);
                    fillSelect(ENDPOINT_DETALLE, 'detalle', response.dataset.id_detalle_rep);
                    document.getElementById('placa').value = response.dataset.placa;
                    fillSelect(ENDPOINT_CLIENTE, 'cliente', response.dataset.id_cliente);
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
    (document.getElementById('id_automovil').value) ? action = 'update' : action = 'create';
    // Se llama a la función para guardar el registro. Se encuentra en el archivo components.js
    saveRow(API_AUTO, action, 'save-form', 'save-modal');
});

// Función para establecer el registro a eliminar y abrir una caja de dialogo de confirmación.
function openDeleteDialog(id) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('id_automovil', id);
    // Se llama a la función que elimina un registro. Se encuentra en el archivo components.js
    confirmDelete(API_AUTO, data);
}

//Funcion para cargar los modelos de los automoviles a partir de su marca
function cargarModelos()
{
    let value = document.getElementById('marca').value;
    fillSelect(ENDPOINT_MODELO+'&marca='+value, 'modelo', null);

}