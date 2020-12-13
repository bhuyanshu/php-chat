<?php
    include("include/connection.php");

    if(isset($_POST['sign_up'])){

        $name = htmlentities(mysql_real_escape_string($con, $_POST['user_name']));
        $pass = htmlentities(mysql_real_escape_string($con, $_POST['user_pass']));
        $email = htmlentities(mysql_real_escape_string($con, $_POST['user_email']));
    }
?>