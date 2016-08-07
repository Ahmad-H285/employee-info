<html>

	<head>

		<title>Home</title>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link rel="stylesheet" href="../assets/node_modules/jquery-modal/jquery.modal.css" type="text/css" media="screen" />
		<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCkSuDt0Nzm12nCmku5uskJbOc-JV_JMJU&callback=initMap">
    </script>
    <script src="../assets/javascript/realtimeData.js" type="text/javascript" charset="utf-8"></script>

	</head>

	<body onload="initialize()">
		
		<div class="container">

			<h1>Employees info</h1>

			<table class="table table-striped">
				
				<thead>
					
					<tr>
						
						<th>Picture</th>
						<th>Name</th>
						<th>Email</th>

					</tr>

				</thead>
				
				<tbody>

					<?php 
						require_once "../models/Employee.php";

						$employee_records = new Employee();
						$display_employees = $employee_records -> listEmployees();
						
						foreach ($display_employees as $employees => $employee_info) { ?>
							<tr>
								<td class="employee-image"><img src="../assets/images/<?php echo $employee_info['image_location'];?>" style="width: 75px"></td>
								<td class="employee-name"><?php echo $employee_info["user_name"]; ?></td>
								<td class="employee-email"><?php echo $employee_info["email"]; ?></td>
								<td><a href="#view-employee-info" rel="modal:open" class="view-employee" onclick="viewEmployee(event);">view</a></td>
								<td><a href="#edit-user-form" rel="modal:open" onclick="viewEmployee(event);" class="edit-employee">edit</a></td>
								<td><a href="#" onclick="deleteEmployee(event)" class="delete-employee">delete</a></td>
							</tr>	
							
						<?php }?>
					
				</tbody>

			</table>

			<img id="image_upload" src="">


			

			<form method="POST" id="create-user-form" class="modal" style="display: none">
			  	
				<div class="row"><h3>Add Employee</h3></div>

			  	<div class="form-group">

    				<label for="employee-name">Name</label>
    				<input type="text" class="form-control" id="employee-name" placeholder="Name">

  				</div>

  				<div class="form-group">

    				<label for="employee-email">Email</label>
    				<input type="email" class="form-control" id="employee-email" placeholder="Email">

  				</div>

  				<div class="form-group">

    				<label for="employee-address">Address</label>
    				<input type="text" class="form-control" id="employee-address" placeholder="Address">

  				</div>

  				<div class="form-group">

    				<label for="employee-picture">Image upload</label>
				    <input type="file" name="file_attach" id="employee-picture">
				    
  				</div>

  				<a href="#" class="btn btn-info" rel="modal:close" onclick="createEmployee();uploadImage()">Add</a>

			</form>

			<a href="#create-user-form" rel="modal:open" id="image_create" class="btn btn-danger">Add Employee</a>
		
		</div>

		<table id="view-employee-info" class="modal table table-striped" style="opacity: 0; margin-top:-860px;">
			
			<tr>
				<th><h3>Employee's Info</h3></th>
			</tr>

			<tr>
				<th>Name</th>
				<td class="view-name"></td>
			</tr>

			<tr>
				<th>Email</th>
				<td class="view-email"></td>
			</tr>

			<tr>
				<th>Address</th>
				<td class="view-address" id="address"></td>
			</tr>

			<tr>
				<th>Image</th>
				<td class="view-image"></td>
			</tr>
			<tr>
				<th>Map</th>
				<td id="map_canvas" style="width: 320px; height: 480px;"></td>
			 
			</tr>
			
			<tr>
				<td><a href="#" class="btn btn-danger" rel="modal:close">Close</a></td>
			</tr>

		</table>

		<form method="POST" id="edit-user-form" class="modal" style="display: none">
			  	
				<div class="row"><h3>Edit Employee</h3></div>

			  	<div class="form-group">

    				<label for="employee-name-edit">Name</label>
    				<input type="text" class="form-control" id="employee-name-edit" placeholder="Name">

  				</div>

  				<div class="form-group">

    				<label for="employee-email-edit">Email</label>
    				<input type="email" class="form-control" id="employee-email-edit" placeholder="Email">

  				</div>

  				<div class="form-group">

    				<label for="employee-address-edit">Address</label>
    				<input type="text" class="form-control" id="employee-address-edit" placeholder="Address">

  				</div>

  				<div class="form-group">

    				<label for="employee-picture-edit">Image upload</label>
				    <input type="file" name="file_attach_edit" id="employee-picture-edit">
				    
  				</div>

  				<a href="#" class="btn btn-info" id="edit_image" rel="modal:close" onclick="editEmployee(event);uploadImage()">Save</a>

			</form>
			
			<input type="hidden" id="employee_old_email" value="">
			
			

				
			
		

	</body>
	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="../assets/node_modules/jquery/dist/jquery.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="../assets/node_modules/jquery-modal/jquery.modal.min.js" type="text/javascript" charset="utf-8"></script>
	
	

</html>