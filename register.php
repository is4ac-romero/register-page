<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        try {
            //Catch user's input
            $username = htmlspecialchars($_POST["username"]);
            $email = htmlspecialchars($_POST["email"]);
            $password = htmlspecialchars($_POST["password"]);
            $confirmPassword = htmlspecialchars($_POST["confirm-password"]);

            if(empty($username) && empty($email) && empty($password) && empty($confirmPassword)) {
                header("Location: ./index.php?sign=empty");
            } else if(empty($username)) {
                header("Location: ./index.php?sign=empty-username&email=$email");
            } else if(empty($email)) {
                header("Location: ./index.php?sign=empty-email&username=$username");
            } else if(empty($password) || empty($confirmPassword)) { //until here im testing if some input is empty
                header("Location: ./index.php?sign=empty-password&username=$username&email=$email");
            } else if($password != $confirmPassword) { //check the password
                header("Location: ./index.php?sign=passwords-doesnt-match&username=$username&email=$email");
            } else { 
                try {
                    require "includes/db-connection.php"; //start the database connection
                    $hash = password_hash($password, PASSWORD_DEFAULT); //create a hash for security reasons
                    
                    //prepare and insert into table users 
                    $stmt = $db->prepare("INSERT INTO users (username, email, pass) VALUES (:username, :email, :pass)");
                    $stmt -> bindParam(":username", $username); 
                    $stmt -> bindParam(":email", $email);
                    $stmt -> bindParam(":pass", $hash);
                    $stmt->execute();
                } catch(Exception $e) {
                    echo $e->getMessage();
                }
            }
            exit();
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }