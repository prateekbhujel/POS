<?php

if(isset($_SESSION['user']))
{
    
    unset($_SESSION['USER']);
}

redirect('login');
























// session_destroy();
// session_regenerate_id();