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
	
	$cons = "SELECT SQL_CALC_FOUND_ROWS num, tipo, inicioVig, finVig, modalidad, idContratante, P1.nombres AS p1n, P1.apellidos AS p1a, P1.telefono AS p1t, idBeneficiario, P2.nombres AS p2n, P2.apellidos AS p2a, P2.telefono AS p2t, P2.celular AS p2c, P2.email AS p2e, P2.direccion AS p2d, dirLaboral, P2.nacimiento AS p2nac FROM Salud INNER JOIN Persona AS P1 ON idContratante = P1.id INNER JOIN Persona AS P2 ON idBeneficiario = P2.id WHERE tipo LIKE 'Familiar'";
	// llamar función para realizar la recopilación de datos y números de página
	$lista_paginada = paginar_salud($mysqli, $porPagina, $pagina,$cons);

	// verificamos que no sea la última pagina
	if($lista_paginada['noPaginas'] < $pagina ){
		$pagina = $lista_paginada['noPaginas'];
		$lista_paginada = paginar_salud($mysqli, $porPagina, $pagina,$cons);
	}

	// creamos variables que contengan la página siguiente y página anterior
	// Calculamos pagina siguiente y anterior
	$paginaSiguiente 	= $pagina +1;
    	$paginaAnterior		= $pagina -1;

	// Cargamos la plantilla
	$twig->display('todContratos.html',array(
		"titulo"    		=> "Listado de los contratos familiares",
		"paginas"		=> $lista_paginada['paginasNo'],
		"lista_paginada"	=> $lista_paginada['listaRegistro'],
		"pagina_siguiente"	=> $paginaSiguiente,
		"pagina_anterior"	=> $paginaAnterior,
		"ultima_pagina"		=> $lista_paginada['noPaginas'],
		"pagina_actual"		=> $pagina,
		"contratos"		=> "active",
		"contratos3"		=> "active"
	));
}
	

?>
