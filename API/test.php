<?php
$DB['HOST']='localhost';
$DB['USER']='unsupply1';
$DB['PASS']='3Tzc52d&';
$DB['DB']='bf-unsuppliers_org_db';
$DB['PORT']='3306';

$obj = new stdClass;
$obj = (object) $DB;

var_dump($obj);

?>