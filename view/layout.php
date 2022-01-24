<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Rodrigo Geras Zurron">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="robots" content="index, follow">
        <meta name="application-name" content="Login y logout">
        <meta name="description" content="Control de acceso e identificación de un usuario">
        <link href="../207DWESLoginLogoutMulticapaPOO/webroot/css/estilo.css" rel="stylesheet" type="text/css">
        <link href="../207DWESLoginLogoutMulticapaPOO/webroot/css/estiloejercicio.css" rel="stylesheet" type="text/css">
        <link rel="icon" href="../207DWESLoginLogoutMulticapaPOO/webroot/css/img/home.png" type="image/x-icon">
        <title>Index Login y Logout Tema 5</title>
        <style>
            #div1{
                height: 50vh;
                width: 100vw;
                display: flex;
                align-items: center;
                justify-content: center;
            }
        </style>
        <script>
            window.addEventListener("load", reloj);

            function reloj() {
                function moverReloj(){
                    var lista = document.getElementById("div1");
                    lista.innerHTML="";
                    var fechaActual = new Date();
                    var hora = fechaActual.getHours();
                    var minuto = fechaActual.getMinutes();
                    var segundo = fechaActual.getSeconds();
                    var primerahora = parseInt(hora/10);
                    var segundahora = parseInt(hora%10);
                    var primeraminuto = parseInt(minuto/10) ;
                    var segundaminuto = parseInt(minuto%10);
                    var primerasegundo = parseInt(segundo/10);
                    var segundasegundo = parseInt(segundo%10);
                    var dospuntos = 104;
                    var mostrarHora = crearImagen(primerahora) + crearImagen(segundahora)  + crearImagen(dospuntos) + crearImagen(primeraminuto) + crearImagen(segundaminuto) + crearImagen(dospuntos) + crearImagen(primerasegundo) + crearImagen(segundasegundo);
                    var lista = document.getElementById("div1");
                    var nuevoElemento = document.createElement("div");
                    nuevoElemento.innerHTML=mostrarHora;
                    setTimeout(moverReloj, 1000);
                }

                function crearImagen(numero) {
                    var img = document.createElement("img");
                    img.setAttribute("src",`../207DWESLoginLogoutMulticapaPOO/webroot/css/img/${numero}.png`);
                    img.width="140";
                    img.height="140";
                    img.alt = `${numero}`;
                    var src = document.getElementById("div1");
                    src.appendChild(img);
                }
                setTimeout(moverReloj, 1000);
            }
        </script>
    </head>
    
    <body>
        <header class="tituloaplicacion">
            <h1>207DWESLoginLogoutMulticapaPOO</h1>
        </header>
        
        <?php require_once $vistas[$_SESSION['paginaEnCurso']];?>
        
        <footer class="piepagina">
            <a href="../proyectoDWES/indexProyectoDWES.php"><img src="../207DWESLoginLogoutMulticapaPOO/webroot/css/img/atras.png" class="imageatras" alt="IconoAtras" /></a>
            <a href="https://github.com/AlbertoFRSauces/207DWESLoginLogoutMulticapaPOO" target="_blank"><img src="../207DWESLoginLogoutMulticapaPOO/webroot/css/img/github.png" class="imagegithub" alt="IconoGitHub" /></a>
            <p><a>&copy;</a><a href="http://daw207.ieslossauces.es/index.php">Alberto Fernández Ramírez</a> 29/09/2021 Todos los derechos reservados.</p>
            <p>Ultima actualización: 19/01/2022 22:27 - Release 2.0</p>
        </footer>
    </body>
</html>