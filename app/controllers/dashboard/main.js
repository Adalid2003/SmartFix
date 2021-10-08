// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_PRODUCTOS = '../../app/api/dashboard/productos.php?action=';
const API_AUTO = '../../app/api/dashboard/automoviles.php?action=';
const API_CITA = '../../app/api/dashboard/cita.php?action=';
const API_REPARACIONES = '../../app/api/dashboard/reparaciones.php?action=';


// Método manejador de eventos que se ejecuta cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', function () {
    readRows();
    readRows2();
    // Se declara e inicializa un objeto con la fecha y hora actual.
    let today = new Date();
    // Se declara e inicializa una variable con el número de horas transcurridas en el día.
    let hour = today.getHours();
    // Se declara e inicializa una variable para guardar un saludo.
    let greeting = '';
    // Dependiendo del número de horas transcurridas en el día, se asigna un saludo para el usuario.
    if (hour < 12) {
        greeting = 'Buenos días';
    } else if (hour < 19) {
        greeting = 'Buenas tardes';
    } else if (hour <= 23) {
        greeting = 'Buenas noches';
    }
    // Se muestra el saludo en la página web.
    document.getElementById('greeting').textContent = greeting;
    // Se llaman a la funciones que muestran las gráficas en la página web.
    graficaBarrasAuto();
    graficaPastelCitas();
    graficaDonaAutomovil();
    graficaBarraAutos(2);
    // Se inicializa el componente Tooltip asignado a los enlaces para que funcionen las sugerencias textuales.
    M.Tooltip.init(document.querySelectorAll('.tooltipped'));
});

// Función para mostrar el top 5 de marcas con mas automoviles en una grafica de dona.
function graficaDonaAutomovil() {
    fetch(API_AUTO + 'top5Auto', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se remueve la etiqueta canvas de la gráfica.
                if (response.status) {
                    // Se declaran los arreglos para guardar los datos por gráficar.
                    let marca = [];
                    let cantidad = [];
                    // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
                    response.dataset.map(function (row) {
                        // Se asignan los datos a los arreglos.
                        marca.push(row.marca);
                        cantidad.push(row.cantidad);
                    });
                    // Se llama a la función que genera y muestra una gráfica de barras. Se encuentra en el archivo components.js
                    doughnutGraph('marcasAutomoviles', marca, cantidad, 'Top 5 marcas con más automoviles.')
                } else {
                    document.getElementById('marcasAutomoviles').remove();
                    console.log(response.exception);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}

// Función para mostrar la cantidad de productos por categoría en una gráfica de barras.
function graficaBarrasAuto() {
    fetch(API_AUTO + 'cantidadAutoCliente', {
        method: 'get'
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
                    barGraph('chart1', clientes, cantidad, 'Cantidad de automoviles', 'Top 10 de clientes con mas automoviles');
                } else {
                    document.getElementById('chart1').remove();
                    console.log(response.exception);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}

//Al abrir el modal
document.getElementById('btn_seleccionarmes').addEventListener('click',function(){
    //carga los datos
    readRows();
})

// Función para mostrar una grafica de pastel del top 5 de clientes mas frecuentes
function graficaPastelCitas() {
    fetch(API_CITA + 'top5Clients', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se remueve la etiqueta canvas de la gráfica.
                if (response.status) {
                    // Se declaran los arreglos para guardar los datos por gráficar.
                    let citas = [];
                    let cliente = [];
                    // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
                    response.dataset.map(function (row) {
                        // Se asignan los datos a los arreglos.
                        citas.push(row.citas);
                        cliente.push(row.cliente);
                    });
                    // Se llama a la función que genera y muestra una gráfica de barras. Se encuentra en el archivo components.js
                    pieGraph1('citasGrafica', cliente, citas, 'Top 5 clientes más frecuentes');
                } else {
                    document.getElementById('citasGrafica').remove();
                    console.log(response.exception);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}

//Funcion que genera un grafico de donas para ver el porcentaje de estados de citas de forma mensual
function graficaDonaEstadoCita(mes, texto){
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData(); 
    data.append('mes', mes);

    fetch(API_CITA + 'citaMes', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    let estado_cita = [];
                    let porcentaje = [];

                    // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
                    response.dataset.map(function (row) {
                        // Se asignan los datos a los arreglos.
                        estado_cita.push(row.estado_cita);
                        porcentaje.push(row.porcentaje);
                    });

                    //Destruimos el grafico
                    document.getElementById('citasPorcentajediv').removeChild(document.getElementById('citasPorcentaje'));
                    //Creamos el canvas
                    var graph = document.createElement('canvas');
                    //Seteamos el mismo
                    graph.id = 'citasPorcentaje';
                    //Agregamos el canvas
                    document.getElementById('citasPorcentajediv').appendChild(graph);
                    //Mandamos los datos al metodo
                    doughnutGraph('citasPorcentaje', estado_cita, porcentaje, texto)
                } else {
                    sweetAlert(4, response.exception, null);
                }
            });
        } else {
            document.getElementById('graficaparam').className = 'hide';
            console.log(response.exception);
        }
    }).catch(function (error) {
        console.log(error);
    });
}

//Funcion que genera un grafico de barras para ver la cantidad de autos reparados por marca
function graficaBarraAutos(marca){
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData(); 
    data.append('id_marca', marca);

    fetch(API_REPARACIONES + 'modelosPorMarca', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    let marca = [];
                    let modelo = [];
                    let cantidad = [];

                    // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
                    response.dataset.map(function (row) {
                        // Se asignan los datos a los arreglos.
                        marca.push(row.marca);
                        modelo.push(row.modelo);
                        cantidad.push(row.cantidad);
                    });

                    //Destruimos el grafico
                    document.getElementById('contenedorMarcaAutomoviles').removeChild(document.getElementById('marcaAutomovilesGraph'));
                    //Creamos el canvas
                    var graph = document.createElement('canvas');
                    //Seteamos el mismo
                    graph.id = 'marcaAutomovilesGraph';
                    //Agregamos el canvas
                    document.getElementById('contenedorMarcaAutomoviles').appendChild(graph);
                    //Mandamos los datos al metodo
                    barGraph('marcaAutomovilesGraph', modelo, cantidad, 'Cantidad de automoviles: ', marca[0]);
                } else {
                    sweetAlert(4, response.exception, null);
                }
            });
        } else {
            document.getElementById('graficaparam').className = 'hide';
            console.log(response.exception);
        }
    }).catch(function (error) {
        console.log(error);
    });
}
//carga los datos para la tabla
function readRows2() {
    fetch(API_REPARACIONES + 'marcaAutoReparaciones', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                let data = [];
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    data = response.dataset;
                } else {
                    sweetAlert(4, response.exception, null);
                }
                // Se envían los datos a la función del controlador para que llene la tabla en la vista.
                fillTable2(data);
            });
        } else {
            document.getElementById('graficaparam').className = 'hide';
            console.log(response.exception);
        }
    }).catch(function (error) {
        console.log(error);
    });
}

