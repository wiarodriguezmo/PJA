<?php
session_start();
// comprobar los argumentos recibidos
if ($_POST["user"]=="prueba" && $_POST["pass"]=="1234") {
    // usuario validado correctamente.
    // Meter en sesión y enviar a la página de inicio
    $_SESSION["usuario"] = $_POST["user"];
    header ("Location: inicio.php");
} else {
    //usuario o contraseña incorrectos.
    // Presentar mensaje de error
?>
<html>
<body>
    Error. Usuario o contraseña incorrectos
    <a href="Sign.php">Intentarlo de nuevo</a>
</body>
</html>
<?php
}
?>
