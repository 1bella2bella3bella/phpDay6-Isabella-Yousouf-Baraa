<?php
require_once "db_connect.php";
require_once "file_upload.php";

if($_POST) {
    $name = $_POST["name"];
    $price = $_POST["price"];
    $description = $_POST["description"];
    $uploadError = "";
    $picture = file_upload($_FILES['picture']);  

    $sql = "INSERT INTO products (name, price, picture, description) values ('$name', $price, '$picture->fileName',  '$description')";

    if(mysqli_query($connect, $sql) === true) {
        $class = "success";
        $message = "The entry below was successfully created <br>

        <table class='table w-50'><tr>
        <td> $name </td>
        <td> $price </td>
        <td> $description </td>
        </tr></table><hr>";
        $uploadError = ($picture->error !=0)? $picture->ErrorMessage :'';
   } else {
       $class = "danger";
       $message = "Error while creating record. Try again: <br>" . $connect->error;
       $uploadError = ($picture->error !=0)? $picture->ErrorMessage :'';
   }
   mysqli_close($connect);
} else {
   header("location: ../error.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once '../components/boot.php'?>
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="mt-3 mb-3">
            <h1>Create request response</h1>
        </div>
        <div class="alert alert-<?=$class;?>" role="alert">
            <p><?php echo ($message) ?? ''; ?></p>
            <p><?php echo ($uploadError) ?? ''; ?></p>
            <a href='../menu.php'><button class="btn btn-danger" type='button'>Home</button></a>
        </div>
    </div>
</body>

</html>