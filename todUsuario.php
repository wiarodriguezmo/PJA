<?php
session_start();

if(!isset($_SESSION["usuario"])) {
  	// Usuario no validado. Presentar la autenticación
	header ("Location: Sign.php");
}

// Directorio Raíz de la app
// Es utilizado en templateEngine.inc.php
$root = '';

// números de captcha
$_SESSION['inicia_paginacion'] = true;

if(!empty($_SESSION)){
	// Incluimos el template engine
	include('includes/templateEngine.inc.php');

	// Incluimos las funciones
	include('includes/functions.inc.php');

	// Inicializamos variables de paginación
	$pagina 	= 1;
	$porPagina 	= 20;

	// validamos el número de página
	if(isset($_GET['pag']) && !empty($_GET['pag']))
		$pagina = $_GET['pag'];
	
	// Enviar parámetros a recuperar
	$columnas = "id, td, nombres, apellidos, telefono, celular, email, direccion, nacimiento";
	$bd = "Persona";

	// llamar función para realizar la recopilación de datos y números de página
	$lista_paginada = paginar_registro($mysqli, $porPagina, $pagina, $columnas, $bd);

	// verificamos que no sea la última pagina
	if($lista_paginada['noPaginas'] < $pagina ){
		$pagina = $lista_paginada['noPaginas'];
		$lista_paginada = paginar_registro($mysqli, $porPagina, $pagina);
	}

	// creamos variables que contengan la página siguiente y página anterior
	// Calculamos pagina siguiente y anterior
	$paginaSiguiente 	= $pagina +1;
    	$paginaAnterior		= $pagina -1;

	// Cargamos la plantilla
	$twig->display('todUsuario.html',array(
		"titulo"    		=> "Listado de todos los clientes",
		"paginas"		=> $lista_paginada['paginasNo'],
		"lista_paginada"	=> $lista_paginada['listaRegistro'],
		"pagina_siguiente"	=> $paginaSiguiente,
		"pagina_anterior"	=> $paginaAnterior,
		"ultima_pagina"		=> $lista_paginada['noPaginas'],
		"pagina_actual"		=> $pagina,
		"clientes" 		=> "active",
		"clientes3" 		=> "active",
	));
}
	

?>
