<?php 
	
	require_once "../models/Employee.php";

	echo $_POST['employee-name'];
	echo $_POST['employee-email'];
	echo $_POST['employee-address'];
	echo $_POST['employee-image'];

	$create_user = new Employee();

	$create_user -> createEmployee($_POST['employee-name'], $_POST['employee-email'], $_POST['employee-address'], $_POST['employee-image']);

	//var_dump($create_user);