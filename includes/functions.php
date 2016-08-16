<?php
	function redirect_to($location)
	{
		header("Location: " . $location);
	}

	function confirm_query($result_set){
		if (!$result_set) {
			die("Database query failed.");
		}
	}

	function mysql_prep($string) {
		global $connection;

		$escaped_string = mysqli_real_escape_string($connection, $string);
		return $escaped_string;
	}

	function set_uid_cookie($id) {
		$name = "uid";
		$expire = time() + (60*60*24*365*10); //ten year later
		setcookie($name, $id, $expire); //set
	}

	function set_temp_cookie($temp) {
		$name = "temp";
		$expire = time() + (60*60*24*365*10); //ten year later
		setcookie($name, $temp, $expire); //set
	}

	function display_background()
	{
		global $timeofday;
		$rand = rand(1, 4);
		$picture = "./img/" . $timeofday . "/" . $rand . ".jpg";
		return $picture;
	}

?>
