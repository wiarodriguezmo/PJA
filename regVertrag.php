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
$stm = $dbconn->prepare("insert into Salud (num, tipo, idContratante, idBeneficiario, inicioVig, finVig, modalidad, dirLaboral) values ( ? , ? , ?, ?, ?, ?, ?, ?) ");
 
if (!$stm->bind_param("isiissss",$num,$tipo,$idContratante,$idBeneficiario,$iniVig,$finVig,$modalidad,$dir)) {
    print("Error en bind_param: " . $stm->error . "n");
    exit;
}
 
$num = $_POST['num'];
$tipo = $_POST['tipo'];
$iniVig = $_POST['inicioVig'];
$finVig = $_POST['finVig'];
$idContratante = $_POST['idContratante'];
$idBeneficiario = $_POST['idBeneficiario'];
$modalidad = $_POST['modalidad'];
$dir = $_POST['dirLaboral'];
$stm->execute();

header ("Location: inicio.php");
// Desconectarse de la base de datos
$dbconn->close();

