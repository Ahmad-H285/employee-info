<?php 

// This Class will contain all the actions for the employe ( Create, view, edit, delete )

Class Employee {

	// In the constructom the database cpnnection will be passed

	private $conn;
	private $user_name;
	private $email;
	private $address;
	private $image_location;
	private $single_employee_email;

	function __construct() {

		$this -> conn = mysqli_connect("localhost", "root", "root", "employee");

		if(!($this -> conn)) {

			die("Connection Failed" . mysqli_connect_error());

		}

		//echo "success";

	}

	// create a new employee entry in the users table

	function createEmployee ($user_name, $email, $address, $image_location) {

		$sql = "INSERT INTO `users`(`user_name`, `email`, `address`, `image_location`) VALUES ('$user_name','$email','$address','$image_location')";

		if( !(mysqli_query($this -> conn, $sql) == true ) ) {
			echo "Problem occured while adding employee";
		}

		mysqli_close($this -> conn);

	}

	// retrieve employees username and email from users table

	function listEmployees () {

		$retrieve_employees = "SELECT `id`, `user_name`, `email` FROM `users`";

		$list_result = mysqli_query($this -> conn, $retrieve_employees);

		//var_dump($list_result);

		if($list_result) {

			$row_count = 0;

			while ($employee_record = mysqli_fetch_array($list_result)) {
				
				//var_dump($employee_record);

				 $result[$row_count] = $employee_record;

				 $row_count++;

			}

			return $result;

		}

		mysqli_close($this -> conn);

	}

	// return a single employee records according to his unique email

	function viewEmployee ($single_employee_email) {

		$return_employee_record = "SELECT `user_name`, `email`, `address`, `image_location` FROM `users` WHERE `email` = '$single_employee_email'";

		$employee_data = mysqli_query($this -> conn, $return_employee_record);

		if($employee_data) {

			//$row_count = 0;

			while ($employee_row = mysqli_fetch_row($employee_data)) {
				
				 $employee_result = $employee_row;

				 //$row_count++;

			}

			return $employee_result;

		}

		mysqli_close($this -> conn);

	}

}

