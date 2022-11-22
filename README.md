# route-view-parser
Sistema de ruteo de vistas y parser de variables desde el controlador a la vista. Hecho en MVC

## Ruteo de Vistas / RouteView
Esta clase asocia una url al método de un controlador, y devuelve lo que el método ofrezca como valor de retorno (por lo cual el método debe retornar una respuesta, para mayor prolijidad).


Importar el archivo `libs/RouteView.php` y crear una instancia de la clase RouteView

```php
require 'libs/RouteView.php';
$routeView = new RouteView( );
```

El parseo de rutas se realiza desde el método `RouteView::render( $c, $m )`, que espera recibir dos argumentos (el segundo es optativo).

**PRIMER ARGUMENTO: String**
El valor de la sección recibida por GET (que es en formato UrlAmigable).
Donde misitio.com/home obtendrá `home` com sección actual.

Ese valor se usará para buscar un controller homónimo (con la primera letra en mayúsculas), adentro del directorio `/controllers`, en este ejemplo buscará `HomeController.php`
Si hubiese recibido la url misitio.com/usuarios, buscará `UsuariosController.php` en el directorio `/controllers`.


**SEGUNDO ARGUMENTO: String**
Nombre del método a ejecutar dentro de esa clase.
Este argumento es optativo y por defecto buscará el método `index( )`

```php
require 'libs/RouteView.php';
$routeView = new RouteView( );

//La siguiente línea ejecutará ContactoController::enviar( )
$routeView->render( 'contacto', 'enviar' );
```

## Interpolación de Plantillas / TemplateParser
Esta clase solicita un archivo (de tipo HTML, PHP, texto plano, etc), procesa las variables sobre los tokens de reemplazo dentro del mismo y retorna la cadena de texto procesada con dichos reemplazos.

Incluir el archivo `TemplateParser.php` (recomendado que sea en el index.php para tenerlo en toda la navegación)

```php
require 'libs/TemplateParser.php';
```
Y desde el archivo que se desee invocar a un template (generalmente desde adentro del método asociado a una ruta), crear una instancia del objeto `TemplateParser` y ejecutar la funcion `TemplateParser::render( $v, $d, $ci )` que recibe tres argumentos.

Los token de reemplazos deben estar definidos entre doble mostachos (dos pares de llaves que abren y cierran {{ }}), pudiendo tener espacios entre las llaves más internas y la clave si así lo prefiren.
De esta manera `{{TOKEN}}` es lo mismo que `{{ TOKEN }}`
Pero `{ TOKEN }` es ignorado por tener una sola llave y `{ { TOKEN } }` también es ignorado porque entre las dos llaves no pueden haber espacios intermedios.

**PRIMER ARGUMENTO: String**
El nombre del archivo a cargar como vista. En esta primera instancia del proyecto el archivo debe estar adentro del directorio `/vistas`


**SEGUNDO ARGUMENTO: Array**
Un Array Asociativo que tenga la correlación {{TOKEN}} => VALOR a mostrar.
El TOKEN es el índice del Array, sin los dobles mostachos.

```php
$datos = [
    'NOMBRE' => 'German', //reemplazará {{NOMBRE}} o {{ NOMBRE }}
    'APELLIDO' => 'Rodríguez' //reemplazará {{APELLIDO}} o {{ APELLIDO }}
];
```

En primera instancia las claves son CASE SENSITIVE, por lo cual `'NOMBRE'` no aplicará cambios sobre `{{nombre}}` ni sobre `{{ nombre }}` 

**TERCER ARGUMENTO: Bool**
Este argumento es el único optativo y define si se quiere hacer CASE INSENSITIVE en la búsqueda de las claves en los tokens de reemplazo.

Por defecto es `false`, por lo cual es case sensitive, pero si se pasa un valor `true`, el índice `'NOMBRE'` del array asociativo, coincidirá con `{{nombre}}`, `{{ nombre }}`, `{{ NomBre }}` y demás variaciones de mayúsculas y minúsculas.

Ejemplo de uso:
```php
$datos = [
    'NOMBRE' => 'Germán',
    'APELLIDO' => 'Rodríguez'
];

//aplicar los reemplazos sobre el archivo /vistas/archivo.html, haciendo el matcheo de los tokens case insensitive
$contenido = TemplateParser::render('archivo.html', $datos, true);
```


## MANEJO DE ERRORES
En este momento, si la ruta no está asociada a un controller o el método no existe, cortará toda la ejecución del script con un mensaje de error.


## Cómo fue desarrollado
Se puede encontrar todo el desarrollo del proyecto, paso a paso, en este video de YouTube: https://youtu.be/A1qAlEzKg7k