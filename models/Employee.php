<?php 

// This Class will contain all the actions for the employe ( Create, view, edit, delete )

Class Employee {

	// In the constructom the database cpnnection will be passed

	private $conn;
	private $user_name;
	private $email;
	private $address;
	private $image_location;

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

		if( mysqli_query($this -> conn, $sql) == true ) {
			echo "Employee Added";
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

}