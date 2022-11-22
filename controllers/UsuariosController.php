<?php 
class UsuariosController{
  public function index( ){
    $usuarios = [
      'ivantheragingpython',
      'fabriiferroni',
      'lexgimipiki',
      'manzdev'
    ];
    $html = implode("", array_map(function( $u ){ return "<li>$u</li>";} , $usuarios ) );

    $datos = [
      'USUARIO' => 'Fabitodev',
      'USERLIST' => $html
    ]; 
    
    $contenido = TemplateParser::render('usuarios.php', $datos, true);
    return $contenido;
  }
}