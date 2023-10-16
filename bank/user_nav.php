<html>

<head>
    <style>
        .card-1-img {
            width: 100px;
            border-radius: 50%;
        }
    </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    <?php
    require_once 'conn.php';
    // $id = $_COOKIE['id_cookie'];
    session_start();
    $id = $_SESSION['id_session'];
    $sql = "SELECT acc,amount,name FROM bank WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $accNo = $row['acc'];
            $name = $row['name'];
            $balance = $row['amount'];
        }
    }


    if (isset($_POST['id'])) {
        session_destroy();
        echo "<script type='text/javascript'>window.location='login.php'</script>";
    }
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <p class="navbar-brand" style="margin-bottom: 0;"><?php echo $name . "'s ACC"; ?></p>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="deposit.php">Deposit</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="withdraw.php">WithDraw</a>
                    </li>
                    <li class="nav-item">
                        <p class="nav-link active" style="margin-bottom: 0;">Balance: <?php echo $balance; ?></p>
                    </li>
                    <li class="nav-item">
                        <p class="nav-link active" style="margin-bottom: 0;"><?php echo "ACC No: " . $accNo; ?></p>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="all_users.php">View Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="send_amount.php">Send Amount</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link active" href="history.php">History</a>
                    </li>
                </ul>
            </div>
            <div class="d-flex justify-content-end">

                <div class="d-flex align-items-center">
                    <form action="" method="post">
                        <button type="submit" name="id" style="border: 1px solid white;margin-bottom:0;">
                            <i class="bi bi-box-arrow-right" style="font-size: 45px;"></i>
                        </button>
                    </form>

                </div>

                <div class="text-center">
                    <img class="card-1-img" src="bank.jpg">
                </div>
            </div>
        </div>
    </nav>
</body>

</html>