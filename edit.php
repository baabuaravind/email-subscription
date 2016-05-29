<?php
	ob_start();
    session_start();
    if(!isset($_SESSION['Username']))
?>
<?php
mysql_connect("localhost","root","ronaldo");
mysql_select_db("forum");
$data=mysql_query("SELECT * FROM members where Username='".$_SESSION['Username']."'");
$row = mysql_fetch_assoc($data);
$arrBook = array("C++","HTML","JAVA","PHP","MATLAB");
?>
<html>
<title>Edit/Update Page</title>
<br><br><center>
<head><h2><b>Hello , <?php echo $_SESSION['Username']	; ?></b></h2>
<h4>Please Check/Uncheck E-books that you like<br><br> Click Update to update your details</h4></head>
<style type="text/css">
body {color:white}
</style>
<br>
<body background="http://wearetenfold.com/wp-content/uploads/test-back-6.jpg">
<form method="POST" action="update.php">
<input type="hidden" name="Username" value="<?php echo $row['Username'];?>"/>
<input type="hidden" name="Email" value="<?php echo $row['Email'];?>"/>
<b>E-Books<b><br>
<?php
  $dbbook = explode(", ",$row['books']);
  
  echo "<br>";
  foreach($arrBook as $books)
  {
  if(in_array($books,$dbbook))
  echo "<input type='checkbox' name='books[]' value='".$books."' checked />".$books;
  else
  echo "<input type='checkbox' name='books[]' value='".$books."' />".$books;
  }
?>
<br><br><br>
<input type="Submit" value="Update" name="Submit">
</form>
</body>
</center>
</html>