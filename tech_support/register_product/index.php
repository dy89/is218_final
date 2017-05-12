<?php
date_default_timezone_set('America/New_york');
require('../model/database_oo.php');
require('../model/customer.php');
require('../model/customer_db.php');
require('../model/product.php');
require('../model/product_db.php');
require('../model/registration.php');
require_once('../model/fields.php');
require_once('../model/validate.php');
$expires = 0; //session cookie
session_set_cookie_params($lifetime, '/');
session_start();

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
    	if (!empty($_SESSION['logged']) && isset($_SESSION['logged'])) { 
    			include('register_product.php');
    	}else{
    		$_SESSION['logged'] = array(); 
			$email = filter_input(INPUT_POST, 'email');
			$validate->email('email', $email);
				if ($fields->hasErrors()) {
					include('customer_login.php');
				} else {
					$customer = CustomerDB::getCustomerEmail($email);
					$fullName = $customer->getfullName();
					$customerID = $customer->getCustomerID();
					$_SESSION['logged']['customer'] = $fullName;
					$_SESSION['logged']['customerID'] = $customerID;
					$Email = $customer->getEmail();
					$_SESSION['logged']['email'] = $Email;
					$registrations = CustomerDB::getRegistrations($_SESSION['logged']['customerID']);
					$_SESSION['logged']['reg'] = $registrations;
					include('register_product.php');
				}
		}	
		break;
    case 'register':
		$productCode = filter_input(INPUT_POST, 'productkey');
		$customerID = filter_input(INPUT_POST, 'customerID');
		$product = ProductDB::getProduct($productCode);
		$productCode = $product->getproductCode();
		include('register_success.php');
		break;
	case 'logout':
        $_SESSION = array();
        session_destroy();
        $name = session_name();
        $expire = 0;
        $params = session_get_cookie_params();
        $path = $params['path'];
        setcookie($name, '', $expire, $path);
        include('customer_login.php');
        break;
}
?>