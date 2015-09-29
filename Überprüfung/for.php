<?php

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

	for($i=1121884616;$i<1121884815;$i++)
	{
		$consulta = "INSERT INTO Persona VALUES(" .$i . ", 'cc', 'William Andrés','Rodríguez Mora', '6660000', '3202241438', 'wiarodriguezmo@unal.edu.co', 'cra 33 # 41 - 66', CURRENT_DATE)"; 		
		if($mysqli -> query($consulta) === TRUE)echo $i;
	}

$mysqli->close();

?>
