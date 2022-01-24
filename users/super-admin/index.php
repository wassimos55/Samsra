<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<div class="container mt-5">
<?php 
session_start();
if(isset($_SESSION['user'])){
    if($_SESSION['user']->ROLE === "SUPER-ADMIN"){
        echo'Welcome' . $_SESSION['user']->NAME;
        echo'<form><button type="submit" name="logout" class="btn btn-danger">Logout</button></form>';

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
    header("location:http://localhost/sparki/login.php",true);
}
?>
</div>