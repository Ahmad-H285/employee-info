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
	private $image_file;

	function __construct() {

		$this -> conn = mysqli_connect("localhost", "root", "root", "employee");

		if(!($this -> conn)) {

			die("Connection Failed" . mysqli_connect_error());

		}

	}

	// create a new employee entry in the users table

	function createEmployee ($user_name, $email, $address, $image_location) {

		$sql = "INSERT INTO `users`(`user_name`, `email`, `address`, `image_location`) VALUES ('$user_name','$email','$address','$image_location')";

		if( !(mysqli_query($this -> conn, $sql) ) ) {
			echo "Problem occured while adding employee";
		}

		mysqli_close($this -> conn);

	}

	// retrieve employees username and email from users table

	function listEmployees () {

		$retrieve_employees = "SELECT `id`, `user_name`, `email`, `image_location` FROM `users`";

		$list_result = mysqli_query($this -> conn, $retrieve_employees);

		if($list_result) {

			$row_count = 0;

			while ($employee_record = mysqli_fetch_array($list_result)) {
				
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

			while ($employee_row = mysqli_fetch_row($employee_data)) {
				
				 $employee_result = $employee_row;

			}

			return $employee_result;

		}

		mysqli_close($this -> conn);

	}

	// Edit specific employee according to his unizue email

	function editEmployee($single_employee_email, $user_name, $email, $address, $image_location) {

		$update_query = "UPDATE `users` SET `user_name`='$user_name',`email`='$email',`address`='$address',`image_location`='$image_location' WHERE `email`='$single_employee_email'";

		$edit_employee = mysqli_query($this -> conn, $update_query);

		$return_updated_employee = "SELECT `user_name`, `email`, `address`, `image_location` FROM `users` WHERE `email` = '$email'";

		$employee_new_record = mysqli_query($this -> conn, $return_updated_employee);

		if($employee_new_record) {

			while ($employee_new = mysqli_fetch_row($employee_new_record)) {
				
				 $employee_edit = $employee_new;

			}

			return $employee_edit;

		}

		mysqli_close($this -> conn);

	}

	// Delete employee using his unique email

	function deleteEmployee($single_employee_email) {

		$delete_query = "DELETE FROM `users` WHERE `email`='$single_employee_email'";

		$delete_employee = mysqli_query($this -> conn, $delete_query);

		if(!$delete_employee) {

			echo "Record could not be deleted";

		}

	}

	// Upload employee image

	function uploadEmployeeImage($image_file) {

		if($image_file['type'] != 'image/png' && $image_file['type'] != 'image/jpeg' && $image_file['type'] != 'image/png' && $image_file['type'] != 'image/gif' && $image_file['type'] != 'image/JPEG' && $image_file['type'] != 'image/PNG' && $image_file['type'] != 'image/GIF' && $image_file['type'] != 'image/jpg' && $image_file['type'] != 'image/JPG'){
    	
    		die('Unsupported filetype uploaded.');
		
		}

		if(!move_uploaded_file($image_file['tmp_name'], '../assets/images/'.$image_file['name'])) {

			die('Error file upload');

		}

		echo "file uploaded successfully";

	}

}

