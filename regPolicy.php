<?php
session_start();
header('Content-Type: text/html; charset=UTF-8'); 	
$dbhost = "localhost";
$database="c";
$user="aseguradora";
$password="probando";
 
// Conectarse a la base de datos
$dbconn = new mysqli($dbhost,$user,$password,$database);
 
// Preparar y ejecutar sentencias

$dbconn->set_charset("utf8");
$stm = $dbconn->prepare("insert into Poliza (id,vigencia,vencimiento,ramo,valor,valorPoliza,compania,idPersona) values ( ? , ? , ?, ?, ?, ?, ?, ?) ");
 
if (!$stm->bind_param("ssssiisi",$id,$ini,$fin,$ramo,$valor,$valorp,$compania,$persona)) {
    print("Error en bind_param: " . $stm->error . "n");
    exit;
}
 
$id = $_POST['id'];
$ini = $_POST['ini'];
$fin = $_POST['fin'];
$valor = $_POST['valor'];
$ramo = $_POST['ramo'];
$valorp = $_POST['valorp'];
$compania = $_POST['comp'];
$persona = $_POST['persona'];
$stm->execute();

print($td.$id.$nombres.$apellidos);
header ("Location: inicio.php");
// Desconectarse de la base de datos
$dbconn->close();

