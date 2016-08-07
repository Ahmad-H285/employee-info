
<?php 

	require_once "../models/Employee.php";

	$employee_result = new Employee();
	$employee_record = $employee_result -> viewEmployee($_POST['employee-email']);

	$employee_array = json_encode(array(

			'employee-name' => $employee_record[0],
			'employee-email' => $employee_record[1],
			'employee-address' => $employee_record[2],
			'employee-image' => $employee_record[3]

		));

	echo $employee_array;