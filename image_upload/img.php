<!DOCTYPE html>
<html>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="uploadfile"><br>
        <input type="submit" name="submit" value="upload file">
    </form>
</body>

</html>

<?php
if (isset($_POST['submit'])) {
    // print_r($_FILES["uploadfile"]);
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "image/" . $filename;
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    echo $ext;
    $allowed =  array('jpeg', 'jpg', "png", "gif", "bmp", "JPEG", "JPG", "PNG", "GIF", "BMP");
    if (!in_array($ext, $allowed)) {
        echo "error";
    } else {

        move_uploaded_file($tempname, $folder);
        echo "<img src='$folder' height='100px' width='100px'>";
    }

    // echo $folder;
}
?>