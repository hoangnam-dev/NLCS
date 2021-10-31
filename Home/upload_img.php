<?php
include("./funciton.php");
if(isset($_GET['upload']) && $_GET['upload']=='file'){
    $uploadfile = $_FILES['file_upload'];
    $err = uploadFiles($uploadfile);
    if(!empty($errors)){
        print_r($errors);
        exit;
    }else{
        echo "upload thanh cong";
    }
}else {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Image</title>
</head>
<body>
    <form action="?upload=file" enctype="multipart/form-data" method="POST">
        <input multiple type="file" name="file_upload[]">
        <input type="submit" name="submit" id="upload_file">
    </form>
</body>
</html>

<?php } ?>