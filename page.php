<?php

	ob_start();

    session_start();

    if(!isset($_SESSION['Username'])){

         header("Location: login.php");

    }

?>

<html>

<title>Display Page</title>

<br><br><center>

<head><h2><b>Welcome , <?php echo $_SESSION['Username']	; ?></b></h2>

<h4>Updated Details of your Subscription</h4></head><br>

<style>

h2 {color:white}

body {color:white}

a{

    color:yellow;

font-weight:bold;

}

</style>

<body background="http://wearetenfold.com/wp-content/uploads/test-back-6.jpg">



<form method="post">

<?php

mysql_connect("localhost","root","ronaldo");

mysql_select_db("forum");

$data=mysql_query("SELECT * FROM members where Username ='".$_SESSION['Username']."'");



while($value=mysql_fetch_assoc($data))

{

print "

<table width='400' cellspacing='12' cellpadding='2'>

<tr><td><b>Name<b></td>

<td>".$value['Username']."</td></tr>

<tr><td><b>Email<b></td>

<td>".$value['Email']."</td></tr>

<tr><td><b>E-Books<b></td>

<td>".$value['books']."</td></tr>";

}



print "</table>";

?><br><br>

<?php

print 

"<b>To Edit and change your E-books Subscription<b>

<a href='edit.php?Username=".$_SESSION["Username"]."'>Click Here</a>";



mysql_close();

?>



</form><br><br>

OR

<br><br>

<input type="button" value="Log out" style="font-weight:bold" onclick="window.location.href='http://142.3.27.3/logout.html'">

</center>

</body>

</html>