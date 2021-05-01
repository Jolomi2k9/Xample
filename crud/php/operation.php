<?php

require_once("db.php");
require_once("component.php");


/* Create database and establish connection */
$con = Createdb();

/* Navigate to a page based on the button clicked*/

if(isset($_POST['createNav'])){
    header("Location: index.php");
    die;
}
if(isset($_POST['readNav'])){
    header("Location: viewGames.php");
    die;
}
if(isset($_POST['updateNav'])){
    header("Location: editGames.php");
    die;
}
if(isset($_POST['deleteNav'])){
    header("Location: deleteGames.php");
    die;
}

/* Perform CRUD operations based on the button clicked*/

if(isset($_POST['create'])){
    createEntry();
}
if(isset($_POST['update'])){
    UpdateEntry();
}
if(isset($_POST['delete'])){
    DeleteEntry();
}
if(isset($_POST['deleteall'])){
    deleteTable();
}



function createEntry(){
    $gametitle = textboxInput("game_title");    
    $gamedeveloper = textboxInput("game_developer");
    $gamepublisher = textboxInput("game_publisher");
    $gameplatform = textboxInput("game_platform");
    $gameprice = textboxInput("game_price");

    /* Insert into db if values are present */
    if($gametitle&&$gamedeveloper&&
    $gamepublisher&&$gameplatform&&$gameprice){
        
        $sql = "INSERT INTO games2(game_title,
                game_developer,game_publisher,game_platform
                ,game_price)
                VALUES('$gametitle','$gamedeveloper',
                '$gamepublisher','$gameplatform','$gameprice')";            

        if(mysqli_query($GLOBALS['con'],$sql)){
            notifications("success","Entry inserted!"); 
        }else{
            notifications("warning","Unable to insert entry into table!");
        }

    }else{
        notifications("warning","Textbox cannot be left blank!");
    }

}

/* input validation and security againts sql injection */
function textboxInput($input){
    $textbox = mysqli_real_escape_string($GLOBALS['con'],trim($_POST[$input]));
    if(empty($textbox)){
        return false;
    }else{
        return $textbox;
    }
}

/* User notifications */
function notifications($classname,$prompt){
    $element = "<h6 class='$classname'>$prompt</h6>";
    echo $element;
}

/* Retrieve data in mySql database */
function getData(){
    /* sql queries */
   $sql = "SELECT * FROM games2";

   /* execute sql queries */
   $output = mysqli_query($GLOBALS['con'],$sql);

   if(mysqli_num_rows($output) > 0){
       return $output;
   }
}

/* Update database entry*/
function UpdateEntry(){
    $gameid = textboxInput("game_id");
    $gametitle = textboxInput("game_title");
    $gamedeveloper = textboxInput("game_developer");
    $gamepublisher = textboxInput("game_publisher");
    $gameplatform = textboxInput("game_platform");
    $gameprice = textboxInput("game_price");


    if($gametitle&&$gamedeveloper&&$gamepublisher&&$gameplatform&&$gameprice){
        /* sql query */
        $sql= "
            UPDATE games2 SET game_title = '$gametitle',
            game_developer = '$gamedeveloper',
            game_publisher = '$gamepublisher',
            game_platform = '$gameplatform',
            game_price = '$gameprice'
            WHERE id = '$gameid';
        ";
        /* execute query */
        if(mysqli_query($GLOBALS['con'],$sql)){
            notifications("success","Entry Updated!");
        }else{
            notifications("warning","Update Failed!");
        }

    }else{
        notifications("warning","No entry selected!");
    }
}

/* Delete database entry */
function DeleteEntry(){
    $gameid = (int)textboxInput("game_id");
    /* sql query */
    $sql= "DELETE FROM games2 WHERE id = '$gameid'";
    /* execute query */
    if(mysqli_query($GLOBALS['con'],$sql)){
        notifications("success","Entry Deleted!");
    }else{
        notifications("warning","Delete Failed!");
    }
}

/* Delete all entries in database */
function deleteTable(){
    $sql= "DROP TABLE games2";

    if(mysqli_query($GLOBALS['con'],$sql)){
        notifications("success","All Entries Deleted!");
        /* createEntry(); */
    }else{
        notifications("warning","Delete Failed!");
    }
    
}

/* When there are more than 5 entries in database, show delete all button */
function deleteTableBtn(){
    $output = getData();
    $c = 0;
    if($output){
        while($row = mysqli_fetch_assoc($output)){
            $c++;
            if($c > 5){
                buttonElement("btn-deleteall","btn btn-danger","Delete All","deleteall","");
                return;
            }
        }
    }    
}
/* Check if a user is logged in */
function check_login(){

    if(isset($_SESSION['user_id'])){

        $id = $_SESSION['user_id'];
        /* sql query */
        $sql= "SELECT * FROM users WHERE user_id = '$id' limit 1";

        /* execute query */
        //$output = mysqli_query($con,$sql);
        $output = mysqli_query($GLOBALS['con'],$sql);

        if($output /* && mysqli_num_rows($output) > 0 */ ){
            $user_data = mysqli_fetch_assoc($output);
            return $user_data;
        }
    }else{
        /*  */
        header("Location: login.php");
        die;
    }
}

/* generate a random number */
function random_num($length){
    $text = "";
    if($length < 5){
        $length = 5;
    }
    $len = rand(4,$length);
    for($i=0; $i< $len; $i++){
        $text .= rand(0,9);
    }

    return $text;
}

/* Sign up User */
function signupUsers(){
    /* Collect post data */
    $user_name = $_POST['user_name'];
    $user_password = $_POST['user_password'];

    if(!empty($user_name) && !empty($user_name)){
        /* Generate a user id */   
        $user_id = random_num(20);     
        /* sql query */
        $sql = "INSERT INTO users(user_id,user_name,password) values('$user_id','$user_name','$user_password')";
        /* Execute query */
        if(mysqli_query($GLOBALS['con'],$sql)){
            notifications("success","Sign Up Successful");           
        }else{
            notifications("warning","Sign Up Failed!");
        }        
    }else{
        notifications("warning","Please enter a user name and password");
    }
}

/* login User */
function loginUsers(){
    /* Collect post data */
    $user_name = $_POST['user_name'];
    $user_password = $_POST['user_password'];

    if(!empty($user_name) && !empty($user_name)){             
        /* sql query */
        $sql = "SELECT * FROM users WHERE user_name = '$user_name' limit 1";
        /* Execute query */
        $output = mysqli_query($GLOBALS['con'],$sql);   
        
        
        /* Confirm password */
        if($output){     
                 
            if($output/*  && mysqli_num_rows($output) > 0 */ ){                
                $user_data = mysqli_fetch_assoc($output);                
                if($user_data['password'] === $user_password){                    
                    /* assign session id and direct to index page */
                    $_SESSION['user_id'] = $user_data['user_id'];
                    header("Location: index.php");
                    die;
                }else{
                    notifications("warning","Wrong username or password");
                }
            }else{
                //notifications("warning","L2");
            }
        }
                 
    }else{
        notifications("warning","Please enter a user name and password");
    }
}