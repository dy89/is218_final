<?php
date_default_timezone_set('America/New_york');
require('../model/database_oo.php');
require('../model/incident.php');
require('../model/incident_db.php');
require('../model/customer.php');
require('../model/customer_db.php');
require('../model/technician.php');
require('../model/technician_db_oo.php');
require_once('../model/fields.php');
require_once('../model/validate.php');
$validate = new Validate();
$fields = $validate->getFields();
$fields->addField('email');
session_start();

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
                    include('incident_login.php');
                } else {
                    $technician = TechnicianDB::getTechnicianEmail($email);
                    $Email = $technician->getEmail();
                    $_SESSION['tech']['email'] = $Email;
                    $techID = $technician->gettechID();
                    $_SESSION['tech']['techID'] = $techID;
                    include('incidents_list.php');
                }
        break;
    case 'list_incidents':
		$incidents = IncidentDB::getincidentsbyTech($_SESSION['tech']['techID']);
		$_SESSION['tech']['incidents'] = $incidents;
    	include('incidents_list.php');
    	break;
    case 'select_tech':
    	$incidentID = filter_input(INPUT_POST, 'incidentID');
    	$_SESSION['logged']['incidentID'] = $incidentID;
    	$technicians = IncidentDB::gettechIncidents();
    	$_SESSION['logged']['technicians'] = $technicians;
    	include('tech_list.php');
    	break;
    case 'assign_tech':
    	$techID = filter_input(INPUT_POST, 'techID');
    	$_SESSION['logged']['techID'] = $techID;
    	$incident = IncidentDB::getIncident($_SESSION['logged']['incidentID']);
    	$technician = TechnicianDB::getTechnician($_SESSION['logged']['techID']);
    	include('assign_incident.php');
    	break;
    case 'assign':
    	$incident = IncidentDB::getIncident($_SESSION['logged']['incidentID']);
    	$incident->settechID($_SESSION['logged']['techID']);
    	IncidentDB::assignIncident($incident);
    	include('assign_success.php');
    	break;
}
?>