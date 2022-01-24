<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
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
    <main class="container mt-5">
    <?php
        session_start();
        if(isset($_SESSION['user'])){
        if($_SESSION['user']->ROLE === "USER"){
            echo'
                <form method="POST">
                    Nmae : 
                    <input type="text" class="form-control" name="name" value="'. $_SESSION['user']->NAME .'" required />
                    Age :
                    <input type="date" class="form-control" name="age" value="'. $_SESSION['user']->AGE .'" required />
                    Password :
                    <input type="text" class="form-control" name="password" value="'. $_SESSION['user']->PASSWORD .'" required />

                    <button type="submit" class="btn btn-success w-100 mb-3 mt-3" name="update" value="'. $_SESSION['user']->id .'" >Update</button>
                    <a href="index.php" class="btn btn-warning w-100"> Back To Home </a>
                </form>';

            if(isset($_POST['update'])){
                $username="root";
                $password="";
                $database = new PDO("mysql:host=localhost; dbname=sparki;",$username,$password);

                $updateUserData = $database->prepare("UPDATE users SET NAME = :name , PASSWORD = :password , AGE = :age WHERE ID = :id");
                $updateUserData->bindParam('name',$_POST['name']);
                $updateUserData->bindParam('password',$_POST['password']);
                $updateUserData->bindParam('age',$_POST['age']);
                $updateUserData->bindParam('id',$_POST['update']);

                if($updateUserData->execute()){
                    echo'<div class="alert alert-success mt-3"> Data has been updated successfully ! </div>';
                    $user = $database->prepare("SELECT * FROM users WHERE ID = :id");
                    $user->bindParam('id',$_POST['update']);
                    $user->execute();
                    $_SESSION['user'] = $user->fetchObject();//na3emlou update l session w n7awlouha l object
                    header("refresh:2;");//ta7dith e saf7a ba3ed thanitin
                }
                else{
                    echo'<div class="alert alert-danger mt-3">Failed to update data</div>';
                }
            }
        }else{
            session_unset();
            session_destroy();
            header("location:http://localhost/sparki/index.php",true);
        }
        }else{
            session_unset();
            session_destroy();
            header("location:http://localhost/sparki/index.php",true);
        }

        ?>
    </main>
</body>
</html>



