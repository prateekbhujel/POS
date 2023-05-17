<?php

$errors = [];

if($_SERVER['REQUEST_METHOD'] == 'POST')
{

      if($row = where(['email' => $_POST['email']], 'users'))
      {
           
            if(password_verify($_POST['password'],$row[0]['password']))
            {
                authenicate($row[0]);
                redirect('home');

            }else
            {
                $errors['password'] = 'Wrong Password !';
            }
      }else        
      {
        $errors['email'] = "Wrong Email !";
      }


}

require views_path('auth/login');
