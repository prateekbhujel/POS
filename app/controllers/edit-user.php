<?php 

$errors = [];
$user = new User();

$id = $_GET['id'] ?? null;
$row = $user->first(['id'=>$id]);

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    //Make Sure //Only admin can make other admins
	if($_POST['role'] == "admin")
    {
        if(!Auth::get('role')== 'admin')
        {
            $_POST['role'] = 'user';
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

		redirect('admin&tab=users');
	}
    
}
	
if(Auth::access('admin'))
{
	
	require views_path('auth/edit-user');
}else
{
	Auth::setMessage('You need to Login as Admin to Access this Page !');
	require views_path('auth/denied');
}

