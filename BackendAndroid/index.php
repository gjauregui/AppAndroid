<?php
header('Content-Type:Application/json;Charset=UTF-8');

$httpMethod = strtolower($_SERVER['REQUEST_METHOD']);
$path = $_SERVER['PATH_INFO'];

// Limpiar
$path = explode('/', trim($path, '/'));

$class = $path[count($path) - 2];
$classMethod = end($path);

$class = ucfirst($class).'Controller';
$path = "controllers/${class}.php";

if (file_exists($path)) {
    require $path;

    $KLASS = new $class;

    if (method_exists($KLASS, "${classMethod}_${httpMethod}")) {
        call_user_func([$KLASS, "${classMethod}_${httpMethod}"]);
    } else {
        echo "method not allowed";
    }
} else {
    echo "Not Found";
}
