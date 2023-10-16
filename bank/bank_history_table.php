<?php
    require_once 'conn.php';

    $sql = "CREATE TABLE bank_history(
        id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
        name VARCHAR (50) NOT NULL,
        email VARCHAR (100),
        acc VARCHAR (20),
        amount VARCHAR (30),
        update_time VARCHAR (50)
    )";

    if($conn->query($sql)==true){
        echo "<h3>Table created successfully</h3>";
    }else{
        echo "Error while creating table ".$conn->error;
    }
?>