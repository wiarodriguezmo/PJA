<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

// Constantes conexión con la base de datos
define("server", 'localhost');
define("user", 'metadepo');
define("pass", 'alemania10');
define("mainDataBase", 'metadepo_c');

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

function consultar_usuario($dbLink, $id){
	$consulta = "SELECT * FROM Persona WHERE id = " . $id;

	$ejecucion = $dbLink -> query($consulta);

	$resultado = $ejecucion -> fetch_array();

	return $resultado;
}









