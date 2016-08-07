

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

				$("a.delete-employee:last").parent().parent().after("<tr><td class='employee-image'><img src='../assets/images/"+create_json['employee-image']+"' style='width: 75px'>"+
					"</td><td class='employee-name'>"+create_json['employee-name']+
					"</td><td class='employee-email'>"+create_json['employee-email']+
					"</td><td><a href='#view-employee-info' class='view-employee' rel='modal:open' onclick='viewEmployee(event);'>view</a></td><td><a href='#edit-user-form' rel='modal:open' onclick='viewEmployee(event);' class='edit-employee'>edit</a></td><td><a href='#' onclick='deleteEmployee(event)' class='delete-employee'>delete</a></td></tr>");

			}

		});

	}

	// Ajax requerst to send post request to ViewEmployeeController and retrieve specific employee data

	function viewEmployee(event) {

			var employee_email_view = $(event.target).parent().parent().children("td.employee-email").text();
			
			var button_check = $(event.target).text();

			if(button_check == "view")
			{
				$("#view-employee-info").css("opacity","1").css("margin-top","0");
			}

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

					if(button_check == "view")
					{
						codeAddress();
					}

				}

			});

		

	}

	// Ajax request to send post request to EditEmployeeController to edit specific employee data

	function editEmployee(event) {

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
				
				}).parent().children("td.employee-image").children("img").attr("src","../assets/images/"+edit_json['employee-image']);

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

				$("td.employee-email").filter(function() {
					
					return $(this).text() === employee_email_delete;
				
				}).parent().remove();

			}

		});

	}

	//upload image to the images folder

	function uploadImage() {

		var file_data = new FormData();

		file_data.append('file_attach', $("input#employee-picture")[0].files[0]);
		file_data.append('file_attach_edit', $("input#employee-picture-edit")[0].files[0]);

		$.ajax({

			url: "../controllers/FileUploadController.php",
			data: file_data,
			processData: false,
			contentType: false,
			type: "post",
			dataType: 'json',

			success: function(response) {

				$(".container").append("Hi There");
			}

		});

	}

	//initialize Google Maps Api request

	var geocoder;
	var map;
  
    function initialize() {
  	
	    geocoder = new google.maps.Geocoder();
	    var latlng = new google.maps.LatLng(-34.397, 150.644);
	    var myOptions = {
	      zoom: 8,
	      center: latlng,
	      mapTypeId: google.maps.MapTypeId.ROADMAP
	    }
	    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    
    }

    //translates Address to longitude and latitude using Geocode Google Api

    function codeAddress() {

	    var address = $("#address").text();
	    
	    geocoder.geocode( { 'address': address}, function(results, status) {
	      if (status == google.maps.GeocoderStatus.OK) {
	        map.setCenter(results[0].geometry.location);
	        var marker = new google.maps.Marker({
	            map: map,
	            position: results[0].geometry.location
	        });
	      } else {
	        alert("No address for this employee to be displayed, Please insert one");
	      }
	    });
	    
    }



