<?php 

$routes = [
  'mounty' => 'home.php',
  'mounty/login' => 'login.php',
  'mounty/register' => 'register.php',
  'mounty/logout' => 'logout.php'
];

$path = trim( $_SERVER['REQUEST_URI'], '/' );
$path = parse_url($path, PHP_URL_PATH);

if (array_key_exists($path, $routes) ) {
  require $routes[$path];
}else {
  require '404.php';
}

?>