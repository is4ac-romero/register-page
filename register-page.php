<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="styles/input-error.css">
</head>
<body>
    <form action="./insert-new-user.php" method="POST">
        <?php
        //messages received through the validation method
            if($_GET["sign"] == "empty") {
                echo "fill the inputs!<br>";
            } else if($_GET["sign"] == "empty-username") {
                echo "fill the username!<br>";
            } else if($_GET["sign"] == "empty-email") {
                echo "fill the email!<br>";
            } else if($_GET["sign"] == "empty-password") {
                echo "fill the password!<br>";
            } else if($_GET["sign"] == "passwords-doesnt-match") {
                echo "passwords dont match!<br>";
            } else if($_GET["sign"] == "email-already-registered") {
                echo "email already in use<br>";
            }
        ?>

        <?php
            if(!isset($_GET["sign"])) { //if does not have any errors
                echo "<input name='username' type='text' placeholder='Username'> <br>";
                //i used a cheat below, ill organize it later ;) i need to organize it hahaha
            } else if($_GET["sign"] == "empty-email" || $_GET["sign"] == "empty-password" || $_GET["sign"] == "passwords-doesnt-match" || $_GET["sign"] == "email-already-registered") { //if it has error of empty email
                $username = $_GET["username"]; //fill out the input automaticaly
                echo "<input name='username' type='text' placeholder='Username' value='$username'> <br>";
            } else { //if it has another error 
                echo "<input name='username' class='error' type='text' placeholder='Username'> <br>";
            }
        ?>

        <?php
            //same as below
            if(!isset($_GET["sign"])) { 
                echo "<input name='email' type='text' placeholder='Email'> <br>";
            } else if($_GET["sign"] == "empty-username" || $_GET["sign"] == "empty-password" || $_GET["sign"] == "passwords-doesnt-match") { 
                $email = $_GET["email"]; 
                echo "<input name='email' type='text' placeholder='Email' value = '$email'> <br>";
            } else { 
                echo "<input name='email' class='error' type='text' placeholder='Email'> <br>";
            }
        ?>

        <?php
            if(!isset($_GET["sign"])) {
                echo "
                <input name='password' type='text' placeholder='Password'> <br>
                <input name='confirm-password' type='text' placeholder='Confirm Password'> <br>
                ";
            } else {
                echo "
                <input name='password' class='error' type='text' placeholder='Password'> <br>
                <input name='confirm-password' class='error' type='text' placeholder='Confirm Password'> <br>
                ";
            }
        ?>
        <button type="submit">Register</button>
        <p>Already have an account? click <a href="./index.php" target="_blank">here</a> to login</p>
    </form>
</body>
</html>