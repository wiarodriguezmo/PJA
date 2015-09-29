<html><head><meta charset="utf-8"> </head>

<body>

<?php

//Ejemplo aprenderaprogramar.com

function mostrarDatos ($resultados) {

if ($resultados !=NULL) {

echo "- Nombre: ".$resultados['id']."<br/> ";

else {echo "<br/>No hay más datos: <br/>".$resultados;}

}

$link = mysqli_connect("mysql.hostinger.co", "u123104900_pja", "prueba");

mysqli_select_db($link, "u123104900_pja");

$tildes = $link->query("SET NAMES 'utf8'"); //Para que se muestren las tildes correctamente

$result = mysqli_query($link, "SELECT * FROM p");

$extraido1= mysqli_fetch_array($result);

mostrarDatos($extraido1);

$extraido2= mysqli_fetch_array($result);

mostrarDatos($extraido2);

$extraido3= mysqli_fetch_array($result);

mostrarDatos($extraido3);

$extraido4= mysqli_fetch_array($result);

mostrarDatos($extraido4);

$extraido5= mysqli_fetch_array($result);

mostrarDatos($extraido5);

$extraido6= mysqli_fetch_array($result);

mostrarDatos($extraido6);

mysqli_free_result($result);

mysqli_close($link);

?>

</body>
</html>
