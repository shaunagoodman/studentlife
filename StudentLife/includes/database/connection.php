<?php
require_once 'config.php';
$dsn= "mysql:host=$servername;dbname=$db_name";
        try{
            // create a PDO connection with the configuration data
            $conn = new PDO($dsn, $username, $password);
            
            // display a message if connected to database successfully
           }catch (PDOException $e){
            // report error message
            echo $e->getMessage();
           }