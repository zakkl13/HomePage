<?php
	require_once("../../../includes/dbconnect.php");
	require_once("../../../includes/functions.php");
	require_once("../../../includes/validation_functions.php");

	if (isset($_POST["submit"]))
	{
		$name = mysql_prep($_POST["name"]);
		$zipcode = $_POST["zip"];
		$timezone = $_POST["timezone"];

		validate_zip($zipcode);

		$required_fields = array("name", "zip", "timezone");
		validate_presences($required_fields);

		$fields_with_max_lengths = array("name" => 30, "zip" => 6);
		validate_max_lengths($fields_with_max_lengths);

		if (empty($errors))
		{
			$query  = "INSERT INTO pages (";
			$query .= "  name, timezone, zip";
			$query .= ") VALUES (";
			$query .= "  '{$name}', '{$timezone}', {$zipcode}";
			$query .= ")";
			$result = mysqli_query($connection, $query);

			if ($result && mysqli_affected_rows($connection) > 0) {
				$rows = mysqli_query($connection, "SELECT * FROM pages");
				$id = mysqli_num_rows($rows);
				set_uid_cookie($id);
				set_temp_cookie($_POST["temp"]);

				redirect_to("show.php");
			}
			else 	{
				$errors["fail"] = "Page Creation Failed";
			}
		}
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">

<html lang="en">
	<head>
		<!-- Bootstrap -->
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/main.css" rel="stylesheet">

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<title>Create Your Page</title>
	</head>
	<body>
<div class="site-wrapper">
		<div class="site-wrapper-inner">
			<div class="cover-container">
				<h1 style="font-size:72px; font-weight:bold;">Create Your Page</h1>
				<?php echo form_errors($errors); ?>
				<form action="create.php" method="POST">
					<div class="form-group">
						<input type="text" class="form-control" name="name" value="" placeholder="Enter your name" />
					</div>
					<div class="form-group">
						<input type="number" class="form-control" name="zip" value="" placeholder="Enter your zipcode" />
					</div>
					<div class="form-group">
						<label>Please Select Your Timezone:</label>
						<?php include('../../../includes/timezone_select.php'); ?>
					</div>
					<div class="form-inline">
						<label>Temperature: &nbsp;</label>
						<div class="radio"><input type="radio" name="temp" value="farenheit" checked>Farenheit&nbsp; &nbsp;</div>
						<div class="radio"><input type="radio" name="temp" value="celcius">Celsius<br></div>
					</div><br /><br />
					<input type="submit" name="submit" class="btn btn-default" value="Create" />
				</form>
			</div>
		</div>
	</div>
	</body>
</html>
