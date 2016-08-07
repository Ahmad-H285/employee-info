<?php 
	
	require_once "../models/Employee.php";

	$create_array = json_encode( array('employee-name' => $_POST['employee-name'], 'employee-email' => $_POST['employee-email'], 'employee-image' => $_POST['employee-image']) );

	echo $create_array;

	$create_user = new Employee();

	$create_user -> createEmployee($_POST['employee-name'], $_POST['employee-email'], $_POST['employee-address'], $_POST['employee-image']);
