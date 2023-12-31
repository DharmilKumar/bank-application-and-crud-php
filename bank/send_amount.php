<!DOCTYPE html>
<html>

<head>
    <style>
        .w {
            color: red;
        }
    </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body>

    <body>
        <?php require_once 'user_nav.php'; ?>
        <?php
        require_once 'conn.php';
        $accErr = $amountErr = "";

        // $id = $_COOKIE['id_cookie'];
        // session_start();
        $id = $_SESSION['id_session'];
        if ($id > 0) {
            if (isset($_POST['submit'])) {

                if (!empty($_POST['acc'])) {
                    $acc = $_POST['acc'];
                } else {
                    $accErr = "Please Enter Account Number";
                }
                if (!empty($_POST['amm'])) {

                    $amount = $_POST['amm'];
                } else {
                    $amountErr = "Please Enter Amount";
                }

                if (!empty($acc) && !empty($amount)) {

                    $sql1 = "SELECT * FROM bank WHERE id=$id";
                    $result = mysqli_query($conn, $sql1);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $a = $row['amount'];
                            $ab = $a - $amount;
                            $name = $row['name'];
                            $email = $row['email'];
                            $accountNo = $row['acc'];

                            date_default_timezone_set("Asia/Kolkata");
                            $time = date("d-F-Y   h:i:s");
                            

                            //for acc no of another user
                            $sql2 = "SELECT * FROM bank WHERE acc=$acc";
                            $result2 = mysqli_query($conn, $sql2);
                            if ($result2->num_rows > 0) {
                                if ($ab < 0) {
                                    echo "<script type='text/javascript'>alert('Your Bank has not enough Money!');window.location='send_amount.php'</script>";
                                } else {
                                    while ($row2 = $result2->fetch_assoc()) {
                                        $amount2 = $row2['amount'];
                                        $id2 = $row2['id'];
                                        $name2 = $row2['name'];
                                        $email2 = $row2['email'];
                                        $acc2 = $row2['acc'];
                                        $add = $amount + $amount2;
                                        // echo $name2." ".$email2. " ".$acc2. " ";die;
                                        $sql4 = "INSERT INTO bank_history (user_id,name,email,acc,amount,updated_amount,type,r_acc,update_time) VALUES ($id,'$name2','$email2','$accountNo','$amount','$ab','Send Amount','$acc','$time');";

                                        $sql5 =  "INSERT INTO bank_history(user_id,name,email,acc,amount,updated_amount,type,s_acc,update_time) VALUES ($id2,'$name','$email','$acc','$amount','$add','Received Amount','$accountNo','$time');";
                                        $sql = "UPDATE bank SET amount=$ab WHERE id=$id";
                                        $sql3 = "UPDATE bank SET amount=$add WHERE acc=$acc";
                                        if ($conn->query($sql) && $conn->query($sql3) && $conn->query($sql4) && $conn->query($sql5)) {
                                            echo "<script type='text/javascript'>alert('Amount Sent');window.location='send_amount.php'</script>";
                                        }else{
                                            echo $conn->error;
                                        }
                                    }
                                }
                            } else {
                                echo "<script type='text/javascript'>alert('Account not Found!');window.location='send_amount.php'</script>";
                            }
                        }
                    }
                }
            }
        } else {
            echo "<script type='text/javascript'>alert('Please Login First');window.location='login.php'</script>";
        }

        ?>
        <div class="card mx-auto mt-5" style="width: 30rem;">
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="acc" class="form-label">Enter Account No</label>
                        <input type="number" class="form-control" id="acc" name="acc">
                        <span class="w"><?php echo $accErr; ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="amm" class="form-label">Enter Amount</label>
                        <input type="number" class="form-control" id="amm" name="amm">
                        <span class="w"><?php echo $amountErr; ?></span>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Send</button>
                </form>
            </div>
        </div>
    </body>

</html>