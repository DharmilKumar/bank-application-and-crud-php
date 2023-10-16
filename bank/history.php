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
    <?php require_once 'user_nav.php';

    require_once 'conn.php';
    $id = $_SESSION['id_session'];
    $sql  = "SELECT * FROM bank_history WHERE user_id=$id";
    $result = mysqli_query($conn, $sql);
    ?>

    <table class="table mx-auto mt-5" style="width: 35rem;">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Account Number</th>
                <th scope="col">Amount</th>
                <th scope="col">Total Amount</th>
                <th scope="col">Type of Transection</th>
                <th scope="col">Receiver Account No</th>
                <th scope="col">Update Time</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php

                while ($row = mysqli_fetch_assoc($result)) {
                    $name = $row['name'];
                    $email = $row['email'];
                    $acc = $row['acc'];
                    $amount = $row['amount'];
                    $updated_amount = $row['updated_amount'];
                    $type = $row['type'];
                    $r_acc = $row['r_acc'];
                    $time = $row['update_time'];
                    echo '
                        <td>' . $name . '</td>
                        <td>' . $email . '</td>
                        <td>' . $acc . '</td>
                        <td>' . $amount . '</td>
                        <td>' . $updated_amount . '</td>
                        <td>' . $type . '</td>
                        <td>' . $r_acc . '</td>
                        <td>' . $time . '</td>
                       
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