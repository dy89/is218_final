<?php
require('../model/database.php');
require('../model/customer.php');
require('../model/customer_db.php');
require_once('../model/fields.php');
require_once('../model/validate.php');
$validate = new Validate();
$fields = $validate->getFields();
$fields->addField('firstName');
$fields->addField('lastName');
$fields->addField('address');
$fields->addField('city');
$fields->addField('state');
$fields->addField('postalCode');
$fields->addField('countryCode');
$fields->addField('phone');
$fields->addField('email');
$fields->addField('password');

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'search_customer';
    }
}

if ($action == 'search_customer') {
	$lastName = filter_input(INPUT_POST, 'lastName');
	$lastName = ucfirst(strtolower($lastName));
	$customers = CustomerDB::getCustomers($lastName);
    
    //Display Customer Search
    include('customer_search.php');

} else if ($action =='view_customer'){
	$customerID = filter_input(INPUT_POST, 'customerID');
	$customer = CustomerDB::getCustomer($customerID);
	$firstName = $customer->getfirstName();
	$lastName = $customer->getlastName();
	$address = $customer->getAddress();
	$city = $customer->getCity();
	$state = $customer->getState();
	$postalCode = $customer->getpostalCode();
	$countryCode = $customer->getcountryCode();
	$phone = $customer->getPhone();
	$email = $customer->getEmail();
	$password = $customer->getPassword();
	include('customer_view.php');

} else if ($action =='update_customer') {
	$customerID = filter_input(INPUT_POST, 'customerID');
	$firstName = filter_input(INPUT_POST, 'firstName');
	$lastName = filter_input(INPUT_POST, 'lastName');
	$address = filter_input(INPUT_POST, 'address');
	$city = filter_input(INPUT_POST, 'city');
	$state = filter_input(INPUT_POST, 'state');
	$postalCode = filter_input(INPUT_POST, 'postalCode');
	$countryCode = filter_input(INPUT_POST, 'countryCode');
	$phone = filter_input(INPUT_POST, 'phone');
	$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
	$password = filter_input(INPUT_POST, 'password');
	$validate->text('firstName', $firstName);
	$validate->text('lastName', $lastName);
	$validate->text('address', $address);
	$validate->text('city', $city);
	$validate->text('state', $state);
	$validate->number('postalCode', $postalCode);
	$validate->text('countryCode', $countryCode);
	$validate->text('phone', $phone);
	$validate->email('email', $email);
	$validate->text('password', $password);
	if ($fields->hasErrors()) {
		include('customer_view.php');
	} else {
		$customer = new Customer($firstName, $lastName, $address, $city, $state, $postalCode, $countryCode, $phone, $email, $password);
		$customer->setcustomerID($customerID);

		CustomerDB::updateCustomer($customer);
		$lastName = $customer->getlastName();
		$customers = CustomerDB::getCustomers($lastName);
		include('customer_search.php');
	}
}
?>