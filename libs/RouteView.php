<?php 
class RouteView{
  private $controllers = [];

  public function __construct( ){
    $files = glob( dirname(__DIR__)."/controllers/*.php");
  
    foreach($files as $f){
      require( $f );
      preg_match("/((\w+)(Controller))\.php$/", $f, $matches );
      $indice = strtolower($matches[2]);
      $this->controllers[$indice] = $matches[1];
    }
  }

  public function render( $seccion, $metodo = 'index' ){
    $ctrl = ucfirst($seccion);
    $class = $ctrl.'Controller';
    if(
      ! isset( $this->controllers[$seccion] ) ||
      ! class_exists($class) 
    ){
      die( 'La clase '.$ctrl.'Controller no existe' );
    }
  
    $controller = new $class( );
    if( ! method_exists($controller, $metodo) ){
      die( 'No existe el método '.$ctrl.'Controller::'.$metodo.'( )' );
    }
    return $controller->$metodo( );
  }
}