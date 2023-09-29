<?php 

defined("ABSPATH") ? "":die();

if(Auth::access('cashier'))
{
	
	require views_path('home');
}else
{
	redirect('login');
}

