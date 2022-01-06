<?php include_once("connexion.php") ?>
<?php include_once("include/head.php") ?>

<form method="POST" enctype="multipart/form-data">

<?php
if(isset($_POST['upload'])){
    $checkEmail = $database->prepare("SELECT * FROM test WHERE email = :email");
    $email = $_POST['email'];
    $checkEmail->bindParam("email",$email);
    $checkEmail->execute();

    if($checkEmail->rowCount()>0){
        echo 'this email is alreaddy used'  ;
    }else{
           $name =$_POST['name'] ;
           $lastname =$_POST['lastname'] ;
           $email = $_POST['email'];


           $fileName = $_FILES['file']["name"];
           $fileType = $_FILES['file']["type"];
           $fileData = file_get_contents($_FILES['file']["tmp_name"]);//takoum bi ta7did el milaf men thakirat ta5zin el moue2kata bel fonction haki
           $addFile = $database->prepare("INSERT INTO test(file,fileName,fileType,name,lastname,email) VALUES(:file,:fileName,:fileType,:name,:lastname,:email)");
           $addFile->bindParam("file",$fileData);
           $addFile->bindParam("fileType",$fileType);
           $addFile->bindParam("fileName",$fileName);

           $addFile->bindParam("name",$name);
           $addFile->bindParam("lastname",$lastname);
           $addFile->bindParam("email",$email);

           if($addFile->execute()){
               echo "File is enregistred";
               
           }else{
               echo "File is not enregistred";
           }
       }

    }


       ?>

    

         

          
            
                                
            <div class="col-md-6 ps-0 mb-3">
                <label   class="form-label">Image </label>
                <input type="file" name="file" class="form-control shadow-none" >
            </div>
           <div class="col-md-6 ps-0 mb-3">
                <label  class="form-label">Prènom </label>
                <input type="text" name="name" class="form-control shadow-none" >
            </div>
             <div class="col-md-6 ps-0 mb-3">
                <label  class="form-label">lastname </label>
                <input type="text" name="lastname" class="form-control shadow-none" >
            </div>
            <div class="col-md-6 ps-0 mb-3">
                <label  class="form-label">Email </label>
                <input type="email" name="email" class="form-control shadow-none" >
            </div>

            
 
    
    <button type="submit" name="upload" class="btn bg-gradient-info btn-lg btn-rounded w-100 mt-4 mb-0">Enregistrer</button>
   

   
</form>


<?php include_once("include/end-head.php"); ?>
