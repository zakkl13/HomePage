<?php 
	session_start(); 
	
	function first_set()
	{
		global $connection;
		$query = "SELECT * FROM pages ";
		$query .= "WHERE uid = {$_COOKIE["uid"]}";
		
		$result = mysqli_query($connection, $query);
		// Tests if there was a query error
		if (!$result) {
			die("Database query failed."); }
		else {
			$user = mysqli_fetch_assoc($result);
			$_SESSION["name"] = $user["name"];
			$_SESSION["zipcode"] = $user["zip"];
			$_SESSION["timezone"] = $user["timzone"];
			
	}
	}
?>
