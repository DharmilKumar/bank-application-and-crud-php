<?php
    require_once 'conn.php';

    $sql = "CREATE TABLE bank(
        id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
        name VARCHAR (50) NOT NULL,
        image VARCHAR (500),
        email VARCHAR (100),
        password VARCHAR (60),
        contact VARCHAR(100),
        acc VARCHAR (20),
        amount VARCHAR (30)
    )";

    if($conn->query($sql)==true){
        echo "<h3>Table created successfully</h3>";
    }else{
        echo "Error while creating table ".$conn->error;
    }
?>