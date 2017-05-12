<?php
require('../model/database_oo.php');
require('../model/customer.php');
require('../model/customer_db.php');
require('../model/product.php');
require('../model/product_db.php');
require('../model/registration.php');
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
switch($action) {
    case 'get_customer':
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
		break;
    case 'register_incident':
		$productCode = filter_input(INPUT_POST, 'productkey');
		$title = filter_input(INPUT_POST, 'title');
		$description = filter_input(INPUT_POST, 'description');
		$customerID = filter_input(INPUT_POST, 'customerID');
		$productCode = filter_input(INPUT_POST, 'productCode');
		$validate->text('title', $title);
		$validate->text('description', $description);

		$product = ProductDB::getProduct($productCode);
		$productCode = $product->getproductCode();
		if ($fields->hasErrors()) {
			$customer = CustomerDB::getCustomer($customerID);
			$fullName = $customer->getfullName();
			//$customerID = $customer->getcustomerID();
			$registrations = CustomerDB::getRegistrations($customerID);
			include('create_incident.php');
		} else {
			include('incident_success.php');
		}
		break;
}
?>