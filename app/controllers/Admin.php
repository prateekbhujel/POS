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
	$salesClass = new Sale();
	$sales = $salesClass->query("Select * from sales order by id desc");

	//Get Total Sales 
	$year = date("Y");
	$month = date("m");
	$day = date("d");
	
	$query = "select SUM(total) as total from sales where day(date)=$day && month(date)= $month && year(date) = $year";
	
	$st = $salesClass->query($query);
	$sales_total = 0;

	if($st)
	{
		$sales_total =  $st[0]['total'] ?? 0;
	}

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

