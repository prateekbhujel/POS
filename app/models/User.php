<?php

/*
*   User Class
*/

class User extends Model
{
    
    protected $table = 'users';
    protected $allowed_columns= [
                'username',
                'email',
                'password',
                'role',
                'image',
                'date',
    ];

/*  This Function is Used to validation             */
    public function validate($data)
    {

        $errors = [];
    
        //Check Username
        if(empty($data['username']))
        {
            $errors['username'] = "Username is required";
        }else
        if(!preg_match('/[a-zA-Z ]/', $data['username']))
        {
            $errors['username'] ="only letters and spaces allowed in username";
        }


            //Check Email
            if(empty($data['email']))
            {
                $errors['email'] = "Email is required";
            }else
            if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL))
            {
                $errors['email'] ="Email-Address Is Not Valid";
            }


            //Check Password
        if(empty($data['password']))
        {
            $errors['password'] = "Password is required";
        }else
        if($data['password'] !== $data['password_retype'])
        {
            $errors['password_retype'] ="Password Do not match Please Retype !";
        }else
        if(strlen($data['password']) < 8 || !preg_match('/[A-Z]/', $data['password']) || !preg_match('/[0-9]/', $data['password']))
        {
            $errors['password'] = 'Password must have at least one  Uppercase and NUmber should be 8 characters long';
        }

        return $errors;
    }

    
    

    
}