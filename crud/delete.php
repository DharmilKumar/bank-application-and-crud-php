<?php
    require_once 'conn.php';

    if(isset($_GET['deleteid'])){
        $id = $_GET['deleteid'];
        $sql = "DELETE FROM golden4 where id=$id";
        if ($conn->query($sql) == true) {
            echo '<script language="javascript">';
            echo 'alert("Successfully Deleted"); location.href="show_data.php"';
            echo '</script>';
        } else {
            echo "error while inserting data " . $conn->error;
        }
    }
?>