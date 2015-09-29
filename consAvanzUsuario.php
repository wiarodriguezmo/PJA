<?php
session_start();

if(!isset($_SESSION["usuario"])) {
  	// Usuario no validado. Presentar la autenticación
	header ("Location: Sign.php");
}

$root = '';

if(!empty($_SESSION)){
	// Incluimos el template engine
	include('includes/templateEngine.inc.php');

	if($_POST['td'] != "" or $_POST['id'] != "" or $_POST['nombre'] != "" or $_POST['apellido'] != "" or $_POST['correo']!="" or $_POST['celular']!=""){
		// Incluimos las funciones
		include('includes/functions.inc.php');
		// Inicializamos variables de paginación
		$pagina 	= 1;
		$porPagina 	= 50;
		$cons = "SELECT SQL_CALC_FOUND_ROWS id, td, nombres, apellidos, telefono, celular, email, direccion, nacimiento 
		FROM Persona WHERE ";
		$conjuncion = " ";
		if($_POST['td']!=NULL){
			$cons = $cons . "td = " . $_POST['td'];
			$conjuncion = " AND ";
		}
		if($_POST['id']!=NULL){
			$cons = $cons . $conjuncion . "id = " . $_POST['id'];
			$conjuncion = " AND ";
		}
		if($_POST['nombre']!=NULL){
			$cons = $cons . $conjuncion . "LOWER(nombres) = '%" . $_POST['num'];
			$conjuncion = " AND ";
		}
		if($_POST['tipo']!=NULL){
			$cons = $cons . $conjuncion . "tipo like '" . $_POST['tipo']. "'";
			$conjuncion = " AND ";
		}
		if($_POST['modalidad']!="Todas"){
			$cons = $cons . $conjuncion . "modalidad like '" . $_POST['modalidad']. "'";
		}

		// llamar función para realizar la recopilación de datos y números de página
		$lista_paginada = paginar_salud($mysqli, $porPagina, $pagina,$cons);
	}

	// Cargamos la plantilla
	$twig->display('consultaUsuario.html',array(
		"titulo"	 	=> "Consulta avanzada de usuarios",
		"paginas"		=> $lista_paginada['paginasNo'],
		"lista_paginada"	=> $lista_paginada['listaRegistro'],
		"ultima_pagina"		=> $lista_paginada['noPaginas'],
		"clientes" 		=> "active",
		"clientes2" 		=> "active",
	));
}

