<?php
function autoload($class)
{
    $core = CORE . str_replace("\\", "/", $class) . '.php';
    $app =  APP . str_replace('\\', '/', $class) . '.php';
    if (file_exists($core)) {
        // echo "Find -> $class";
        // echo "<br>";
        require_once $core;
    } elseif (file_exists($app)) {
        // echo "Find -> $class";
        // echo "<br>";
        require_once $app;
    } else {
        // echo "Not found ->{$class}";
        // echo "<br>";
        var_dump($core);
        // echo "<br>";
        throw new Exception("{$class} not found");
    }
}

spl_autoload_register('autoload');
