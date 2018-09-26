<?php

$connect = new mysqli('localhost','root','','php-project');

if($connect === false) {
	die("could not connect to database".mysqli_connect_error());
}

?>