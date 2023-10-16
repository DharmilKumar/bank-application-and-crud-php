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
        <?php require_once 'nav.php'; ?>
        <?php
        require_once 'conn.php';


        $name = $nameErr = $folder = $folderErr = $email = $emailErr = $contact = $contactErr = $password = $passwordErr = $hash = "";

        $emailReg = '/^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$/';
        $ageReg = '/^(1[6-9]|[2-4][0-9]|50)$/';
        $nameReg = '/^[A-Za-z\s]+$/';
        $passReg = '/^(?=.*[A-Za-z])(?=.*\d)(?=.*[\W_]).{8,}$/';
        $contactReg = '/^\d{10}$/';
        $accReg = '/^\d{16}$/';


        if (isset($_POST['submit'])) {
            $filename = $_FILES["image"]["name"];
            $tempfile = $_FILES["image"]["tmp_name"];


            if (empty($_POST['name'])) {
                $nameErr = "Please Enter Name";
            } else {
                $name = $_POST["name"];
                if (!preg_match($nameReg, $name)) {
                    $nameErr = "Name must be alphabets only.";
                    $name = "";
                } else {
                    $name = $_POST['name'];
                }
            }
            if (empty($filename = $_FILES["image"]["name"])) {
                $folderErr = "Please Select Image";
            } else {
                $folder = "images/" . $filename;
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $allowed =  array('jpeg', 'jpg', "png", "gif", "bmp", "JPEG", "JPG", "PNG", "GIF", "BMP");
                if (!in_array($ext, $allowed)) {
                    $folderErr = ".jpg .jpeg .png only allowed!";
                    $folder = "";
                } else {
                    $folder = "images/" . $filename;
                }
            }
            if (empty($_POST['email'])) {
                $emailErr = "Please Enter Email";
            } else {
                $email = $_POST["email"];
                if (!preg_match($emailReg, $email)) {
                    $emailErr = "Please Enter Valid Email";
                    $email = "";
                } else {
                    $email = $_POST["email"];
                }
            }


            if (empty($_POST['password'])) {
                $passwordErr = "Please Enter Password";
            } else {
                $password = $_POST["email"];
                if (!preg_match($passReg, $password)) {
                    $passwordErr = "password has minimum 8 length and contains special character!";
                    $password = "";
                } else {
                    $password = $_POST["password"];
                    $hash = password_hash($password, PASSWORD_DEFAULT);
                }
            }


            if (empty($_POST['contact'])) {
                $contactErr = "Please Enter Contact";
            } else {
                $contact = $_POST["contact"];
                if (!preg_match($contactReg, $contact)) {
                    $contactErr = "Contact must be 10 digits only!";
                    $contact = "";
                } else {
                    $contact = $_POST['contact'];
                }
            }

            // echo $name." ".$contact . " " . $hash. "  " .$passwordErr . " " . $email . " ". $acc." ". $folder." ";
            if (!empty($name && !empty($folder) && !empty($email) && !empty($contact) && !empty($hash))) {
                $sql1 = mysqli_query($conn, "SELECT email FROM bank WHERE email='$email'");
                if (mysqli_num_rows($sql1) > 0) {
                    echo '<script language="javascript">';
                    echo 'alert("Email Id already exists")';
                    echo '</script>';
                } else {
                    move_uploaded_file($tempfile, $folder);
                    $num = str_pad(mt_rand(1, 99999999), 8, '0', STR_PAD_LEFT);
                    $query = "SELECT acc FROM bank WHERE acc=$num";
                    $result = mysqli_query($conn, $query);
                    if ($result->num_rows > 0) {
                        echo '<script language="javascript">';
                        echo 'alert("Try Again");';
                        echo '</script>';
                    } else {
                        date_default_timezone_set("Asia/Kolkata");
                        $time = date("d-F-Y   h:i:s");
                        $sql = "INSERT INTO bank(name,image,email,password,contact,acc,update_time) VALUES ('$name','$folder','$email','$hash',$contact,$num,'$time');";

                        if ($conn->query($sql) == true) {
                            echo '<script language="javascript">';
                            echo 'alert("Successfully Inserted");';
                            echo '</script>';
                        } else {
                            echo "error while inserting data " . $conn->error;
                        }
                    }
                }
            }
        }
        ?>
        <div class="card mx-auto mt-5" style="width: 30rem;">
            <div class="card-body">
                <form action="#" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Enter Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                        <span class="w"><?php echo $nameErr ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Select Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                        <span class="w"><?php echo $folderErr ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                        <span class="w"><?php echo $emailErr ?></span>
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <span class="w"><?php echo $passwordErr ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="contact" class="form-label">Enter Contact</label>
                        <input type="number" class="form-control" id="contact" name="contact">
                        <span class="w"><?php echo $contactErr ?></span>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Register</button>
                </form>
            </div>
        </div>
    </body>

</html>