<?php
    //Database=phpaz1MySQL;
    //Data Source=eu-cdbr-azure-north-a.cloudapp.net;
    //User Id=b5a0d39aaf6422;
    //Password=a9f91b2a
    $host = "eu-cdbr-azure-north-a.cloudapp.net";
    $user = "b5a0d39aaf6422";
    $pwd = "a9f91b2a";
    $db = "phpaz1MySQL";
    try {
        $conn = new PDO( "mysql:host=$host;dbname=$db", $user, $pwd);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }
    catch(Exception $e){
        die(var_dump($e));
    }