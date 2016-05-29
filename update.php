<form method=POST>
<?php
$host="localhost"; // Host name
$username="root"; // Mysql username
$password="ronaldo"; // Mysql password
$db_name="forum"; // Database name
$tbl_name="members"; // Table name

// Connect to server and select database.
mysql_connect("$host", "$username", "$password")or die("cannot connect");
mysql_select_db("$db_name")or die("cannot select DB");


$books = implode(", ",$_POST['books']);

// update data in mysql database
$sql="UPDATE $tbl_name SET  books='$books' WHERE Username='$_POST[Username]'";
$result=mysql_query($sql);

header("location:page.php");

?> 
</form>