<?php

$errors = [];
if($_SERVER['REQUEST_METHOD'] == 'POST')
{

    $_POST['role'] = "user";
    $_POST['date'] = date("Y-m-d H:i:s");
    
    $errors = validate($_POST, 'users');
    if(empty($errors))
    {
        insert($_POST, 'users');
    }

}

require views_path('auth/signup');
