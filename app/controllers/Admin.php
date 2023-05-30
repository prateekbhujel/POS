<?php 

// For Determing the Tab 
$tab = $_GET['tab'] ?? 'dashboard';

if($tab == "products")
{

	$productClass = new Product();
	$products = $productClass->query("select * from products order by id desc");
}else
if($tab == 'sales')
{
	// $salesClass = new Sales();
	// $sales = $salesClass->query("Select * from sales order by id desc");
}else
if($tab == 'users')
{
	$userClass = new User();
	$users = $userClass->query("select * from users order by id desc");
}


// For Authenticating Users 
if(Auth::access('supervisor'))
{
	
	require views_path('admin/admin');
}else
{
	Auth::setMessage('You dont have access to admin page !');
	require views_path('auth/denied');
}

