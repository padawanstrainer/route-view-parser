<?php 
require 'libs/TemplateParser.php';
require 'libs/RouteView.php';

$rv = new RouteView( );
$seccion = $_GET['pagina'] ?? 'home';
$accion = $_GET['accion'] ?? 'index';

?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Template Parser</title>
</head>
<body>
  <header>
    <h1>Mi wea</h1>
    <nav>
      <ul>
        <li><a href='/home'>Home</a></li>
        <li><a href='/usuarios'>Usuarios</a></li>
        <li><a href='/contacto'>Contacto</a></li>
      </ul>
    </nav>
  </header>
  <?php 
  echo $rv->render( $seccion, $accion );
  ?>
</body>
</html>