<?php
require('../model/database.php');
require('../model/customer.php');
require('../model/customer_db.php');
require('../model/product.php');
require('../model/product_db.php');
require('../model/registration.php');
require('../model/registration_db.php');
require_once('../model/fields.php');
require_once('../model/validate.php');
$validate = new Validate();
$fields = $validate->getFields();
$fields->addField('email');

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'login';
    }
}
switch($action) {
    case 'login':
		$email = filter_input(INPUT_POST, 'email');
		$validate->email('email', $email);
		if ($fields->hasErrors()) {
			include('customer_login.php');
		} else {
			$customer = CustomerDB::getCustomerEmail($email);
			$fullName = $customer->getfullName();
			$products = ProductDB::getProducts();
			include('register_product.php');
		}
		break;
    case 'register':
		$productCode = filter_input(INPUT_POST, 'productkey');
		$customerID = filter_input(INPUT_POST, 'customerID');
		$product = ProductDB::getProduct($productCode);
		$productCode = $product->getproductCode();
		include('register_success.php');
		break;
}
?>