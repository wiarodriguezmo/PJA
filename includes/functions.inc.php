<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 
 * @package: paginacion_twig_php_mysql/includes/
 * @author: Luis Fernando Cázares <luis.f.cazares@gmail.com>
 * @version Id: functions.inc.php 2013-10-15 23:40 _CazaresLuis_ ;
 * @content: funciones generales
 * 
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

// Constantes conexión con la base de datos
define("server", 'localhost');
define("user", 'root');
define("pass", 'alemania10');
define("mainDataBase", 'c');

// Variable que indica el status de la conexión a la base de datos
$errorDbConexion = false;


// Verificar constantes para conexión al servidor
if(defined('server') && defined('user') && defined('pass') && defined('mainDataBase'))
{
	// Conexión con la base de datos
	
	$mysqli = new mysqli(server, user, pass, mainDataBase);
	
	// Verificamos si hay error al conectar
	if (mysqli_connect_error()) {
	    $errorDbConexion = true;
	}
	else{
		// Evitando problemas con acentos
		$mysqli -> query('SET NAMES "utf8"');
	}
	
}


// listado completo de registros
function lista_completa($dbLink){

	$listaRegistro = array();

	$consulta = "SELECT id_registro, rg_nombre, rg_email, rg_status FROM tbl_paginacion";

	// Ejecutamos la consulta
	$respuesta = $dbLink -> query($consulta);

	if($respuesta -> num_rows != 0){
		// convertimos el objeto
		while($listadoOK = $respuesta -> fetch_assoc())
		{
			$listaRegistro[] = $listadoOK;
		}	
	}

	return $listaRegistro;
}

// Paginación
function paginar_registro($dbLink, $porPagina, $paginaActual,$col,$bd){
	// arrays que contienen los datos
	$paginasLista 		= array();
	$listaRegistro 		= array();

	// pasar a entero el número de página
	$noPagina = (int)$paginaActual;

	// Validar que la página sea uno en caso de un valor menor a este
	if($noPagina < 1)
		$noPagina = 1;
	
	//A partir de qué registro comienza el conjunto de registros a mostrar. 
	$offSet = ($noPagina-1)*$porPagina;

	// Armamos los querys
	$consulta_General = sprintf("SELECT SQL_CALC_FOUND_ROWS %s FROM %s LIMIT %d,%d",$col,$bd,$offSet,$porPagina);

	$consulta_Total = "SELECT FOUND_ROWS() AS Total";

	// ejecutamos querys, una obtiene el conjunto de registros, otra el total de registros.
	$consulta_Filas = $dbLink -> query($consulta_General);

	$consulta_FilasTotal = $dbLink -> query($consulta_Total);


	// Total de filas
	$rowsTotal = $consulta_FilasTotal -> fetch_array();

	// Lista de registros
	while($listadoOK = $consulta_Filas->fetch_array()){
		$listaRegistro[] = $listadoOK;
	}

	// Total de filas
	$totalFilas = $rowsTotal['Total'];

	// Calculamos el número total de páginas
	$noPaginas = ceil($totalFilas/$porPagina);

	$paginas = array();

	// armamos links ?pag=1
	for($no=1;$no<=$noPaginas;$no++){
		$paginas[$no] = '?pag='.$no;
	}

	$paginasLista['paginasNo'] 		= $paginas;
	$paginasLista['listaRegistro'] 		= $listaRegistro;
	$paginasLista['noPaginas'] 		= $noPaginas;

	return $paginasLista;
}

// Paginación
function paginar_salud($dbLink, $porPagina, $paginaActual,$cons){
	// arrays que contienen los datos
	$paginasLista 		= array();
	$listaRegistro 		= array();

	// pasar a entero el número de página
	$noPagina = (int)$paginaActual;

	// Validar que la página sea uno en caso de un valor menor a este
	if($noPagina < 1)
		$noPagina = 1;
	
	//A partir de qué registro comienza el conjunto de registros a mostrar. 
	$offSet = ($noPagina-1)*$porPagina;

	// Armamos los querys
	$consulta_General = sprintf($cons . " LIMIT %d,%d",$offSet,$porPagina);

	$consulta_Total = "SELECT FOUND_ROWS() AS Total";

	// ejecutamos querys, una obtiene el conjunto de registros, otra el total de registros.
	$consulta_Filas = $dbLink -> query($consulta_General);

	$consulta_FilasTotal = $dbLink -> query($consulta_Total);


	// Total de filas
	$rowsTotal = $consulta_FilasTotal -> fetch_array();

	// Lista de registros
	while($listadoOK = $consulta_Filas->fetch_array()){
		$listaRegistro[] = $listadoOK;
	}

	// Total de filas
	$totalFilas = $rowsTotal['Total'];

	// Calculamos el número total de páginas
	$noPaginas = ceil($totalFilas/$porPagina);

	$paginas = array();

	// armamos links ?pag=1
	for($no=1;$no<=$noPaginas;$no++){
		$paginas[$no] = '?pag='.$no;
	}

	$paginasLista['paginasNo'] 		= $paginas;
	$paginasLista['listaRegistro'] 		= $listaRegistro;
	$paginasLista['noPaginas'] 		= $noPaginas;

	return $paginasLista;
}
?>
