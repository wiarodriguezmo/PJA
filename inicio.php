<?php
session_start();
// Comprobar si es un usuario logueado
if(!isset($_SESSION["usuario"])) 
	header ("Location: Sign.php");

$root = '';

include('includes/templateEngine.inc.php');


$twig->display('default_layout.html',array(
	"titulo" => "Página principal Interfaz para Bases de datos - PJA ", 
	"inicio" => "active"
));

?>

    <div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h1>Página de inicio en construcción</h1>
        <p>Esta interfaz es construída con las úlltimas tecnologías digitales en el 2015, con JavaScript, PHP, Twig, JQuery, HTML5 y CSS3.</p>
        <p>Desarrollada según los estándares de la W3 consorcio. Diseño responsive y optimizado para carga en navegadores recientes.</p>
        <p>Seguridad RSA con códigos de 32bits y cifrado para la comunicación con la base de datos.</p>
        <p>
          <a class="btn btn-lg btn-primary" role="button">CONTINÚE NAVEGANDO EN LA INTERFAZ POR FAVOR »</a>
        </p>
      </div>

    </div> <!-- /container -->

