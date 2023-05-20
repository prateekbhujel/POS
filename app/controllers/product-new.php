<?php

$errors = [];
if($_SERVER['REQUEST_METHOD'] == 'POST')
{

    $product = new Product();
    
    $_POST['date'] = date("Y-m-d H:i:s");
    $_POST['barcode'] = empty($_POST['barcode']) ? $product->generate_barcode() : $_POST['barcode'];

    if(!empty($_FILES))
    {
        $_POST['image'] = $_FILES['image'];
    }
    
    $errors = $product->validate($_POST);
    if(empty($errors))
    {

        $product->insert($_POST);

        redirect('admin&tab=products');
    }

}

require views_path('products/products-new');