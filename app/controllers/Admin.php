<?php 

// For Determing the Tab 
$tab = $_GET['tab'] ?? 'dashboard';

if($tab == "products")
{

	$productClass = new Product();
	$pager = new Pager();
	$limit = 10;
	$offset = $pager->offset;
	$products = $productClass->query("select * from products order by id desc limit $limit offset $offset");
}else
if($tab == 'sales')
{
	$salesClass = new Sale();
	$limit = 10;
	$pager  = new Pager($limit);
	$offset = $pager->offset;
	$sales  = $salesClass->query("Select * from sales order by id desc limit $limit offset $offset");

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
	$limit = 10;
	$pager = new Pager($limit);
	$offset = $pager->offset;

	$userClass = new User();
	$users = $userClass->query("select * from users order by id desc limit $limit offset $offset");
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

