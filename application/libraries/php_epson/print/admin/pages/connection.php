<?php
$con = mysql_connect("localhost","root","");
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }
mysql_select_db("customer_info", $con);
?>