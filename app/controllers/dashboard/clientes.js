// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_CLIENTES = '../../app/api/dashboard/clientes.php?action=';
// Método manejador de eventos que se ejecuta cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', function () {
    // Se llama a la función que obtiene los registros para llenar la tabla. Se encuentra en el archivo components.js
    readRows(API_CLIENTES);
});

// Función para llenar la tabla con los datos de los registros. Se manda a llamar en la función readRows().
function fillTable(dataset) {
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
            <tr>
                <td>${row.nombres_c}</td>
                <td>${row.apellidos_c}</td>
                <td>${row.dui_c}</td>
                <td>${row.email_c}</td>
                <td>${row.alias_c}</td>
                <td>${row.telefono_c}</td>
                <td>${row.fecha_nac}</td>
                <td>
                    <a href="#" onclick="openUpdateDialog(${row.id_cliente})" class="btn waves-effect blue tooltipped" data-tooltip="Actualizar"><i class="material-icons">mode_edit</i></a>
                    <a href="#" onclick="openDeleteDialog(${row.id_cliente})" class="btn waves-effect red tooltipped" data-tooltip="Eliminar"><i class="material-icons">delete</i></a>
                    <a href="../../app/reports/dashboard/cita_cliente.php?id=${row.id_cliente}" target="_blank" class="btn waves-effect amber tooltipped" data-tooltip="Reporte de citas por cliente"><i class="material-icons">assignment</i></a>
                    <a href="#" onclick="openGraficaCita(${row.id_cliente})" class="btn waves-effect green darken-1 tooltipped" data-tooltip="Grafica de cantidad de citas por cliente"><i class="material-icons">poll</i></a>
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
    searchRows(API_CLIENTES, 'search-form');
});

// Función para preparar el formulario al momento de insertar un registro.
function openCreateDialog() {
    // Se restauran los elementos del formulario.
    document.getElementById('save-form').reset();
    // Se abre la caja de dialogo (modal) que contiene el formulario.
    let instance = M.Modal.getInstance(document.getElementById('save-modal'));
    instance.open();
    // Se asigna el título para la caja de dialogo (modal).
    document.getElementById('modal-title').textContent = 'Crear cliente';
    // Se habilitan los campos de alias y contraseña.
    document.getElementById('alias').disabled = false;
    document.getElementById('confirmar_clave').disabled = false;
    document.getElementById('clave_cliente').disabled = false;
    let today = new Date();
    // Se declara e inicializa una variable para guardar el día en formato de 2 dígitos.
    let day = ('0' + today.getDate()).slice(-2);
    // Se declara e inicializa una variable para guardar el mes en formato de 2 dígitos.
    var month = ('0' + (today.getMonth() + 1)).slice(-2);
    // Se declara e inicializa una variable para guardar el año con la mayoría de edad.
    let year = today.getFullYear() - 18;
    // Se declara e inicializa una variable para establecer el formato de la fecha.
    let date = `${year}-${month}-${day}`;
    // Se asigna la fecha como valor máximo en el campo del formulario.
    document.getElementById('nacimiento_cliente').setAttribute('max', date);
}

// Función para preparar el formulario al momento de modificar un registro.
function openUpdateDialog(id) {
    // Se restauran los elementos del formulario.
    document.getElementById('save-form').reset();
    // Se abre la caja de dialogo (modal) que contiene el formulario.
    let instance = M.Modal.getInstance(document.getElementById('save-modal'));
    instance.open();
    // Se asigna el título para la caja de dialogo (modal).
    document.getElementById('modal-title').textContent = 'Actualizar cliente';
    // Se deshabilitan los campos de alias y contraseña.
    document.getElementById('alias').disabled = true;
    document.getElementById('confirmar_clave').disabled = true;
    document.getElementById('clave_cliente').disabled = true;

    let today = new Date();
    // Se declara e inicializa una variable para guardar el día en formato de 2 dígitos.
    let day = ('0' + today.getDate()).slice(-2);
    // Se declara e inicializa una variable para guardar el mes en formato de 2 dígitos.
    var month = ('0' + (today.getMonth() + 1)).slice(-2);
    // Se declara e inicializa una variable para guardar el año con la mayoría de edad.
    let year = today.getFullYear() - 18;
    // Se declara e inicializa una variable para establecer el formato de la fecha.
    let date = `${year}-${month}-${day}`;
    // Se asigna la fecha como valor máximo en el campo del formulario.
    document.getElementById('nacimiento_cliente').setAttribute('max', date);
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('id_cliente', id);

    fetch(API_CLIENTES + 'readOne', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('id_cliente').value = response.dataset.id_cliente;
                    document.getElementById('nombres_cliente').value = response.dataset.nombres_c;
                    document.getElementById('apellidos_cliente').value = response.dataset.apellidos_c;
                    document.getElementById('correo_cliente').value = response.dataset.email_c;
                    document.getElementById('telefono_cliente').value = response.dataset.telefono_c;
                    document.getElementById('dui_cliente').value = response.dataset.dui_c;
                    document.getElementById('nacimiento_cliente').value = response.dataset.fecha_nac;
                    document.getElementById('cb_genero').value = response.dataset.genero;
                    // Se actualizan los campos para que las etiquetas (labels) no queden sobre los datos.
                    M.updateTextFields();
                    // Se inicializa el componente Select del formulario para que muestre las opciones.
                    M.FormSelect.init(document.querySelectorAll('select'));
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
    (document.getElementById('id_cliente').value) ? action = 'update' : action = 'create';
    // Se llama a la función para guardar el registro. Se encuentra en el archivo components.js
    saveRow(API_CLIENTES, action, 'save-form', 'save-modal');
});

// Función para establecer el registro a eliminar y abrir una caja de dialogo de confirmación.
function openDeleteDialog(id) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('id_cliente', id);
    // Se llama a la función que elimina un registro. Se encuentra en el archivo components.js
    confirmDelete(API_CLIENTES, data);
}

function openGraficaCita(id){
    // Se abre la caja de dialogo (modal) que contiene el formulario.
    var modal = document.getElementById('grafica-modal');
    var instance = M.Modal.init(modal);
    instance.open();
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('id_cliente', id);
    fetch(API_CLIENTES + 'cantidadCitasCliente', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se remueve la etiqueta canvas de la gráfica.
                if (response.status) {
                    // Se declaran los arreglos para guardar los datos por gráficar.
                    let clientes = [];
                    let cantidad = [];
                    // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
                    response.dataset.map(function (row) {
                        // Se asignan los datos a los arreglos.
                        clientes.push(row.nombres_c);
                        cantidad.push(row.cantidad);
                    });
                    // Se llama a la función que genera y muestra una gráfica de barras. Se encuentra en el archivo components.js
                    barGraph('chart1', clientes, cantidad, 'Cantidad de citas', 'Cantidad de citas del cliente',row.nombres_c);
                } else {
                    document.getElementById('chart1').remove();
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}