<?php
require('../model/database.php');
require('../model/product.php');
require('../model/product_db.php');
require_once('../model/fields.php');
require_once('../model/validate.php');
$validate = new Validate();
$fields = $validate->getFields();
$fields->addField('productCode');
$fields->addField('name');
$fields->addField('version');
$fields->addField('releaseDate');

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
    
    //Display Product List
    include('product_list.php');
} else if ($action == 'delete_product') {
	$productCode = filter_input(INPUT_POST, 'productCode');

	//Delete Product
	ProductDB::deleteProduct($productCode);
	$products = ProductDB::getProducts();
	include('product_list.php');
} else if ($action =='show_add_form') {
	include('product_add.php');
} else if ($action =='add_product'){
	$productCode = filter_input(INPUT_POST, 'productCode');
	$name = filter_input(INPUT_POST, 'name');
	$version = filter_input(INPUT_POST, 'version', FILTER_VALIDATE_FLOAT);
	$releaseDate = filter_input(INPUT_POST, 'releaseDate');
	$validate->productCode('productCode', $productCode);
	$validate->text('name', $name);
	$validate->number('version', $version);
	$validate->date('releaseDate', $releaseDate);
	if ($fields->hasErrors()) {
		include('product_add.php');
	} else {
		$product = new Product($productCode, $name, $version, $releaseDate);
		ProductDB::addProduct($product);
		$products = ProductDB::getProducts();
		include('product_list.php');
	}
}
?>