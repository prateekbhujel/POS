<?php

$tab = isset($_GET['tab']) ? $_GET['tab'] : 'dashboard';

if($tab == 'products')
{

    $product_class = new Product;
    $products = $product_class->query('select * from products order by id desc');
}

require views_path('admin/admin');