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

	if($_POST['idBeneficiario'] != "" or $_POST['tipo'] != "" or $_POST['idContratante'] != "" or $_POST['num'] != "" or $_POST['modalidad']!="Todas"){
		// Incluimos las funciones
		include('includes/functions.inc.php');
		// Inicializamos variables de paginación
		$pagina 	= 1;
		$porPagina 	= 50;
		$cons = "SELECT SQL_CALC_FOUND_ROWS num, tipo, inicioVig, finVig, modalidad, idContratante, P1.nombres AS p1n, P1.apellidos AS p1a, P1.telefono AS p1t, idBeneficiario, P2.nombres AS p2n, P2.apellidos AS p2a, P2.telefono AS p2t, P2.celular AS p2c, P2.email AS p2e, P2.direccion AS p2d, dirLaboral, P2.nacimiento AS p2nac 
		FROM Salud INNER JOIN Persona AS P1 ON idContratante = P1.id INNER JOIN Persona AS P2 ON idBeneficiario = P2.id WHERE ";
		$conjuncion = " ";
		if($_POST['idBeneficiario']!=NULL){
			$cons = $cons . "idBeneficiario = " . $_POST['idBeneficiario'];
			$conjuncion = " AND ";
		}
		if($_POST['idContratante']!=NULL){
			$cons = $cons . $conjuncion . "idContratante = " . $_POST['idContratante'];
			$conjuncion = " AND ";
		}
		if($_POST['num']!=NULL){
			$cons = $cons . $conjuncion . "num = " . $_POST['num'];
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
	$twig->display('consultaContrato.html',array(
		"titulo"	 	=> "Consulta avanzada para contratos",
		"paginas"		=> $lista_paginada['paginasNo'],
		"lista_paginada"	=> $lista_paginada['listaRegistro'],
		"ultima_pagina"		=> $lista_paginada['noPaginas'],
		"contratos" 		=> "active",
		"contratos6" 		=> "active",
	));
}
