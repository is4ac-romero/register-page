<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./styles/input-error.css">
</head>
<body>
    <?php //display the error returned from php method
        if($_GET["sign"] == "empty") {
            echo "Fill the inputs";
        } else if($_GET["sign"] == "empty-email") {
            echo "Fill the email";
        } else if($_GET["sign"] == "empty-password") {
            echo "Fill the password";
        } 
    ?>

    <form action="session-login.php" method="POST">
        <?php
            //i used the same strategy as the other one site. Display the messages in order to error handling semantic
            if(!isset($_GET["sign"])) { //if there is not no errors
                echo "<input name='email' type='text' placeholder='Email'> <br>";
            } else if($_GET["sign"] == "empty-password") { //if there is a specific error  
                $email = $_GET["email"];

                echo "<input name='email' type='text' value='$email' placeholder='Email'> <br>";
            } else { //and if the error is not associated with specific but it is a error as well 
                echo "<input name='email' class='error' type='text' value='$email' placeholder='Email'> <br>";
            }
        ?>
        
        <?php
            //same as above but i dont wanna to save password in any cases
            if(!isset($_GET["sign"])) {
                echo "<input name='password' type='text' placeholder='Password'> <br>";
            } else {
                echo "<input name='password' class='error' type='text' placeholder='Password'> <br>";
            }
        ?>

        <button name="login-btn" type="submit">Login</button>
    </form>
</body>
</html>