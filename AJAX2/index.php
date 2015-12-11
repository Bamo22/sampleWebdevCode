<!DOCTYPE html>
<html>
	<head>
		<title>Refresh in &infin;</title>
		<link rel="icon" href="sun70.png" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="./css/basicStyle.css">
	</head>
	<body>
		<div class="container">
			<div class="jumbotron">
				<h1>Testing AJAX post Script :)</h1>
			</div>
			<div class="container">
				<div class="col-md-6 inputDataDiv">
					<h1>New data</h1>
						<div class="input-group">
						      <label>Name:</label>
						      <input id="name" name="name" type="text" maxlength="22" class="form-control"><br>
						      <label>Number:</label>
						      <input id="number" name="number" type="number" maxlength="10" class="form-control">
						</div>
						<div class="btttn"><br>
							<button class="btn btn-primary" id="sendButton"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add</button>
							<button class="btn btn-warning dropdown-toggle" id="del"><span class="glyphicon glyphicon-trash"></span>&nbsp;Delete All</button>
						</div>						
				</div>
				<div class="col-md-6 UpdatingDataDiv">
					<h1>Saved Data</h1>
					<div id="database_data">
						<table class="table table-bordered">
						    <thead>
						      <tr>
						        <th>Name</th>
						        <th>Telephone Number</th>
						      </tr>
						    </thead>
						    <tbody id="database_data_trs">
					      
					    </tbody>
					  </table>
					</div>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="jquery/dist/jquery.js"></script>
		<script type="text/javascript" src="toastr/toastr.js"></script>
		<script type="text/javascript" src="css/bootstrap/dist/js/bootstrap.js"></script>
		<script type="text/javascript" src="dataRefresh.js"></script>
	</body>
</html>