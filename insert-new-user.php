<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        try {
            //Catch user's input
            $username = htmlspecialchars($_POST["username"]);
            $email = htmlspecialchars($_POST["email"]);
            $password = htmlspecialchars($_POST["password"]);
            $confirmPassword = htmlspecialchars($_POST["confirm-password"]);

            if(empty($username) && empty($email) && empty($password) && empty($confirmPassword)) {
                header("Location: ./register-page.php?sign=empty");
            } else if(empty($username)) {
                header("Location: ./register-page.php?sign=empty-username&email=$email");
            } else if(empty($email)) {
                header("Location: ./register-page.php?sign=empty-email&username=$username");
            } else if(empty($password) || empty($confirmPassword)) { //until here im testing if some input is empty
                header("Location: ./register-page.php?sign=empty-password&username=$username&email=$email");
            } else if($password != $confirmPassword) { //check the password
                header("Location: ./register-page.php?sign=passwords-doesnt-match&username=$username&email=$email");
            } else { 
                try {
                    require "includes/db-connection.php"; //start the database connection
                    
                    //prepare the query for verify if the email is already registered
                    $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
                    $stmt->bindParam(":email", $email);
                    $stmt->execute();
                    $result = $stmt->rowCount(); //get the quantity of rows returned 

                    if($result) { //if it returns one or more rows, the user cannot register with the email
                        header("Location: ./register-page.php?sign=email-already-registered&username=$username"); //redirect saving only the number
                    } else {
                        $hash = password_hash($password, PASSWORD_DEFAULT); //create a hash for security reasons

                        //prepare and insert into table users 
                        $stmt = $db->prepare("INSERT INTO users (username, email, pass) VALUES (:username, :email, :pass)");
                        $stmt -> bindParam(":username", $username); 
                        $stmt -> bindParam(":email", $email);
                        $stmt -> bindParam(":pass", $hash);
                        $stmt->execute();
                    }

                } catch(Exception $e) {
                    echo $e->getMessage();
                }
            }
            exit();
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }