<?php
session_start();


 function loadClasses($className)
 {
	include_once("$className.php");	
 }

 spl_autoload_register('loadClasses');
 // include("./clientModel.php");
 
 include("../db_config.php");

 $clientModel= new clientModel($DB['HOST'], $DB['DB'], $DB['USER'], $DB['PASS']);

 // $_POST = json_decode(file_get_contents('php://input'), true);

 if(!isset($_POST['action'])) {
	print 0;
	return;
}


switch($_POST['action']) {
	case 'lireTout':
		print $clientModel->lireTout();		
	break;
	
	case 'lire':
		print $clientModel->lire($_POST);		
	break;
	
	case 'creer':
		print $clientModel->creer($_POST);			
	break;
	
	
	case 'supprimer':
		print $clientModel->supprimer($_POST);		
	break;
	
	case 'modifier':
		print $clientModel->MAJ($_POST);				
	break;
	
	default:
		print 'INVALID REQUEST';
	break;
}

$lien= explode('?', $_SERVER['HTTP_REFERER'])[0];

header("Location:".$lien."?client=".$_POST['nom']);

exit();


?>