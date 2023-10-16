<?php
require_once 'conn.php';
$sql  = "SELECT * FROM golden4";
$result = mysqli_query($conn, $sql);
?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <?php require_once 'nav.php'; ?>
    <table class="table mx-auto mt-5" style="width: 35rem;">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Image</th>
                <th scope="col">Email</th>
                <th scope="col">Contact</th>
                <th scope="col">Age</th>
                <th scope="col">Gender</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php

                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id'];
                    $name = $row['name'];
                    $image = $row['image'];
                    $email = $row['email'];
                    $contact = $row['contact'];
                    $age = $row['age'];
                    $gender = $row['gender'];
                    echo '
                        <td>' . $id . '</td>
                        <td>' . $name . '</td>
                        <td>' . "<img src = '$image' height='100px' width='100px'>" . '</td>
                        <td>' . $email . '</td>
                        <td>' . $contact . '</td>
                        <td>' . $age . '</td>
                        <td>' . $gender . '</td>
                        <td>
                            <button type="button" class="btn btn-primary"><a href="update.php?updateid=' . $id . '" class="text-light">Update</a></button>
                            <button type="button" class="btn btn-danger"><a href="delete.php?deleteid=' . $id . '" class="text-light">Delete</a></button>
                        </td>
                    ';
                ?>
            </tr>
        <?php

                }

        ?>
        </tbody>
    </table>
</body>

</html>