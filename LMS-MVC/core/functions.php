<?php

function redirect ($path)
{
    header('Location:'. APP_URL . '/' . $path);
   
    die;
}