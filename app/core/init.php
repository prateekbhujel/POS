<?php

require '../app/core/functions.php';
require '../app/core/config.php';
require '../app/core/database.php';
require '../app/core/model.php';
// require '../app/models/User.php';

spl_autoload_register('my_function'); // Calls the missing calss

function my_function($classname)
{
    $filename = "../app/models/". ucfirst($classname) . ".php";
    if(file_exists($filename))
    {
        require $filename;
    }
}