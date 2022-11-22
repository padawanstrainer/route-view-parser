<?php 
class HomeController{
  function index( ){
    $datos = [
      'USUARIO' => 'Fabitodev',
      'FECHA' => date('Y-m-d')
    ];

    $contenido = TemplateParser::render('home.php', $datos, true);
    return $contenido;
  }
}
?>