<?php

use App\Controllers\HomeController;
use APP\Core\Router;

Router::get('/hello', function(){
    View::render("home");
});
Router::get('/', [new HomeController , "index"]);