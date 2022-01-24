<?php include_once("../connexion.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <title>
    Samsra
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="./assets/css/soft-design-system.css?v=1.0.5" rel="stylesheet" />
</head>
<body>
<!--Navbar Start--> 
<div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <nav class="navbar navbar-expand-lg  blur blur-rounded top-0 z-index-fixed shadow position-absolute my-3 py-2 start-0 end-0 mx-4" style="background:#fff !important;" >
          <div class="container-fluid">
            <a class="navbar-brand font-weight-bolder ms-sm-3" href="index.php" rel="" title="Designed and Coded by Creative Tim" data-placement="bottom" >
              Samesra
            </a>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </span>
            </button>
            <div class="collapse navbar-collapse pt-3 pb-2 py-lg-0 w-100" id="navigation">
              <ul class="navbar-nav navbar-nav-hover ms-lg-12 ps-lg-5 w-100">
         


                <li class="nav-item ms-lg-auto">
                  <a class="nav-link nav-link-icon me-2" href="blog.php">
                    
                    <p class="d-inline text-sm z-index-1 font-weight-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Star us on Github">Blog</p>
                  </a>
                  
                </li>
                
                <li class="nav-item my-auto ms-3 ms-lg-0">
                  <a href="forms/category.php" class="btn btn-sm  bg-gradient-info  btn-round mb-0 me-1 mt-2 mt-md-0">Ajouter une offre</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>

      </div>
    </div>
  </div>
  <!--Navbar End--> 
 <!--Blank Start-->
 <div>
    <div class="page-header min-vh-50" style="background-image: url('https://media.giphy.com/media/l46C8AsW6pDKzzapO/giphy.gif')">
      <span class="mask bg-gradient-info"></span>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto text-white text-center">
            <h2 class="text-white">Search over our Blog Posts</h2>
            <p class="lead">A place for entrepreneurs to share and discover new Stories</p>
          </div>
        </div>
      </div>
    </div>

    
</div>
<!--Blank End-->
    



<div class="container mt-5">
    <form method="POST" class="card p-5">
       <p class="font-weight-bold"> Email : </p>  <input class="form-control" type="email" name="email" required/>
       <p class="font-weight-bold"> Password : </p> <input class="form-control" type="password" name="password" required/>
        <button type="submit" class="btn bg-gradient-info mt-3 w-100 mb-0" name="login">Login</button>
        <a href="register.php" class="btn btn-outline-info mt-3 w-100"> Sign Up</a>
    </form>
    <?php 
if(isset($_POST['login'])){
    $login = $database->prepare("SELECT * FROM users WHERE EMAIL = :email AND PASSWORD =:password");
    $login->bindParam("email",$_POST['email']);
    $passwordUser = md5($_POST['password']);
    $login->bindParam("password",$passwordUser);
    $login->execute();
    if($login->rowCount()===1){
        $user = $login->fetchObject();
        //echo 'Welcome' . $user->NAME;
        // $_SESSION['email']= $user->EMAIL;
        // $_SESSION['password']= $user->PASSWORD;
        // $_SESSION['name']= $user->NAME;
        session_start();
        $_SESSION['user'] = $user;
        
        if($user->ROLE ==="USER"){
            header("location:user/index.php",true);
        }else if($user->ROLE ==="ADMIN"){
            header("location:admin/index.php",true);
        }else if ($user->ROLE ==="SUPER-ADMIN"){
            header("location:super-admin/index.php",true);
        }else{

        }
    }else{
    echo '<div class="alert alert-danger">Incorrect password or email</div>';
    }
}

?>
</div>
<?php include_once("include/footer.php") ?>
<?php include_once("include/end-head.php") ?>


