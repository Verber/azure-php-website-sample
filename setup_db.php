<?php
require_once './dbConnect.php';

    $create_sql = "CREATE TABLE registration_tbl(
        id INT NOT NULL AUTO_INCREMENT,
        PRIMARY KEY(id),
        name VARCHAR(30),
        email VARCHAR(30),
        date DATE)";
    $conn->exec($create_sql);
    echo 'OK';