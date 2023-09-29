<?php 

// For Determing the Tab 
$tab = $_GET['tab'] ?? 'dashboard';

if($tab == "products")
{

	$productClass = new Product();
	$pager = new Pager();
	$limit = 10;
	$offset = $pager->offset;
	$products = $productClass->query("SELECT * FROM products ORDER BY id DESC LIMIT $limit OFFSET $offset");
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

	$query  = "SELECT * FROM sales ORDER BY id DESC LIMIT $limit OFFSET $offset";
	
	//Get Total Sales 
	$year = date("Y");
	$month = date("m");
	$day = date("d");
	
	$query_total = "SELECT SUM(total) AS total FROM sales WHERE DAY(date)=$day && MONTH(date)= $month && YEAR(date) = $year";

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

	if($section == 'graph')
	{
		//Read The Graph data
		$db = new Database();

		//Query Today's Records
		$today_date = date('Y-m-d');
		$query = "SELECT total,date FROM sales WHERE DATE(date) = '$today_date' ";
		$today_records = $db->query($query);

		//Query This Month's Records
		$thismonth = date('m');
		$thisyear = date('Y');
		
		$query = "SELECT total,date FROM sales WHERE MONTH(date) = '$thismonth' && YEAR(date)= '$thisyear'";
		$thismonth_records = $db->query($query);

		//Query This Year's Records
		$thisyear = date('Y');
		
		$query = "SELECT total,date FROM sales WHERE YEAR(date)= '$thisyear'";
		$thisyear_records = $db->query($query);

	}

}else
if($tab == 'users')
{
	$limit = 10;
	$pager = new Pager($limit);
	$offset = $pager->offset;

	$userClass = new User();
	$users = $userClass->query("SELECT * FROM users ORDER BY id DESC LIMIT $limit OFFSET $offset");
}else
if($tab == 'dashboard')
{
	$db = new Database();
	
	// For Total Users
	$query = "SELECT COUNT(id) AS total FROM users";

	$myusers = $db->query($query);
	$total_users = $myusers[0]['total'];

	//For Total Products
	$query = "SELECT COUNT(id) AS total FROM products";

	$myproducts = $db->query($query);
	$total_products = $myproducts[0]['total'];

	//For Total Sales
	$query = "SELECT SUM(total) AS total FROM sales";

	$mysales = $db->query($query);
	$total_sales = $mysales[0]['total'];
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

