<?php
	
	require_once "../models/Employee.php";

	$delete_record = new Employee();
	$delete_employee = $delete_record -> deleteEmployee($_POST['employee-email']);

	echo $delete_employee;
