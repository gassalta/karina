<?php
require 'config.php'; // Archivo de conexion
session_start();
setlocale(LC_ALL, 'es_AR', 'esp');
date_default_timezone_set('America/Argentina/Buenos_Aires');
require 'usuarios.php'; // Clase de usuarios
require 'incidencias.php'; // Clase de incidencias
$requestMethod = $_SERVER["REQUEST_METHOD"];
if (isset($_GET['login'])) {
    $control = new Usuarios($bd, $requestMethod);
    $control->gets(); // Llamadas
} else if (isset($_GET['logout'])) {
    unset($_SESSION['id']);
    session_destroy();
    session_regenerate_id(true);
    header("Location: ../login.php");
} else if (isset($_GET['incidencia'])) {
    $control = new Incidencias($bd, $requestMethod);
    $control->gets();
}
