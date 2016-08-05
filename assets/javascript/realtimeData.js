

	// Ajax request to sent post data to the CreateEmployeeController

	function createEmployee() {

		var username = $("form#create-user-form .form-group #employee-name").val();
		var email = $("form#create-user-form .form-group #employee-email").val();
		var address = $("form#create-user-form .form-group #employee-address").val();
		var image = $("form#create-user-form .form-group #employee-picture").val();

		$.ajax({

			url: "../controllers/CreateEmployeeController.php",
			type: "post",
			data: {

				"employee-name": username,
				"employee-email": email,
				"employee-address": address,
				"employee-image": image

			},

			success: function(create) {
				var create_json = JSON.parse(create);

				var last_id_string = $("tr:last").children("td:first").html();
				var last_id_int = parseInt(last_id_string) + 1;
				var new_id_string = last_id_int.toString();
				
				$("tr:last").after("<tr><td class='employee-id'>"+new_id_string+
					"</td><td class='employee-name>"+create_json['employee-name']+
					"</td><td class='employee-email>"+create_json['employee-email']+
					"</td><td><a href='#' class='view-employee'>view</a></td><td><a href='#' class='edit-employee'>edit</a></td><td><a href='#' class='delete-employee'>delete</a></td></tr>");

			}

		});

	}

	// Ajax requerst to send post request to ViewEmployeeController and retrieve specific employee data

	function viewEmployee(event) {

		

			var employee_email_view = $(event.target).parent().parent().children("td.employee-email").text();
			
			$.ajax({

				url: "../controllers/ViewEmployeeController.php",
				type: "post",
				data: {

					"employee-email": employee_email_view

				},

				success: function(view) {

					var view_json = JSON.parse(view);

					// Add data for view table

					$("td.view-name").text(view_json['employee-name']);
					$("td.view-email").text(view_json['employee-email']);
					$("td.view-address").text(view_json['employee-address']);
					$("td.view-image").text(view_json['employee-image']);

					$("input[type='hidden']").attr("value", view_json['employee-email']);

					// Add data for edit form

					$("#employee-name-edit").attr("value", view_json['employee-name']);
					$("#employee-email-edit").attr("value", view_json['employee-email']);
					$("#employee-address-edit").attr("value", view_json['employee-address']);
					$("#employee-picture-edit").attr("value", view_json['employee-image']);

				}

			});

		

	}

	// Ajax request to send post request to EditEmployeeController to edit specific employee data

	function editEmployee() {

		var employee_email_old = $("input[type='hidden']").attr("value");

		var employee_name_edit = $("#employee-name-edit").val();
		var employee_email_edit = $("#employee-email-edit").val();
		var employee_address_edit = $("#employee-address-edit").val();
		var employee_picture_edit = $("#employee-picture-edit").val();

		$.ajax ({

			url: "../controllers/EditEmployeeController.php",
			type: "post",
			data: {
				
				"employee_edit_email_old": employee_email_old,
				"employee_edit_name": employee_name_edit,
				"employee_edit_email": employee_email_edit,
				"employee_edit_address": employee_address_edit,
				"employee_edit_picture": employee_picture_edit

			},

			success: function(edit) {

				var edit_json = JSON.parse(edit);

				$("td.employee-email").filter(function() {
					
					return $(this).text() === employee_email_old;
				
				}).parent().children("td.employee-name").text(edit_json['employee-name']);

				$("td.employee-email").filter(function() {
					
					return $(this).text() === employee_email_old;
				
				}).parent().children("td.employee-email").text(edit_json['employee-email']);

			}

		});

	}

	function deleteEmployee(event) {

		var employee_email_delete = $(event.target).parent().parent().children("td.employee-email").text();

		$.ajax({

			url: "../controllers/DeleteEmployeeController.php",
			type: "post",
			data: {

				"employee-email": employee_email_delete

			},

			success: function(remove) {

				//$(".container").append(remove);
				$("td.employee-email").filter(function() {
					
					return $(this).text() === employee_email_delete;
				
				}).parent().remove();

			}

		});

	}



