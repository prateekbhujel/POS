<?php


    function dd($value)
    {
        echo"<pre>";
        print_r($value);
        echo"</pre>";
        die();
    }

    function show($stuff)
    {
        echo"<pre>";
        print_r($stuff);
        echo"</pre>";
    }
    function views_path($view)
    {
        if(file_exists("../app/views/$view.view.php"))
        {
            return "../app/views/$view.view.php";
        }else
        {
            echo"View '$view' not found";
        }
    }


    function esc($str)
    {
        return htmlspecialchars($str);
    }


    function db_connect()
    {
        $DBNAME = "pos_db"; 
        $DBHOST = "localhost"; 
        $DBUSER  = "root";
        $DBPASS  = "";
        $DBDRIVER = "mysql";

        try{

            $con = new PDO("$DBDRIVER:host=$DBHOST;dbname=$DBNAME",$DBUSER, $DBPASS);
        }
        catch(PDOException $e)
        {
            

            echo $e->getMessage();
        }
        
        return $con; 

    }

    function query($query, $data = array() )
    {
        $con = db_connect();
        $smt = $con->prepare($query);
        $check = $smt->execute($data);

        if($check)
        {
            $result = $smt->fetchAll(PDO::FETCH_ASSOC);
            
            if(is_array($result) && count($result) > 0)
            {

                return $result;
            }
        }

        return false;
    }

    function allowed_columns($data, $table)
    {
        if($table == 'users')
        {
            $columns = [
                'username',
                'email',
                'password',
                'role',
                'image',
                'date',
            ];

            foreach ($data as $key => $value) 
            {
                if(!in_array($key, $columns))
                {
                    unset($data[$key]);
                }
            }
            
            return $data;
        }
    }

    function insert($data, $table)
    {
        
            
        $clean_array = allowed_columns($data, $table);
        $keys = array_keys($clean_array);

        $query = "insert into $table";
        $query .= "(".implode(",", $keys).") values ";
        $query .= "( :".implode(", :", $keys).")";

        query($query, $clean_array);
    }    
    
    function validate($data, $table)
    {

        $errors = [];

        if($table == 'users')
        {
    
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
                $errors['password'] = 'Password must have one Uppercase and at least one Number';
            }
            

        }

        return $errors;
    }

    function set_value($key, $default = '')
    {
        if(!empty($_POST[$key])) 
        {
            return $_POST[$key];
        }
    
        return $default;
    }
    