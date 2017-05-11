<?php
require('../model/database.php');
require('../model/technician.php');
require('../model/technician_db.php');
require_once('../model/fields.php');
require_once('../model/validate.php');
$validate = new Validate();
$fields = $validate->getFields();
$fields->addField('firstName');
$fields->addField('lastName');
$fields->addField('email');
$fields->addField('phone');
$fields->addField('password');

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'list_technicians';
    }
}

if ($action == 'list_technicians') {
	$techID = filter_input(INPUT_GET, 'techID');
	$technicians = TechnicianDB::getTechnicians();
    
    //Display Technician List
    include('technician_list.php');
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