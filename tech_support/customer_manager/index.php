<?php
require('../model/database.php');

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'list_customers';
    }
}

if ($action == 'list_customers') {
	$customerID = filter_input(INPUT_GET, 'customerID');
	$lastName = filter_input(INPUT_GET, 'lastName');
	$customers = CustomerDB::getCustomers();
    
    //Display Technician List
    include('customer_list.php');
} else if ($action == 'delete_technician') {
	$techID = filter_input(INPUT_POST, 'techID');

	//Delete Technician
	TechnicianDB::deleteTechnician($techID);
	$technicians = TechnicianDB::getTechnicians();
	include('technician_list.php');
} else if ($action =='show_addtech_form') {
	include('technician_add.php');
} else if ($action =='add_technician'){

	//Add Technician
	$firstName = filter_input(INPUT_POST, 'firstName');
	$lastName = filter_input(INPUT_POST, 'lastName');
	$email = filter_input(INPUT_POST, 'email');
	$phone = filter_input(INPUT_POST, 'phone');
	$password = filter_input(INPUT_POST, 'password');
	$validate->text('firstName', $firstName);
	$validate->text('lastName', $lastName);
	$validate->email('email', $email);
	$validate->phone('phone', $phone);
	$validate->text('password', $password);
	if ($fields->hasErrors()) {
		include('technician_add.php');
	} else {
		$technician = new Technician($firstName, $lastName, $email, $phone, $password);
		TechnicianDB::addTechnician($technician);
		$technicians = TechnicianDB::getTechnicians();
		include('technician_list.php');
	}
}
?>