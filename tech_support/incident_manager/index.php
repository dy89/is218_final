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
$fields->addField('title');
$fields->addField('description');

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'get_customer';
    }
}

if ($action == 'get_customer') {
	$email = filter_input(INPUT_POST, 'email');
	$validate->email('email', $email);
	if ($fields->hasErrors()) {
		include('customer_login.php');
	} else {
		$customer = CustomerDB::getCustomerEmail($email);
		$fullName = $customer->getfullName();
		$customerID = $customer->getcustomerID();
		$registrations = CustomerDB::getRegistrations($customerID);
		include('create_incident.php');
	}
} else if ($action =='register'){
	$productCode = filter_input(INPUT_POST, 'productkey');
	$customerID = filter_input(INPUT_POST, 'customerID');
	$product = ProductDB::getProduct($productCode);
	$productCode = $product->getproductCode();
	include('register_success.php');
}
?>