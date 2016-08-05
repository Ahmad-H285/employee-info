<html>

	<head>

		<title>Home</title>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link rel="stylesheet" href="../assets/node_modules/jquery-modal/jquery.modal.css" type="text/css" media="screen" />
		
	</head>

	<body>

		<div class="container">

			<h1>Employees info</h1>

			<table class="table table-striped">
				
				<thead>
					
					<tr>
						
						<th>#</th>
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
								<td><?php echo $employee_info["id"]; ?></td>
								<td><?php echo $employee_info["user_name"]; ?></td>
								<td><?php echo $employee_info["email"]; ?></td>
								<td><a href="#">view</a></td>
								<td><a href="#">edit</a></td>
								<td><a href="#">delete</a></td>
							</tr>	
							
						<?php }?>
					
				</tbody>

			</table>
			

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
				    <input type="file" id="employee-picture">
				    
  				</div>

  				<a href="#" class="btn btn-info" rel="modal:close" onclick="createEmployee()">Add</a>

			</form>

			<a href="#create-user-form" rel="modal:open" class="btn btn-danger">Add Employee</a>
		
		</div>

	</body>
	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="../assets/node_modules/jquery/dist/jquery.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="../assets/node_modules/jquery-modal/jquery.modal.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="../assets/javascript/realtimeData.js" type="text/javascript" charset="utf-8"></script>

</html>