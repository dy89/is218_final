<?php
require('../model/database.php');
require('../model/product.php');
require('../model/product_db.php');
$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'list_products';
    }
}

if ($action == 'list_products') {
	$productCode = filter_input(INPUT_GET, 'productCode');
	$products = ProductDB::getProducts();
    include('product_list.php');
}
?>