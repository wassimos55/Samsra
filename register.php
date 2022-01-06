<?php include_once("connexion.php") ?>
<?php include_once("include/head.php") ?>
<?php include_once("include/navbar.php") ?>
<?php include_once("include/blank.php") ?>


<section>
  <div class="container pt-6">
    <div class="row">
      <div class="col-lg-12 mx-auto d-flex justify-content-center flex-column">
        <div class="card d-flex justify-content-center p-4 ">
          <div class="card card-plain">
          <?php
             


             if(isset($_POST['upload'])){
              $checkEmail = $database->prepare("SELECT * FROM users WHERE EMAIL = :EMAIL");
              $email = $_POST['email'];
              $checkEmail->bindParam("EMAIL",$email);
              $checkEmail->execute();
          
              if($checkEmail->rowCount()>0){
                  echo '<div class="alert alert-danger" role="alert">
                  This account is already in use
                </div>';
              }else{
                  $name =$_POST['name'] ;
                  $lastname = $_POST['lastname'];
                  $email = $_POST['email'];
                  $pnumber = $_POST['pnumber'];
                  $ville = $_POST['ville'];
                  $password =md5($_POST['password']) ;
          
                  $addUser = $database->prepare("INSERT INTO users(name,lastname,email,pnumber,ville,password)
                   VALUES(:name,:lastname,:email,:pnumber,:ville,:password)");
                  $addUser->bindParam("name",$name);
                  $addUser->bindParam("lastname",$lastname);
                  $addUser->bindParam("email",$email);
                  $addUser->bindParam("pnumber",$pnumber);
                  $addUser->bindParam("ville",$ville);
                  $addUser->bindParam("password",$password);
                  if($addUser->execute()){
                      echo '<div class="alert alert-success" role="alert">Account created successfully </div>';
                      echo "<meta http-equiv=\"refresh\" content=\"2;URL=login.php\">";
                  }else{
                      echo '<div class="alert alert-danger" role="alert">An unexpected error occurred </div>';
                  }
                 
              }
          
          }





          ?>
              <form method="POST" enctype="multipart/form-data"> 
                 <div class="row p-4">
                     <div class="col-md-6 ps-0 mb-3">
                        <label  class="form-label">Nom </label>
                        <input type="text" name="name" class="form-control shadow-none" >
                    </div>
                    <div class="col-md-6 ps-0 mb-3">
                        <label  class="form-label">Prènom </label>
                        <input type="text" name="lastname" class="form-control shadow-none" >
                    </div>
                    <div class="col-md-6 ps-0 mb-3">
                        <label  class="form-label">Email </label>
                        <input type="email" name="email" class="form-control shadow-none" >
                    </div>                                    
                    <div class="col-md-6 ps-0 mb-3">
                        <label  class="form-label">Numéro de téléphone </label>
                        <input type="text" name="pnumber" class="form-control shadow-none" >
                    </div>
                    <div class="col-md-6 ps-0 mb-3">
                        <label  class="form-label">Ville </label>
                        <input type="text" name="ville" class="form-control shadow-none" >
                    </div>                                  
                    <div class="col-md-6 ps-0 mb-3">
                        <label  class="form-label">Password </label>
                        <input type="password" name="password" class="form-control shadow-none" >
                    </div>
                    <div class="text-center mt-1 mb-2">
                        <button type="submit" name="upload" class="btn bg-gradient-info btn-lg btn-rounded w-100 mt-4 mb-0">Enregistrer</button>
                    
                    </div>
                 </div>
              </form>

           
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<?php include_once("include/footer.php") ?>
<?php include_once("include/end-head.php") ?>