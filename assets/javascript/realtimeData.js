

	function createEmployee() {

		var username = $("form#create-user-form .form-group #employee-name").val();
		var email = $("form#create-user-form .form-group #employee-email").val();
		var address = $("form#create-user-form .form-group #employee-address").val();
		var image = $("form#create-user-form .form-group #employee-picture").val();

		$.ajax({

			url: "../controllers/EmployeeController.php",
			type: "post",
			data: {

				"employee-name": username,
				"employee-email": email,
				"employee-address": address,
				"employee-image": image

			},

			success: function(create) {
				$("div.container").append(create);
			}

		});

	}
