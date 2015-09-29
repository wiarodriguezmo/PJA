<?php
session_start();

if(!isset($_SESSION["usuario"])) {
  	// Usuario no validado. Presentar la autenticación
	header ("Location: Sign.php");
}

$root = '';

include('includes/templateEngine.inc.php');

$prueba="funciona!!";

$twig->display('regUsuario.html',array(
	"titulo" 	=> "Registro en Bases de Datos de usuario nuevo", 
	"clientes" 	=> "active",
	"clientes1" 	=> "active"
));

