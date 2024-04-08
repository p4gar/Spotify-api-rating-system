<?php

include("connection.php");
$sql = "INSERT INTO accounts (acc_username, acc_password, acc_email, acc_dob)

VALUES ('$_POST[usern]', '$_POST[password_confirm]' , '$_POST[user_email]', '$_POST[dob]')";


if(!mysqli_query($con, $sql)){ 
    echo 'Could not upload'; 
} 
else {  echo '<script>alert("Account Registered");
    window.location.href="login.php";
    </script>';}

mysqli_close($con);

?>