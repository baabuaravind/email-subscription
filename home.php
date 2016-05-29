<?php







include ('database_connection.php');

if (isset($_POST['formsubmitted'])) {

    $error = array();//Declare An Array to store any error message  

    if (empty($_POST['name'])) {//if no name has been supplied 

        $error[] = 'Please Enter a name ';//add to array "error"

    } else {

        $name = $_POST['name'];//else assign it a variable

    }



    if (empty($_POST['e-mail'])) {

        $error[] = 'Please Enter your Email ';

    } else {





        if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_POST['e-mail'])) {

           //regular expression for email validation

            $Email = $_POST['e-mail'];

        } else {

             $error[] = 'Your EMail Address is invalid  ';

        }





    }





    if (empty($_POST['Password'])) {

        $error[] = 'Please Enter Your Password ';

    } else {

        $Password = $_POST['Password'];

    }


$books=$_POST['books'];

foreach($books as $entry)
{
$bets .= $entry.", ";
}



    if (empty($error)) //send to Database if there's no error '



    { // If everything's OK...



        // Make sure the email address is available:

        $query_verify_email = "SELECT * FROM members  WHERE Email ='$Email'";

        $result_verify_email = mysqli_query($dbc, $query_verify_email);

        if (!$result_verify_email) {//if the Query Failed ,similar to if($result_verify_email==false)

            echo ' Database Error Occured ';

        }



        if (mysqli_num_rows($result_verify_email) == 0) { // IF no previous user is using this email .





            // Create a unique  activation code:

            $activation = md5(uniqid(rand(), true));





            $query_insert_user = "INSERT INTO `members` ( `Username`, `Email`, `Password`, `books`,`Activation`) VALUES ( '$name', '$Email', '$Password', '$bets','$activation')";





            $result_insert_user = mysqli_query($dbc, $query_insert_user);

            if (!$result_insert_user) {

                echo 'Query Failed ';

            }



            if (mysqli_affected_rows($dbc) == 1) { //If the Insert Query was successfull.





                // Send the email:

                $message = " To activate your account, please click on this link:\n\n";

                $message .= WEBSITE_URL . '/activate.php?email=' . urlencode($Email) . "&key=$activation";

                mail($Email, 'Registration Confirmation', $message, 'From: aravindmerrick@gmail.com');



                // Flush the buffered output.





                // Finish the page:

                echo '<div class="success">Thank you for

registering! A confirmation email

has been sent to '.$Email.' Please click on the Activation Link to Activate your account </div>';





            } else { // If it did not run OK.

                echo '<div class="errormsgbox">You could not be registered due to a system

error. We apologize for any

inconvenience.</div>';

            }



        } else { // The email address is not available.

            echo '<div class="errormsgbox" >That email

address has already been registered.

</div>';

        }



    } else {//If the "error" array contains error msg , display them

        

        



echo '<div class="errormsgbox"> <ol>';

        foreach ($error as $key => $values) {

            

            echo '	<li>'.$values.'</li>';





       

        }

        echo '</ol></div>';



    }

  

    mysqli_close($dbc);//Close the DB Connection



} // End of the main Submit conditional.







?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head><br><center><h2>Free E-book Student Subscription</h2>

<h4>Every student can subscribe more than 3 e-books</h4></center>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Student Subscription</title>





    

    

    

<style type="text/css">

h2 {color:white}

h4 {color:white}

body {color:white}

.registration_form {

		   margin:0 auto;

		   width:500px;

		   padding:14px;

}

label {

      width: 9em;

      float: left;

      margin-right: 0.5em;

      display: block

}

.submit {

	text-align:center;

}



.elements {

	  padding:10px;
	  font-weight:bold;

}

p {

  

  color:white



}

a{

    color:yellow;

font-weight:bold;

}



/* Box Style */





 .success, .warning, .errormsgbox, .validation {

 

 margin: 0 auto;

 padding:10px 5px 10px 70px;

 background-repeat: no-repeat;

 background-position: 15px center;

     font-weight:bold;

     width:830px;

     

}



.success {

   

   background-image:url('images/correct.png');

}

.warning {



	 

	 background-image: url('images/danger.png');

}

.errormsgbox {

 

 

 background-image: url('images/wrong.png');

 

}

.validation {

 

 color: #D63301;

 background-color: #FFCCBA;

 background-image: url('images/error.png');

}







</style>



</head><center>

<body background="http://wearetenfold.com/wp-content/uploads/test-back-6.jpg">





<form action="home.php" method="post" class="registration_form">

  

    

    

    <div class="elements">

      <label for="name">Name </label>

      <input type="text" id="name" name="name" size="20" />

    </div>

    <div class="elements">

      <label for="e-mail">Email </label>

      <input type="text" id="e-mail" name="e-mail" size="20" />

    </div>

    <div class="elements">

      <label for="Password">Password</label>

      <input type="password" id="Password" name="Password" size="20" />

    </div>
<table width="400" border="0" cellspacing="12" cellpadding="2">


<tr>
<td width="130"><b>C++</b></td>
<td><input type="checkbox" name="books[]" value="C++" /></td>
</tr>

<tr>
<td width="130"><b>HTML</b></td>
<td><input type="checkbox" name="books[]" value="HTML" /></td>
</tr>

<tr>
<td width="130"><b>Java</b></td>
<td><input type="checkbox" name="books[]" value="JAVA" /></td>
</tr>

<tr>
<td width="130"><b>PHP</b></td>
<td><input type="checkbox" name="books[]" value="PHP" /></td>
</tr>

<tr>
<td width="130"><b>MATLAB</b></td>
<td><input type="checkbox" name="books[]" value="MATLAB" /></td>
</tr>

</table>



    <div class="submit">

     <input type="hidden" name="formsubmitted" value="TRUE" />

      <input type="submit" value="Subscribe" style="font-weight:bold"/>

    </div>

  <p><center><h4>Already a member? <a href="login.php">Click Here to Login</a></span></h4></center> </p>

</form>



</body></center>

</html>