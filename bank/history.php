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
    $sql  = "SELECT * FROM bank_history WHERE user_id=$id AND type='Received Amount'";
    $sql1  = "SELECT * FROM bank_history WHERE user_id=$id AND type='Send Amount'";
    $sql2  = "SELECT * FROM bank_history WHERE user_id=$id AND type='Deposit'";
    $sql3  = "SELECT * FROM bank_history WHERE user_id=$id AND type='Withdraw'";
    $result = mysqli_query($conn, $sql);
    $result1 = mysqli_query($conn, $sql1);
    $result2 = mysqli_query($conn, $sql2);
    $result3 = mysqli_query($conn, $sql3);
    ?>
    <h2 class="text-center">Received Amount</h2>
    <table class="table mx-auto mt-5" style="width: 35rem;">
        <thead>
            <tr>
                <th scope="col">From</th>
                <th scope="col">His Number</th>
                <th scope="col">Amount</th>
                <th scope="col">Total Amount</th>
                <th scope="col">Type of Transection</th>
                <th scope="col">Update Time</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php

                while ($row = mysqli_fetch_assoc($result)) {
                    $name = $row['name'];
                    $acc = $row['acc'];
                    $amount = $row['amount'];
                    $updated_amount = $row['updated_amount'];
                    $type = $row['type'];
                    $time = $row['update_time'];
                    echo '
                        <td>' . $name . '</td>
                        <td>' . $acc . '</td>
                        <td>' . $amount . '</td>
                        <td>' . $updated_amount . '</td>
                        <td>' . $type . '</td>
                        <td>' . $time . '</td>
                       
                    ';
                ?>
            </tr>
        <?php

                }

        ?>
        </tbody>
    </table>





    <h2 class="text-center">Sent Amount</h2>
    <table class="table mx-auto mt-5" style="width: 35rem;">
        <thead>
            <tr>
                <th scope="col">To</th>
                <th scope="col">His Email</th>
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

                while ($row1 = mysqli_fetch_assoc($result1)) {
                    $name1 = $row1['name'];
                    $email1 = $row1['email'];
                    $acc1 = $row1['acc'];
                    $amount1 = $row1['amount'];
                    $updated_amount1 = $row1['updated_amount'];
                    $type1 = $row1['type'];
                    $r_acc1 = $row1['r_acc'];
                    $time1 = $row1['update_time'];
                    echo '
                        <td>' . $name1 . '</td>
                        <td>' . $email1 . '</td>
                        <td>' . $acc1 . '</td>
                        <td>' . $amount1 . '</td>
                        <td>' . $updated_amount1 . '</td>
                        <td>' . $type1 . '</td>
                        <td>' . $r_acc1 . '</td>
                        <td>' . $time1 . '</td>
                       
                    ';
                ?>
            </tr>
        <?php

                }

        ?>
        </tbody>
    </table>






    <h2 class="text-center">Deposit</h2>
    <table class="table mx-auto mt-5" style="width: 35rem;">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Account Number</th>
                <th scope="col">Amount</th>
                <th scope="col">Total Amount</th>
                <th scope="col">Type of Transection</th>
                <th scope="col">Update Time</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php

                while ($row2 = mysqli_fetch_assoc($result2)) {
                    $name2 = $row2['name'];
                    $email2 = $row2['email'];
                    $acc2 = $row2['acc'];
                    $amount2 = $row2['amount'];
                    $updated_amount2 = $row2['updated_amount'];
                    $type2 = $row2['type'];
                    $time2 = $row2['update_time'];
                    echo '
                        <td>' . $name2 . '</td>
                        <td>' . $email2 . '</td>
                        <td>' . $acc2 . '</td>
                        <td>' . $amount2 . '</td>
                        <td>' . $updated_amount2 . '</td>
                        <td>' . $type2 . '</td>
                        <td>' . $time2 . '</td>
                       
                    ';
                ?>
            </tr>
        <?php

                }

        ?>
        </tbody>
    </table>





    <h2 class="text-center">Withdraw</h2>
    <table class="table mx-auto mt-5" style="width: 35rem;">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Account Number</th>
                <th scope="col">Amount</th>
                <th scope="col">Total Amount</th>
                <th scope="col">Type of Transection</th>
                <th scope="col">Update Time</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php

                while ($row3 = mysqli_fetch_assoc($result3)) {
                    $name3 = $row3['name'];
                    $email3 = $row3['email'];
                    $acc3 = $row3['acc'];
                    $amount3 = $row3['amount'];
                    $updated_amount3 = $row3['updated_amount'];
                    $type3 = $row3['type'];
                    $time3 = $row3['update_time'];
                    echo '
                        <td>' . $name3 . '</td>
                        <td>' . $email3 . '</td>
                        <td>' . $acc3 . '</td>
                        <td>' . $amount3 . '</td>
                        <td>' . $updated_amount3 . '</td>
                        <td>' . $type3 . '</td>
                        <td>' . $time3 . '</td>
                       
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