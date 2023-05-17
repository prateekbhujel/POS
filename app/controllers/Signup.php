<?php

$errors = [];
if($_SERVER['REQUEST_METHOD'] == 'POST')
{

    $_POST['role'] = "user";
    $_POST['date'] = date("Y-m-d H:i:s");
    
    $errors = validate($_POST, 'users');
    if(empty($errors))
    {
        
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        insert($_POST, 'users');

        redirect('login');
    }

}

require views_path('auth/signup');
