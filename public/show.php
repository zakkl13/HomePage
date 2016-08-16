<?php
	require_once("../../../includes/dbconnect.php");
	require_once("../../../includes/sessions.php");
	require_once("../../../includes/functions.php");

	if (!isset($_COOKIE["uid"]))
	{
		redirect_to("create.php");
	} else if (!isset($_SESSION["name"])) {
		first_set();
	}

	require_once("../../../includes/timeofday.php");
	require_once("../../../includes/weather.php");
	require_once("../../../includes/validation_functions.php");
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">

<html lang="en">
	<head>
		<!-- Bootstrap -->
		<style>
			html,
			body {
				height: 100%;
				background-image: url("<?php echo display_background(); ?>");
				background-size: cover;
			}
		</style>
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/cover.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
		<title>Home Page</title>
	</head>
	<body>
		<div class="site-wrapper">
			<div class="site-wrapper-inner">
				<div class="cover-container">
					<div class="masthead clearfix">
            <div class="inner">
              <nav>
                <ul class="nav masthead-nav">
                  <li class="active"><a href="show.php">Home</a></li>
                  <li><a href="edit.php">Edit</a></li>
                </ul>
              </nav>
            </div>
          </div>
					<div class="inner cover">
						<h1 style="font-size:72px; font-weight:bold;"><?php echo $welcome . $_SESSION["name"] ?></h1>
						<p class="lead">
							<?php
								$day = date('l\, F jS Y ');
								$time = date('h:i');
								echo "Today is " . $day
							?>
						</p>
					<span style="font-size: 54px;"><?php echo $curr_temp ?></span>
					<br />
					<div class="row">
						<div class="col-md-6">
							<p style="float: right;">Low: <?php echo $curr_low ?></p>
						</div>
						<div class="col-md-6">
							<p style="float: left;">High: <?php echo $curr_high ?></p>
						</div>
					</div>
					<p id="bold"><?php echo $curr_status ?></p>
					<p id="bold"><?php echo $city . ", " . $state ?>
				<br />
				<br />
				<div class="row">
					<?php
						echo forecast();
					?>
				</div>
				</div>
			</div>
		</div>
	</div>
	</body>
</html>
<?php
	//5. Close Connection
	mysqli_close($connection);
?>
