<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Activate Your Account</title>





    

    

    

<style type="text/css">

body {

     color:white;

}







 .success {

 

 margin: 0 auto;

 padding:10px 5px 10px 60px;

 background-repeat: no-repeat;

 background-position: 10px center;

    

	width:450px;

    	 

	 background-image:url('images/correct.png');

     

}







 .errormsgbox {

 

 margin: 0 auto;

 padding:10px 5px 10px 60px;

 background-repeat: no-repeat;

 background-position: 10px center;

 

	width:450px;

    	

	background-image: url('images/wrong.png');

     

}

a{

    color:yellow;

font-weight:bold;

}

</style>



</head>

<body background="http://wearetenfold.com/wp-content/uploads/test-back-6.jpg">



<br><br><br><br>

<?php

include ('database_connection.php');



if (isset($_GET['email']) && preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', $_GET['email']))

{

    $email = $_GET['email'];

}

if (isset($_GET['key']) && (strlen($_GET['key']) == 32))//The Activation key will always be 32 since it is MD5 Hash

{

    $key = $_GET['key'];

}





if (isset($email) && isset($key))

{



    // Update the database to set the "activation" field to null



    $query_activate_account = "UPDATE members SET Activation=NULL WHERE(Email ='$email' AND Activation='$key')LIMIT 1";



   

    $result_activate_account = mysqli_query($dbc, $query_activate_account) ;



    // Print a customized message:

    if (mysqli_affected_rows($dbc) == 1)//if update query was successfull

    {

    echo '<div class="success"><b>Your account is now active. You may now <a href="login.php"><b>Click Here<b></a> to Login</div>';



    } else

    {

        echo '<div class="errormsgbox"><b>Oops !Your account could not be activated. Please recheck the link or contact the system administrator<b></div>';



    }



    mysqli_close($dbc);



} else {

        echo '<div class="errormsgbox"><b>Error Occured<b></div>';

}





?>

</body>

</html>