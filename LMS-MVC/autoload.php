<?php
foreach(glob("../config/*.php") as $filename){
    require $filename;
}

foreach(glob("../core/*.php") as $filename){
    require $filename;
}

spl_autoload_register(function($class){
    $file = "../". str_replace('\\','/',$class). '.php';

    if(file_exists($file)){
        require $file;
    }
});

APP_DEBUG ? ini_set('display_errors',1):ini_set('display_errors',0);

$app = new App;
$app -> run();