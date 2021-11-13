<?php
require 'config.php';
session_start();
setcookie(session_id(), NULL, NULL, NULL, 1);
setlocale(LC_ALL, 'es_AR', 'esp');
date_default_timezone_set('America/Argentina/Buenos_Aires');
require 'usuarios.php';
require 'incidencias.php';
$requestMethod = $_SERVER["REQUEST_METHOD"];
if (isset($_GET['login'])) {

    header("Access-Control-Allow-Origin: localhost/karina");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    $userId = null;
    /* if (isset($urlSubBase)) {
        $userId = $urlSubBase;
    } */
    // pass the request method and post ID to the Post and process the HTTP request:
    $control = new Usuarios($bd, $requestMethod, $userId);
    $control->gets();
}else if(isset($_GET['logout'])){
    unset($_SESSION['id']);
        session_destroy();
        session_regenerate_id(true);
        header("Location: ../login.php");
}
