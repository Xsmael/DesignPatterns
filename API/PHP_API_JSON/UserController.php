<?php
session_start();
include("../config.php");
function __autoload($className){ // Autoloading model classes, change the path to match your directory structure
	include_once("../models/$className.php");	
}

$userObj=new UserModel($DB['HOST'],$DB['USER'],$DB['PASS'],$DB['DB']);
$_POST = json_decode(file_get_contents('php://input'), true); // Handling JSON format

if(!isset($_POST['action'])) {
	print json_encode(0);
	return;
}

if($_POST['action'] != 'login') authorizedAccess(true);

switch($_POST['action']) {
	// case 'read_all':
	// 	print $userObj->read();		
	// break;

	case 'view_read_all':
		print $userObj->view_readAll();		
	break;	
	
	case 'read':
		$jsonObj = (object) $_POST['obj'];
		print $userObj->read($jsonObj);		
	break;
	
	case 'create':
		$jsonObj = (object) $_POST['obj'];
		print $userObj->create($jsonObj);		
	break;
	
	case 'login':
		$jsonObj = (object) $_POST['obj'];
		print $userObj->login($jsonObj);		
	break;

	case 'current_user':
		print $userObj->curentUser();		
	break;
	case 'logout':
		print $userObj->logout();		
	break;
	
	case 'delete':
		$jsonObj = (object) $_POST['obj'];
		print $userObj->delete($jsonObj);		
	break;
	
	case 'update':
		$jsonObj = (object) $_POST['obj'];
		print $userObj->update($jsonObj);				
	break;
	
	default:
		print INVALID_REQUEST;
	break;
}

function authorizedAccess($activate)
{
	if(!$activate) return;
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 1) return;
    else  exit();
}

function isLogged()
{
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 1) return true;
    else return false;
} 

exit();