<?php
session_start();

$dbhost = "localhost";
$database="u123104900_pja";
$user="u123104900_pja";
$password="prueba";
 
// Conectarse a la base de datos
$dbconn = new mysqli($dbhost,$user,$password,$database);
 
// Preparar y ejecutar sentencias

$stm = $dbconn->prepare("select id from p ");
 
if (!$stm) {
    print("Error en bind_param: " . $dbconn->error . "n");
    exit;
}

$stm->bind_result($id);
print "Nombre: " . $id . "n";

// Desconectarse de la base de datos
$dbconn->close();
