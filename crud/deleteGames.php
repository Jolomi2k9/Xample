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
  <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">

</head>
<body>
  <main>
    <div class="container text-center">
      <h1 class="py-4 bg-dark text-light rounded"><i class="fas fa-gamepad"></i>Dimensional Games</h1>

      <div class="d-flex justify-content-center">
      <!-- Form to edit data-->      
      <form action="" method ="post" class= "w-50">

              <!-- Navigation Buttons -->
              <div class="d-flex justify-content-center" >
                <?php  buttonElement("btn-create", "btn btn-success", "Create","createNav",""); ?>
                <?php  buttonElement("btn-read", "btn btn-primary", "View DB","readNav",""); ?>
                <?php  buttonElement("btn-update", "btn btn-light border", "Update","updateNav",""); ?>
                <?php  buttonElement("btn-delete", "btn btn-danger", "Delete","deleteNav",""); ?>
              </div>

            <div class="py-2">
                <?php inputElement("<i class='fas fa-id-card'></i>","ID","game_id",""); ?>
                </div>

                <div class="py-2">
                <!-- auto create input forms -->
                <?php inputElement("<i class='fas fa-gamepad'></i>","Game Title","game_title",""); ?>
                </div>
                <div class="row">              
                <!-- Developer -->
                <div class="col">                
                    <?php inputElement("<i class='fas fa-file-code'></i>","Developer","game_developer",""); ?>
                </div> 
                <!-- Publisher -->
                <div class="col">                
                    <?php inputElement("<i class='fas fa-people-carry'></i>","Publisher","game_publisher",""); ?>
                </div>
                </div>
                <div class="row">              
                <!-- Platform -->
                <div class="col">                
                    <?php inputElement("<i class='fas fa-layer-group'></i>","Platform","game_platform",""); ?>
                </div>
                <!-- Price -->
                <div class="col">                
                    <?php inputElement("<i class='fas fa-euro-sign'></i>","Price","game_price",""); ?>
                </div>
                </div>          

                <div class="d-flex justify-content-center" >                
                <?php  buttonElement("btn-delete", "btn btn-danger", "<i class='far fa-trash-alt'></i>","delete",""); ?>
                <?php  buttonElement("btn-read", "btn btn-primary", "<i class='fas fa-sync'></i>","read",""); ?>
                <?php  deleteTableBtn(); ?>
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
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody >
                 <?php
                      /* Populate table with data from the database */
                     if(isset($_POST['read'])){
                      $output = getData();                      
                      if($output){
                        while($row = mysqli_fetch_assoc($output)){?>
                        <tr>
                          <td data-id="<?php echo $row['id']; ?>"><?php echo $row['id'];?></td>
                          <td data-id="<?php echo $row['id']; ?>"><?php echo $row['game_title'];?></td>
                          <td data-id="<?php echo $row['id']; ?>"><?php echo $row['game_developer'];?></td>
                          <td data-id="<?php echo $row['id']; ?>"><?php echo $row['game_publisher'];?></td>
                          <td data-id="<?php echo $row['id']; ?>"><?php echo $row['game_platform'];?></td>
                          <td data-id="<?php echo $row['id']; ?>"><?php echo '€'.$row['game_price'];?></td>
                          <td ><i class="fas fa-pencil-alt btnedit " data-id="<?php echo $row['id']; ?>"></i></td>                          
                        </tr>
                      <?php
                        }
                      }
                    }                
                 ?>     
                
                </tbody>
            </table>
        </div>      
      
      
    </div>
  </main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<script src="../crud/php/main.js"></script>
</body>
</html>