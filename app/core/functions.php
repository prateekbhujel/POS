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
    
    
    function redirect($page)
    {
       
        header("Location: index.php?pg=" .$page);
       die();
    
    }

    function set_value($key, $default = '')
    {
        if(!empty($_POST[$key])) 
        {
            return $_POST[$key];
        }
    
        return $default;
    }

    
    function authenicate($row)
    {
        
        $_SESSION['USER'] = $row;
    }


    function auth($column)
    {
        if(!empty($_SESSION['USER'][$column])){
            return $_SESSION['USER'][$column];
        }
    
        return "Unknown";
    }
    

    function crop($filename, $size = 400)
    { 
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION)); 
        $cropped_file = preg_replace("/\.$ext$/", "_cropped.".$ext, $filename);

        if(file_exists($cropped_file))
        {
            return $cropped_file ;
        }

        /* Creating an Image Resource */
        switch ($ext) {
            case 'jpg':
            case 'jpeg':
                $src_image = imagecreatefromjpeg($filename);   
                break;
            
            case 'png':
                $src_image = imagecreatefrompng($filename);   
                break;
            
            case 'webp':
                $src_image = imagecreatefromwebp($filename);
                break;

            case 'gif':
                $src_image = imagecreatefromgif($filename);
                break;
  
            default:
                return $filename;
                break;
        }

        /* Assing variable values */
        $dst_x= 0;
        $dst_y = 0;
        $dst_w = (int)$size;
        $dst_h = (int)$size;
        
        $orginal_width = imagesx($src_image);
        $orginal_height = imagesy($src_image);

        if($orginal_width < $orginal_height)
        {
            $src_x = 0;
            $src_y = ($orginal_height - $orginal_width) / 2;
            $src_w = $orginal_width;
            $src_h = $orginal_width;

        }else
        {
            
            $src_y = 0;
            $src_x = ($orginal_width - $orginal_height) / 2;
            $src_w = $orginal_height;
            $src_h = $orginal_height;
        }
       
        
        /* Setting The Cropping  Parms  */  
        $dst_image = imagecreatetruecolor((int)$size, (int)$size);

        imagecopyresampled($dst_image, $src_image, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);

    /* Save the Final Image */  
        switch ($ext) {
            case 'jpg':
            case 'jpeg':
                imagejpeg($dst_image, $cropped_file, 90);
                break;
            
            case 'png':
                imagepng($dst_image, $cropped_file);   
                break;
            
            case 'webp':
                imagewebp($dst_image, $cropped_file);;
                break;

            case 'gif':
                imagegif($dst_image, $cropped_file);
                break;
  
            default:
                return $filename;
                break;
        }

        imagedestroy($dst_image);
        imagedestroy($src_image);
        
        return $cropped_file;
    }