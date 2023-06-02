<?php 

$errors = [];
$user = new User();

$id = $_GET['id'] ?? null;
$row = $user->first(['id'=>$id]);
if(!empty($_SERVER['HTTP_REFERER']))
{
    $_SESSION['referer'] = $_SERVER['HTTP_REFERER'];
}
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    //Make Sure //Only admin can make other admins
	if(isset($_POST['role']) && $_POST['role'] != $row['role'])
    {
        if(Auth::get('role') != 'admin')
        {
            $_POST['role'] = $row['role'];
        }
    }
	
	$errors = $user->validate($_POST, $id);
	if(empty($errors)){
		
		if(empty($_POST['password']))
        {
            unset($_POST['password']);
        }else{
                $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);    
        }
		
        $user->update($id, $_POST);
 
		redirect("edit-user&id=$id");
	}
    
}
	
if(Auth::access('admin')|| ($row && $row['id'] == Auth::get('id')))
{
	
	require views_path('auth/edit-user');
}else
{
	Auth::setMessage('You need to Login as Admin to Access this Page !');
	require views_path('auth/denied');
}

