<?php

function redirect ($path)
{
    header('Location:'. APP_URL . '/' . $path);
   
    die;
}
function back()
{
    header("Location: {$_SERVER['HTTP_REFERER']}");
}