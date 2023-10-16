<?php

$conn = mysqli_connect("localhost","root","","db");
if(mysqli_connect_error($conn)){
    echo "Connection error" .mysqli_connect_error();
}