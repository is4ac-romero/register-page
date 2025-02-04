<?php
    try {
        $db = new PDO("mysql:host=localhost;dbname=user_registration;charset=utf8", "root", "");
    } catch(Exception $e) {
        echo $e->getMessage();
    }