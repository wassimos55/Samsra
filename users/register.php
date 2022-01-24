<?php include_once("../connexion.php") ?>
<?php include_once("include/head.php") ?>
<?php include_once("include/navbar.php") ?>
<?php include_once("include/blank.php") ?>
<div class="container" >


<form method="POST" class="card p-5 mt-5">
Name : <input class="form-control" type="text" name="name" required/>
<br>
Age  : <input class="form-control" type="date" name="age" required/>
<br>
Email : <input class="form-control" type="email" name="email" required/>
<br>
 Password : <input class="form-control" type="text" name="password" required />
<br>
<button class="btn bg-gradient-info mt-3 w-100 mb-0" type="submit" name="register"> Register</button>
<a href="login.php" class="btn btn-outline-info mt-3 w-100">Login</a>
</form>

</div>


<?php 




if(isset($_POST['register'])){
    $checkEmail = $database->prepare("SELECT * FROM users WHERE EMAIL = :EMAIL");
    $email = $_POST['email'];
    $checkEmail->bindParam("EMAIL",$email);
    $checkEmail->execute();

    if($checkEmail->rowCount()>0){
        echo '<div class="alert alert-danger" role="alert">
        هذا حساب سابقا مستخدم
      </div>';
    }else{
        $name =$_POST['name'] ;
        $password =md5($_POST['password']) ;
        $email = $_POST['email'];
        $age = $_POST['age'];

        $addUser = $database->prepare("INSERT INTO users(NAME,AGE,PASSWORD,EMAIL,ROLE)
         VALUES(:NAME,:AGE,:PASSWORD,:EMAIL,'USER')");
        $addUser->bindParam("NAME",$name);
        $addUser->bindParam("AGE",$age);
        $addUser->bindParam("PASSWORD",$password);
        $addUser->bindParam("EMAIL",$email);
        if($addUser->execute()){
            echo '<div class="alert alert-success" role="alert">
            تم إنشاء حساب بنجاح 
          </div>';

        }else{
            echo '<div class="alert alert-danger" role="alert">
            حدث خطا غير متوقع
          </div>';
        }
       
    }

}
?>
<?php include_once("include/footer.php") ?>
<?php include_once("include/end-head.php") ?>