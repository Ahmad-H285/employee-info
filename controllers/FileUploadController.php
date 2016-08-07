<?php

	require_once "../models/Employee.php";

	$image_upload = new Employee();

	if ($_FILES['file_attach']['name'] != null) {

		$image_upload -> uploadEmployeeImage($_FILES['file_attach']);
	
	}
	
	else if ($_FILES['file_attach_edit']['name'] != null) {

		$image_upload -> uploadEmployeeImage($_FILES['file_attach_edit']);

	}