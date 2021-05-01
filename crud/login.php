<?php
/* include component.php */
require_once("../crud/php/component.php");
/* include the operations file */
require_once("../crud/php/operation.php");
/* Use sessions to confirm user is signed in  */
/* session_start();
$_SESSION; */

/* Listen for a post call */
if($_SERVER['REQUEST_METHOD'] == "POST"){    
    loginUsers();   
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dimensional Games Login</title>
  <!-- font Awesome -->  
  <script src="https://kit.fontawesome.com/805c5116ec.js" crossorigin="anonymous"></script>
  <!-- Bootstrap -->  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <!-- Custom stylesheet -->
  <link rel="stylesheet" href="styles.css">

</head>
<body>
    <div class="container text-center">
    <h1 class="py-4 bg-dark text-light rounded"><i class="fas fa-gamepad"></i>Dimensional Games</h1>

     <div id="box">
        <!-- Form for data entry -->
        <form action="" method ="post" >
            <!-- Username input -->
            <div class="py-2">
            <?php inputElement("<i class='fas fa-user'></i>","User Name","user_name",""); ?>
            </div>
            <div class="py-2">
              <!-- password input -->
              <?php inputElement("<i class='fas fa-key'></i>","Password","user_password",""); ?>
            </div> 

            <div class="d-flex justify-content-center" >
            <?php  buttonElement("btn-login", "btn btn-success", "Login","login",""); ?>            
            </div>

            <div class="d-flex justify-content-center" >
            <a href ="signup.php">Sign Up</a>            
            </div>

          </form>
        </div>

     </div> 
  
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>