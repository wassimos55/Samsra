<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spark User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="shortcut icon" href="img/logo.png" type="../image/x-icon">
</head>
<body>
    <!--Start Navbar -->
    <nav class="navbar navbar-light bg-light">
        <div class="container">
        <img src="../IMG/LOGO.PNG" alt="" width="" height="50">
            <a class="navbar-brand" href="#">
            
            Coder Wassim
            </a>
        </div>
    </nav>
    <!--End Navbar -->
  <div class="container mt-5">
  <?php 
    session_start();
    if(isset($_SESSION['user'])){
        if($_SESSION['user']->ROLE === "USER"){
            echo' <div class="shadow p-3 mb-5 bg-body rounded"> Welcome Dr '. $_SESSION['user']->NAME .'</div>';
            echo'<a class="btn btn-outline-info mb-3 w-100" href="profile.php">Edit Personal Information</a>';
            echo'<a class="btn btn-outline-warning mb-3 w-100" href="todolist.php">Add Tasks</a>';
            echo'<form><button type="submit"  name="logout" class="btn btn-outline-danger w-100">Logout</button></form>';

        }else{
            header("location:http://localhost/sparki/login.php",true);
            die("");
        }
    }else{
        header("location:http://localhost/sparki/login.php",true);
        die("");
    }

    if(isset($_GET['logout'])){
        session_unset();//7athf e jalsa
        session_destroy();//tadmir e jalsa
        header("location:http://localhost/samsra/users/login.php",true);
    }
  ?>
  </div>
</body>
</html>




