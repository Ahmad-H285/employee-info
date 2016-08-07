<?php

	//echo "Hi There";

	require_once "../models/Employee.php";

	//echo $_FILES['file_attach']['tmp_name'];

	$image_upload = new Employee();

	if ($_FILES['file_attach']['name'] != null) {

		$image_upload -> uploadEmployeeImage($_FILES['file_attach']);
	
	}
	
	else if ($_FILES['file_attach_edit']['name'] != null) {

		$image_upload -> uploadEmployeeImage($_FILES['file_attach_edit']);

	}