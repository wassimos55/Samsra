<?php include_once("connexion.php") ?>
<?php include_once("include/head.php") ?>
<?php include_once("include/navbar.php") ?>
<?php include_once("include/blank.php") ?>



<section>
  <div class="container pt-6">
    <div class="row">
      <div class="col-lg-8 mx-auto d-flex justify-content-center flex-column">
        <div class="card d-flex justify-content-center p-4 ">
              <?php 
                  if(isset($_POST['login'])){
                      $login = $database->prepare("SELECT * FROM users WHERE EMAIL = :email AND PASSWORD =:password");
                      $login->bindParam("email",$_POST['email']);
                      $passwordUser = md5($_POST['password']);
                      $login->bindParam("password",$passwordUser);
                      $login->execute();
                      if($login->rowCount()===1){
                          $user = $login->fetchObject();
                          session_start();
                          //$_SESSION['user'] = $user;

                          
                          //echo 'Welcome' . $user->name;
                          // $_SESSION['email']= $user->email;
                          // $_SESSION['password']= $user->PASSWORD;
                          // $_SESSION['name']= $user->name;
                          //we have a problem with session
                          
                          echo "<meta http-equiv=\"refresh\" content=\"2;URL=user\index.php\">";
                        
                      }else{
                      echo '<div class="badge bg-gradient-danger">Incorrect password or email</div>';
                      }
                  }

                ?>
          <div class="text-center">
            <h3 class="text-gradient text-info">Connexion</h3>
            <p class="mb-0">
            Merci de saisir votre adresse email et mot de passe.
            </p>
          </div>
          <div class="card card-plain">
            <form method="POST" >
              <div class="card-body pb-2">
                <div class="row">
                  <div class="col-md-12">
                    <label>Email</label>
                    <div class="input-group mb-4">
                      <input class="form-control" name="email" placeholder="flenbenfalten@gmail.com" type="email" >
                    </div>
                  </div>
                  <div class="col-md-12 ps-md-2">
                    <label>Mot de passe</label>
                    <div class="input-group">
                      <input type="password" name="password" class="form-control" placeholder="*******" >
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12 text-center">
                    <button type="submit" name="login" class="btn bg-gradient-info mt-3 w-100 mb-0">Connexion</button>
                     <!-- Button trigger modal -->
                    <a type="button" class="btn btn-outline-info mt-3 w-100" href="register.php">Créer un compte</a>
                  </div>
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

<!-- Need to implement the success msg and the error message in the page -->

      