// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_MARCAS = '../../app/api/dashboard/marcas.php?action=';
//const ENDPOINT_MARCAS = '../../app/api/dashboard/usuarios.php?action=readAll2';
// Método manejador de eventos que se ejecuta cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', function () {
    // Se llama a la función que obtiene los registros para llenar la tabla. Se encuentra en el archivo components.js
    readRows(API_MARCAS);
});

// Función para llenar la tabla con los datos de los registros. Se manda a llamar en la función readRows().
function fillTable(dataset){
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function(row) {
        content += `
        <tr>
            <td>${row.marca}</td>
            <td>
                <a href="#" onclick="openUpdateDialog(${row.id_marca})" class="btn waves-effect blue tooltipped" data-tooltip="Actualizar"><i class="material-icons">mode_edit</i></a>
                <a href="#" onclick="openDeleteDialog(${row.id_marca})" class="btn waves-effect red tooltipped" data-tooltip="Eliminar"><i class="material-icons">delete</i></a>
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
    searchRows(API_MARCAS, 'search-form');
});

// Función para preparar el formulario al momento de insertar un registro.
function openCreateDialog() {
    // Se restauran los elementos del formulario.
    document.getElementById('save-form').reset();
    // Se abre la caja de dialogo (modal) que contiene el formulario.
    let instance = M.Modal.getInstance(document.getElementById('save-modal'));
    instance.open();
    // Se asigna el título para la caja de dialogo (modal).
    document.getElementById('modal-title').textContent = 'Agregar Marca';
    // Se habilitan los campos de alias y contraseña.
    //document.getElementById('clave1').disabled = false;
    //document.getElementById('clave2').disabled = false;
    //fillSelect(ENDPOINT_USUARIOS, 'tipo_usuario', null);
    //fillSelect(ENDPOINT_ESPECIALIDAD, 'especialidad', null);
    /*let today = new Date();
    // Se declara e inicializa una variable para guardar el día en formato de 2 dígitos.
    let day = ('0' + today.getDate()).slice(-2);
    // Se declara e inicializa una variable para guardar el mes en formato de 2 dígitos.
    var month = ('0' + (today.getMonth() + 1)).slice(-2);
    // Se declara e inicializa una variable para guardar el año con la mayoría de edad.
    let year = today.getFullYear() - 18;
    // Se declara e inicializa una variable para establecer el formato de la fecha.
    let date = `${year}-${month}-${day}`;
    // Se asigna la fecha como valor máximo en el campo del formulario.
    document.getElementById('fecha_nacimiento').setAttribute('max', date);*/
}

// Función para preparar el formulario al momento de modificar un registro.
function openUpdateDialog(id) {
    // Se restauran los elementos del formulario.
    document.getElementById('save-form').reset();
    // Se abre la caja de dialogo (modal) que contiene el formulario.
    let instance = M.Modal.getInstance(document.getElementById('save-modal'));
    instance.open();
    // Se asigna el título para la caja de dialogo (modal).
    document.getElementById('modal-title').textContent = 'Actualizar Marca';
    // Se deshabilitan los campos de alias y contraseña.
    
    /*document.getElementById('clave1').disabled = true;
    document.getElementById('clave2').disabled = true;*/

    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('id_marca', id);

    fetch(API_MARCAS + 'readOne', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('id_marca').value = response.dataset.id_marca;
                    document.getElementById('marca').value = response.dataset.marca;
                    /*document.getElementById('apellidos').value = response.dataset.apellidos;
                    document.getElementById('correo').value = response.dataset.email_u;
                    fillSelect(ENDPOINT_USUARIOS, 'tipo_usuario', response.dataset.id_tipo_usuario);
                    fillSelect(ENDPOINT_ESPECIALIDAD, 'especialidad', response.dataset.id_especialidad);
                    document.getElementById('telefono').value = response.dataset.telefono_u;
                    document.getElementById('dui_u').value = response.dataset.dui_u;
                    document.getElementById('sueldo').value = response.dataset.sueldo;
                    document.getElementById('fecha_nacimiento').value = response.dataset.fecha_nacimiento;*/
                    /*if (response.dataset.estado_usuario) {
                        document.getElementById('estado_usuario').checked = true;
                    } else {
                        document.getElementById('estado_usuario').checked = false;
                    }*/
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
    (document.getElementById('id_marca').value) ? action = 'update' : action = 'create';
    // Se llama a la función para guardar el registro. Se encuentra en el archivo components.js
    saveRow(API_MARCAS, action, 'save-form', 'save-modal');
});

// Función para establecer el registro a eliminar y abrir una caja de dialogo de confirmación.
function openDeleteDialog(id) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('id_marca', id);
    // Se llama a la función que elimina un registro. Se encuentra en el archivo components.js
    confirmDelete(API_MARCAS, data);
}