<?php
date_default_timezone_set('America/New_york');
$message = '';
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
switch($action) {
    case 'list_products':
		$productCode = filter_input(INPUT_GET, 'productCode');
		$products = ProductDB::getProducts();
    
    	//Display Product List
    	include('product_list.php');
    	break;
    case 'delete_product':
		$productCode = filter_input(INPUT_POST, 'productCode');

		//Delete Product
		ProductDB::deleteProduct($productCode);
		$products = ProductDB::getProducts();
		include('product_list.php');
		break;

    case 'show_add_form':
		include('product_add.php');
		break;
    case 'add_product':
		$productCode = filter_input(INPUT_POST, 'productCode');
		$name = filter_input(INPUT_POST, 'name');
		$version = filter_input(INPUT_POST, 'version', FILTER_VALIDATE_FLOAT);
		$releaseDate_s = filter_input(INPUT_POST, 'releaseDate');
		$validate->productCode('productCode', $productCode);
		$validate->text('name', $name);
		$validate->number('version', $version);
		try{
            $releaseDate = new DateTime($releaseDate_s);
        } catch (Exception $e){
            $error_message = $e->getMessage();
            echo "<p>Error Message: $error_message </p>";
            $message = "Please enter a proper date format.";
        }
        $releaseDate_f = $releaseDate->format('y-m-d');
		if ($fields->hasErrors()) {
			include('product_add.php');
		} else {
			$product = new Product($productCode, $name, $version, $releaseDate_f);
			ProductDB::addProduct($product);
			$products = ProductDB::getProducts();
			include('product_list.php');
		}
		break;
}
?>