<?php 
session_start();
require_once "actions/db_connect.php";
$sql = "SELECT * FROM products";
$result = mysqli_query($connect, $sql);
$tbody = "";

$class= "hide";
$class2 = "hide";
if(isset($_SESSION["adm"])){
  $class="show";
  $class2="show";
} 

  
if (mysqli_num_rows($result) > 0) {
 
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      
      // if(isset($_SESSION['adm'])){
      // $button = '<a href="update.php?id=' .$row['id'].'"><button class="btn btn-primary btn-sm m-2" type="button">Edit</button></a><a href="delete.php?id=' .$row['id'].'"><button class="btn btn-danger btn-sm m-2" type="button">Delete</button></a>';

      // $button2 = '  <a href="create.php"><button class="btn btn-danger"type="button">Add product</button></a>';
      // } else {
      //   $button = '<a href=".php?id=' .$row['id'].'"><button class="btn btn-primary btn-sm m-2" type="button">Order</button></a>';
      // }
      

 $tbody .= '<div class="col">
        <div class="card border-0 shadow">
            <img src="pictures/'.$row["picture"].'" class="card-img-top" alt=" ">
            <div class="card-body">
                <h4 class="card-title text-center">'.$row["name"].'</h4>
                <p class="card-text">'.$row["price"].'€</p>
                <p class="card-text">'.$row["description"].'</p>
            </div>
            <div class="d-flex justify-content-end">
            <a href="update.php?id=' .$row['id'].'"><button class="btn btn-primary btn-sm m-2 ' . $class.'" type="button">Edit</button></a><a href="delete.php?id=' .$row['id'].'"><button class="btn btn-danger btn-sm m-2 ' . $class.'" type="button">Delete</button></a>
           
            
           
           </div>
        </div>
    </div>';
       
    };
} else {
    $tbody =  "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
}

mysqli_close($connect);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php require_once "components/boot.php" ?>

    <style type="text/css">
        *{
            font-family: Georgia, serif;
        }
        .manageProduct {
            margin: auto;
        }
        .manageProduct p {
            text-align: center;
            margin: 3vw;
        }
        .hide {
          visibility: hidden;
        }
        .show {
          visibility: visible;
        }

        .card:hover{
            background-color: antiquewhite;
        }

    </style>

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Delivery Italian</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Features</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Pricing</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled">Disabled</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<a href="login/logout.php?logout"><button class="btn btn-danger"type="button">Sign Out</button></a>
    <div class="manageProduct w-75 mt-3">
        <p class='h2'>Menu</p>
        <div class="row row-cols-1 row-cols-md-3 g-4">

            <?= $tbody; ?>

        </div>
        <div class='mt-5'>
        <a href="create.php"><button class="btn btn-danger <?= $class2 ?>" type="button">Add product</button></a>
             
            </div>
    </div>
</body>

</html>