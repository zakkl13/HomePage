# HomePage
Create Your Own Personalized Webpage
url: http://zakk.io/projects/homepage/
Allows the user to create a beautiful personalized webpage with their name and location

Credits:
Bootstrap CSS/Google Images/Yahoo Weather

How to get this up and running:

First setup a database by running the following in mysql command line:
```
CREATE DATABASE <any name here>;

CREATE TABLE pages (
uid INT(11) NOT NULL AUTO_INCREMENT,
name VARCHAR(30) NOT NULL,
timezone VARCHAR(10),
zip INT(6) NOT NULL,
PRIMARY KEY (uid)
);
```

and then add a dbconnect.php in the includes folder with the following:
```php
<?php
	define("DB_SERVER", "localhost");
	define("DB_USER", "your user name");
	define("DB_PASS", "your password");
	define("DB_NAME", "your database name");

  $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
  if(mysqli_connect_errno()) {
    die("Database connection failed: " . 
         mysqli_connect_error() . 
         " (" . mysqli_connect_errno() . ")"
    );
  }
?>
```
