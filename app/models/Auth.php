<?php


/**
 * Authentication Class
 */
class Auth {

    //Getting anycolumn form the currently logged in user.

    public static function get($column)
    {
        if(!empty($_SESSION['USER'][$column])){
            return $_SESSION['USER'][$column];
        }
    
        return "Unknown";
    }

    public static function logged_in()
    {
        //Checks the data from the database and verify the User and determines either user is logged in or not.
        // To make it Indepedent Remove the $db instance and just return true or false.

        if(!empty($_SESSION['USER'])){
            
            $db = new Database();
            if($db->query("select * from users where email = :email limit 1", ['email'=>$_SESSION['USER']['email']]))
            {
                return true;
            }
        } 

        return false;
    }

    public static function access($role)
    {

        $access['admin']       = ['admin'];
        $access['supervisor']  = ['admin', 'supervisor'];
        $access['cashier']     = ['admin', 'supervisor', 'cashier'];
        $access['accountant']  = ['admin','accountant'];
        $access['user']        = ['admin', 'supervisor', 'cashier', 'user'];

        $myrole = self::get('role');

        if(in_array($myrole, $access[$role]))
        {
            return true;
        }

        return false;
    }

    public static function setMessage($message)
    {
        $_SESSION['MESSAGE'] = $message;
    }

    
    public static function getMessage()
    {
        if(!empty($_SESSION['MESSAGE']))
        {
            $message = $_SESSION['MESSAGE'];
            unset($_SESSION['MESSAGE']);
            return $message;
        }
    }
}
