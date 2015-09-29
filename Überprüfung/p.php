<?php
$servername = "localhost";
$username = "metadepo";
$password = "alemania10";
$dbname = "metadepo_pja";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$i= $_POST['id'];
$nomb= $_POST['nombre'];
$apell= $_POST['apellido'];

$sql = "INSERT INTO Persona VALUES ('$i', '$nomb' , '$apell', '','3132221122','cra41','2015-06-02')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?> 
