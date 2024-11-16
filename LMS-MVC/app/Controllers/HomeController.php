<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Models\User;
class HomeController extends Controller
{
    public  function index()    
    {  
        //echo "Hello from home controller";
        // View::render("home");
       echo'<pre>';
       $users = new User;
        print_r($users->where('id','=',1)->where('name', 'like', '%')->get());
    } 

}