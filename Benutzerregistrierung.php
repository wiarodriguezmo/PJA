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
$stm = $dbconn->prepare("insert into Persona (id,td,nombres,apellidos,telefono,celular,email,direccion,nacimiento) values ( ? , ? , ?, ?, ?, ?, ?, ?, ? ) ");
 
if (!$stm->bind_param("issssssss",$id,$td,$nombres,$apellidos,$telefono,$celular,$correo,$direccion,$nacimiento)) {
    print("Error en bind_param: " . $stm->error . "n");
    exit;
}
 
$td = $_POST['td'];
$id = $_POST['id'];
$nombres = $_POST['name'];
$apellidos = $_POST['famil'];
$telefono = $_POST['telenummer'];
$celular = $_POST['handynummer'];
$correo = $_POST['email'];
$direccion = $_POST['adresse'];
$nacimiento = $_POST['alt'];
$stm->execute();

print($td.$id.$nombres.$apellidos);
header ("Location: inicio.php");
// Desconectarse de la base de datos
$dbconn->close();

