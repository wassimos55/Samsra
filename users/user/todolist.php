<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<?php 
$username = "root";
$password = "";
$database = new PDO("mysql:host=localhost; dbname=sparki;",$username,$password);

session_start();
if(isset($_SESSION["user"])){
    if($_SESSION['user']->ROLE === "USER"){
        echo '
        <nav class="navbar navbar-light bg-light">
            <div class="container">
                <img src="../IMG/LOGO.PNG" alt="" width="" height="50">
                <a class="navbar-brand" href="#">
                
                Coder Wassim
                </a>
            </div>
        </nav>
        
        <div class="container mt-5 ">
        <form method="POST">
            <input type="text" class="form-control" name="text" required />
            <button type="submit" class=" btn btn-warning w-100 mt-3" name="add">Add Task</button>
        </form>

        </div>
        ';
         

        
    if(isset($_POST['add'])){
    $addItem = $database->prepare("INSERT INTO todolist(text,userid) VALUES(:text, :userid)");
    $addItem->bindParam("text",$_POST['text']);
    //session_start(); 7awelt'ha l fou9 fi bidayet e script 
    $userId = $_SESSION['user']->ID;
    $addItem->bindParam("userid",$userId);

    if($addItem->execute()){
        echo '<div class="alert alert-success">  added successfully </div>';
        header("refresh:2;");
    }


}



    //Import only my dta from database
    $toDoItems = $database->prepare("SELECT * FROM todolist WHERE userid = :id");
    $userId = $_SESSION['user']->id;
    $toDoItems->bindParam("id",$userId);
    $toDoItems->execute();
    foreach($toDoItems as $items){
        echo "<div class='shadow mt-3 p-2'>". $items['text'] . "</div>";
    }

    }
}
?>







