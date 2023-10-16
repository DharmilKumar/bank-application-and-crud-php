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
    <?php require_once 'nav.php'; ?>
    <?php
    require_once 'conn.php';


    $name = $nameErr = $folder = $folderErr = $email = $emailErr = $contact = $contactErr = $age = $ageErr = $gender = $genderErr = "";

    $emailReg = '/^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$/';
    $ageReg = '/^(1[6-9]|[2-4][0-9]|50)$/';
    $nameReg = '/^[A-Za-z\s]+$/';
    $contactReg = '/^\d{10}$/';


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
            $folder = "image/" . $filename;
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $allowed =  array('jpeg', 'jpg', "png", "gif", "bmp", "JPEG", "JPG", "PNG", "GIF", "BMP");
            if (!in_array($ext, $allowed)) {
                $folderErr = ".jpg .jpeg .png only allowed!";
                $folder = "";
            } else {
                $folder = "image/" . $filename;
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
        if (empty($_POST['age'])) {
            $ageErr = "Please Enter Age";
        } else {
            $age = $_POST["age"];
            if (!preg_match($ageReg, $age)) {
                $ageErr = "Age is in between 16 to 50";
                $age = "";
            } else {
                $age = $_POST['age'];
            }
        }
        if (empty($_POST['gender'])) {
            $genderErr = "Please Enter Gender";
        } else {
            $gender = $_POST["gender"];
        }

        if (!empty($name && !empty($folder) && !empty($email) && !empty($contact) && !empty($age) && !empty($gender))) {
            $sql1 = mysqli_query($conn, "SELECT email FROM golden4 WHERE email='$email'");
            if (mysqli_num_rows($sql1) > 0) {
                echo '<script language="javascript">';
                echo 'alert("Email Id already exists")';
                echo '</script>';
            } else {
                move_uploaded_file($tempfile, $folder);
                $sql = "INSERT INTO golden4(name,image,email,contact,age,gender) VALUES ('$name','$folder','$email',$contact,$age,'$gender');";
                if ($conn->query($sql) == true) {
                    echo '<script language="javascript">';
                    echo 'alert("Successfully Inserted"); location.href="insert_data.php"';
                    echo '</script>';
                } else {
                    echo "error while inserting data " . $conn->error;
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
                    <label for="contact" class="form-label">Enter Contact</label>
                    <input type="number" class="form-control" id="contact" name="contact">
                    <span class="w"><?php echo $contactErr ?></span>
                </div>
                <div class="mb-3">
                    <label for="age" class="form-label">Age</label>
                    <input type="number" class="form-control" id="age" name="age">
                    <span class="w"><?php echo $ageErr ?></span>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="gender" value="male" checked>
                    <label class="form-check-label" for="gender">
                        Male
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="gender" value="female">
                    <label class="form-check-label" for="gender">
                        Female
                    </label><br>
                    <span class="w"><?php echo $genderErr ?></span>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</body>

</html>