<?php
session_start();

if(!isset($_SESSION["usuario"])) {
  	// Usuario no validado. Presentar la autenticación
	header ("Location: Sign.php");
}

$root = '';

include('includes/templateEngine.inc.php');

$twig->display('regPoliza.html',array(
	"titulo"    		=> "Registro en Bases de Datos de nueva poliza",
	"polizas" 		=> "active",
	"polizas1" 		=> "active"
));

