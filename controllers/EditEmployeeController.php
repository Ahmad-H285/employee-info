<?php

	require_once "../models/Employee.php";

	// echo $_POST['employee_edit_email_old'];
	
	// echo $_POST['employee_edit_name'];
	// echo $_POST['employee_edit_email'];
	// echo $_POST['employee_edit_address'];
	// echo $_POST['employee_edit_picture'];

	$employee_edit = new Employee();
	$employee_edit_record = $employee_edit -> editEmployee(
			
			$_POST['employee_edit_email_old'], 
			$_POST['employee_edit_name'],
			$_POST['employee_edit_email'],
			$_POST['employee_edit_address'],
			$_POST['employee_edit_picture']
		
		);

	$employee_new_array = json_encode(array(

			'employee-name' => $employee_edit_record[0],
			'employee-email' => $employee_edit_record[1],
			'employee-address' => $employee_edit_record[2],
			'employee-image' => $employee_edit_record[3]

		));

	echo $employee_new_array;