function fillTable2(dataset){
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
            <tr>
                <td>${row.marca}</td>
                <td>${row.count}</td>
                <td>
                    <a href="#" onclick="graficaBarraAutos(${row.id_marca})" class="btn modal-close waves-effect blue tooltipped" data-tooltip="Ver grafica"><i class="material-icons">visibility</i></a>
                </td>
            </tr>
        `;
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('tbody-rows2').innerHTML = content;
    // Se inicializa el componente Tooltip asignado a los enlaces para que funcionen las sugerencias textuales.
    M.Tooltip.init(document.querySelectorAll('.tooltipped'));
}

//carga los datos para la tabla
function readRows() {
    fetch(API_CITA + 'mesesCitas', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                let data = [];
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    data = response.dataset;
                } else {
                    sweetAlert(4, response.exception, null);
                }
                // Se envían los datos a la función del controlador para que llene la tabla en la vista.
                fillTable(data);
            });
        } else {
            document.getElementById('graficaparam').className = 'hide';
            console.log(response.exception);
        }
    }).catch(function (error) {
        console.log(error);
    });
}

function fillTable(dataset){
    let content = '';
    let mes = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        //Se recorren los meses de forma numerica para obtenerlos en forma textual
        if (row.mes == '01') {
            mes = 'Enero'
        } else if(row.mes == '02') {
            mes = 'Febrero'
        } else if(row.mes == '03') {
            mes = 'Marzo'
        } else if(row.mes == '04') {
            mes = 'Abril'
        } else if(row.mes == '05') {
            mes = 'Mayo'
        } else if(row.mes == '06') {
            mes = 'Junio'
        } else if(row.mes == '07') {
            mes = 'Julio'
        } else if(row.mes == '08') {
            mes = 'Agosto'
        } else if(row.mes == '09') {
            mes = 'Septiembre'
        } else if(row.mes == '10') {
            mes = 'Octubre'
        } else if(row.mes == '11') {
            mes = 'Noviembre'
        } else if(row.mes == '12') {
            mes = 'Diciembre'
        }
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
            <tr>
                <td>${mes}</td>
                <td>${row.citas}</td>
                <td>
                    <a href="#" onclick="graficaDonaEstadoCita('${row.mes}', '${mes}')" class="btn modal-close waves-effect blue tooltipped" data-tooltip="Ver grafica"><i class="material-icons">visibility</i></a>
                </td>
            </tr>
        `;
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('tbody-rows').innerHTML = content;
    // Se inicializa el componente Tooltip asignado a los enlaces para que funcionen las sugerencias textuales.
    M.Tooltip.init(document.querySelectorAll('.tooltipped'));
}
