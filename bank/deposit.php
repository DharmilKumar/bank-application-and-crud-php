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
        <?php
        require_once 'user_nav.php';
        require_once 'conn.php';
        $amountErr = "";
        // $id = $_COOKIE['id_cookie'];
        // session_start();
        $id = $_SESSION['id_session'];
        if ($id > 0) {
            if (isset($_POST['submit'])) {
                if (!empty($_POST['deposit'])) {
                    $amount = $_POST['deposit'];
                    if($amount<0){
                        $amountErr = "Please Enter Valid Amount";
                        $amount = "";
                    }
                } else {
                    $amountErr = "Please Enter Amount";
                }

                if (!empty($amount)) {


                    $sql1 = "SELECT * FROM bank WHERE id=$id";
                    $result = mysqli_query($conn, $sql1);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $a = $row['amount'];
                            $ab = $a + $amount;
                            $name = $row['name'];
                            $email = $row['email'];
                            $accountNo = $row['acc'];

                            date_default_timezone_set("Asia/Kolkata");
                            $time = date("d-F-Y   h:i:s");
                            $sql3 = "INSERT INTO bank_history (user_id,name,email,acc,amount,updated_amount,type,r_acc,update_time) VALUES ($id,'$name','$email','$accountNo','$amount','$ab','Deposit','-','$time');";

                            $sql = "UPDATE bank SET amount=$ab,update_time='$time' WHERE id=$id";
                            if ($conn->query($sql) && $conn->query($sql3)) {
                                echo "<script type='text/javascript'>alert('Amount Added!');window.location='deposit.php'</script>";
                            } else {
                                echo "<script type='text/javascript'>alert('Errorr!!!');window.location='deposit.php'</script>";
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
                        <label for="deposit" class="form-label">Enter Deposit Amount</label>
                        <input type="number" class="form-control" id="deposit" name="deposit">
                        <span class="w"><?php echo $amountErr; ?></span>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Add Amount</button>
                </form>
            </div>
        </div>
    </body>

</html>