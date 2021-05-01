

<?php
/* include component.php */
require_once("../crud/php/component.php");
/* include the operations file */
require_once("../crud/php/operation.php");
/* Use sessions to confirm user is signed in  */
session_start();
/* Collect user data */
//$user_data = check_login($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dimensional Games</title>
  <!-- font Awesome -->  
  <script src="https://kit.fontawesome.com/805c5116ec.js" crossorigin="anonymous"></script>
  <!-- Bootstrap -->  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <!-- Custom stylesheet -->
  <link rel="stylesheet" href="styles.css">

</head>
<body>
  <main>
    <div class="container text-center">
      <h1 class="py-4 bg-dark text-light rounded"><i class="fas fa-gamepad"></i>Dimensional Games</h1>
            
          <div class="d-flex justify-content-center">
            <!-- Form for Navigation buttons-->
            <form action="" method ="post" class= "w-50">               
              <div class="d-flex justify-content-center" >
              <?php  buttonElement("btn-create", "btn btn-success", "Create","createNav",""); ?>
              <?php  buttonElement("btn-read", "btn btn-primary", "View DB","readNav",""); ?>
              <?php  buttonElement("btn-update", "btn btn-light border", "Update","updateNav",""); ?>
              <?php  buttonElement("btn-delete", "btn btn-danger", "Delete","deleteNav",""); ?>
              </div>
            </form>
          </div>

      <!-- Table for DB data -->
      <div class="d-flex table-db">           

            <table class="table table-striped table-dark">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>                        
                        <th>Developer</th>
                        <th>Publisher</th>
                        <th>Platform</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                 <?php
                      /* Populate table with data from the database */
                     if(isset($_POST['read'])){
                      $output = getData();                      
                      if($output){
                        while($row = mysqli_fetch_assoc($output)){?>
                        <tr>
                          <td><?php echo $row['id'];?></td>
                          <td><?php echo $row['game_title'];?></td>
                          <td><?php echo $row['game_developer'];?></td>
                          <td><?php echo $row['game_publisher'];?></td>
                          <td><?php echo $row['game_platform'];?></td>
                          <td><?php echo '€'.$row['game_price'];?></td>
                        </tr>
                      <?php
                        }
                      }
                    }                
                 ?>     
                
                </tbody>
            </table>
        </div>   
      
      <div class="d-flex justify-content-center">       

          <!-- Form for buttons-->
          <form action="" method ="post" class= "w-50">          

            <div class="d-flex justify-content-center" >            
              <?php  buttonElement("btn-read", "btn btn-primary", "<i class='fas fa-sync'></i>","read",""); ?>            
            </div>
          </form>
      </div>
    </div>
  </main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>