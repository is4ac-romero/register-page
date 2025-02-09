<?php
    //im trying somehting new = testing the method reveiced and checking if the user clicked on the submit button
    if(($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST["login-btn"])) {
        //catching the user's input preventing the sql injection
        $email = htmlspecialchars($_POST["email"]);
        $password = htmlspecialchars($_POST["password"]);

        //checking if one of the inputs were submitted with empty information
        if(empty($email) && empty($password)) {
            header("Location: ./index.php?sign=empty");
        } else if(empty($email)) {
            header("Location: ./index.php?sign=empty-email");
        } else if(empty($password)) { //the only case that i want to save information is when the password is not filled and the email is
            header("Location: ./index.php?sign=empty-password&email=$email");
        } //else {

        //}
    }