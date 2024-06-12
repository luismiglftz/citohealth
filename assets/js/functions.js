//todo: add funcionalidades

//PARAMETRIZAR LAS CONSULTAS PARA EVITAR INYECCIONES SQL

//ALERT CON CONFIRMAR


var actual = 1;
var tdsPorPagina = 4;
//PARA GUARDAR LAS FILAS QUE SE HAN FILTRADO DE LA BARRA DE BUSQUEDA
var filasFiltradas = [];

//FUNCION BARRA DE BUSQUEDA
function Buscar() {
    var input = document.getElementById('barraBusqueda');
    var filtro = input.value.toLowerCase();
    var tabla = document.getElementById('tabla');
    var tr = tabla.getElementsByTagName('tr');

    //VOLVEMOS A LIMPIAR LAS FILAS FILTRADAS
    filasFiltradas = [];

    // EMPIEZA EN 1, LA PRIMERA ES LA CABECERA
    for (var i = 1; i < tr.length; i++) {
        //SE RESTABLECE EL ESTADO DE LA FILA
        tr[i].style.display = "table-row";
        
        //RECOGEMOS TODOS LOS TD
        var tds = tr[i].getElementsByTagName('td');
        var coincide = false;

        // Recorre todas las celdas de la fila actual
        for (var j = 0; j < tds.length; j++) {
            if (tds[j]) {
                //COMPROBMAMOS SI COINCIDE
                var textValue = tds[j].innerText.toLowerCase();
                if (textValue.toLowerCase().includes(filtro)) {
                    coincide = true;
                    break;
                }
            }
        }

        if (coincide) {
            //GUARDAMOS LA FILA COMPLETA
            filasFiltradas.push(tr[i]);
        }else{
            tr[i].style.display = "none";
        }
    }

    //SE REINICIA A LA 1º PAGINA
    mostrarPagina(1);
}


//FUNCION PAGINACION
function mostrarPagina(pagina) {
/*  var tabla = document.getElementById('tabla');
    var tr = tabla.getElementsByTagName('tr'); -- DEFINIDO CONTENT LOADED??*/
    var totalFilas = filasFiltradas.length;
    var totalPaginas = Math.ceil(totalFilas / tdsPorPagina); //SE CALCULA EL TOTAL DE PAGINAS QUE EXISTEN

    //VALIDACION SI ESTA DENTRO DE LOS LIMISTES
    if (pagina < 1) pagina = 1; //SOLO VA A MOSTRAR UNA...
    if (pagina > totalPaginas) pagina = totalPaginas;

    //OCULTA TODO
    for (var i = 0; i < filasFiltradas.length; i++) {
        filasFiltradas[i].style.display = "none";
    }

    //PARA BUSCAR POR QUE (tr/DE LOS FILTRADOS) EMPEZAR
    var inicio = ((pagina - 1) * tdsPorPagina);
    var fin = inicio + tdsPorPagina;

    //YA TENEMOS EL RANGO DE FILAS A MOSTRAR
    for (var i = inicio; i < fin && i < filasFiltradas.length; i++) {
        filasFiltradas[i].style.display = "table-row";
    }

    /* //VALIDACION QUE SOLO EXISTA UNA PAG
    if (totalPaginas <= 1) document.getElementById('despTablas').innerText = ""; */
    
    //AÑADIMOS LA POS EN LA QUE NOS ENCONTRAMOS
    document.getElementById('infoPagina').innerText = pagina + " / " + totalPaginas;

    //GUARDA VALOR DE LA PAGINA ACTUAL
    actual = pagina;
}

function siguientePagina() {
    mostrarPagina(actual + 1);
}

function anteriorPagina() {
    mostrarPagina(actual - 1);
}

//AL CARGAR LA PAGINA EMPIEZA POR LA PAGINA 1
document.addEventListener('DOMContentLoaded', function() {
    var tabla = document.getElementById('tabla');
    var tr = tabla.getElementsByTagName('tr');

    for (var i = 1; i < tr.length; i++) {
        filasFiltradas.push(tr[i]);
    }
    
    mostrarPagina(1);
});


//MOSTRAR PASSWORD
//FIX: NO FUNCIONA INTENTAR SOLUCIONAR
function mostrarPass(elemento) {
    var contrasenaInput = elemento.closest("div").parentElement.closest("div").querySelector('input[type="password"], input[type="text"]'); //RECOGEMOS EL ELEMENTO ANTERIOR (INPUT)

    if (contrasenaInput.type === "password") {
        contrasenaInput.type = "text";
        elemento.src = "../assets/media/ojo_abierto.svg";
    } else {
        contrasenaInput.type = "password";
        elemento.src = "../assets/media/ojo_cerrado.svg";
    }
}

//PARA IMPLEMENTAR EN UN FUTURO
function confirmar() {
    if (confirm("¿Está seguro que desea continuar?")) {

    } else {

    }
}



