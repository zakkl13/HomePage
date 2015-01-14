<?php
	require_once("../includes/functions.php");
	if (isset($_COOKIE["uid"]))
	{
		redirect_to("show.php");
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

<html lang="en">
	<head>
		<!-- Bootstrap -->
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/main.css" rel="stylesheet">
		<link rel="icon"
      type="image/png"
      href="img/favicon.png">

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<title>HomePage: Your Personalized Home Page</title>
	</head>
	<body>
<div class="site-wrapper">
		<div class="site-wrapper-inner">
			<div class="cover-container">
				<div class="inner cover">
            <h1 class="cover-heading"><strong>Welcome to HomePage</strong></h1>
            <p class="lead">Create your very own personalized browser homepage, everytime you open your browser you will see a beautiful page displaying the date, weather and more. Make your personalized HomePage in seconds today!</p>
            <p class="lead">
              <a href="create.php" class="btn btn-lg btn-default">Create</a>
            </p>
          </div>

			<div class="mastfoot">
            <div class="inner">
              <p>Created by <a href="http://twitter.com/ZakkLefkowits">Zakk Lefkowits</a>, this website is <a href="https://github.com/zakkl13/HomePage">open source</a>.</p>
            </div>
          </div>

			</div>
		</div>
	</div>
	</body>
</html>
