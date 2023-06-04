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
	$section   = $_GET['s'] ?? 'table';
	$startdate = $_GET['start'] ?? null;
	$enddate   = $_GET['end'] ?? null;
	
	$salesClass = new Sale();
	
	$limit  = $_GET['limit'] ?? 20;
	$limit  = (int)$limit;
	$limit  = $limit < 1 ? 10 : $limit;

	$pager  = new Pager($limit);
	$offset = $pager->offset;

	$query  = "Select * from sales order by id desc limit $limit offset $offset";
	
	//Get Total Sales 
	$year = date("Y");
	$month = date("m");
	$day = date("d");
	
	$query_total = "select SUM(total) as total from sales where day(date)=$day && month(date)= $month && year(date) = $year";

	//If start date and end date is set
	if($startdate && $enddate)
	{

		$query 	  = "SELECT * FROM sales WHERE DATE BETWEEN '$startdate' AND '$enddate' ORDER BY id DESC LIMIT $limit OFFSET $offset";

		$query_total = "SELECT SUM(total) AS total FROM sales WHERE DATE BETWEEN '$startdate' AND '$enddate'";
	}else

	//if only start date is set
	if($startdate && !$enddate)
	{

		$query 	  = "SELECT * FROM sales WHERE DATE = '$startdate' ORDER BY id DESC LIMIT $limit OFFSET $offset";
		
		$query_total = "SELECT SUM(total) AS total FROM sales WHERE DATE ='$startdate' ";
	}

	$sales = $salesClass->query($query);

	
	$st = $salesClass->query($query_total);
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

