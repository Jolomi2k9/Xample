<?php


/* Create a new database */
function Createdb(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dimensionalgames";

    /* create conection to mysql database */
    $con = mysqli_connect($servername,$username,$password);

    /* test db connection */
    if(!$con){
        die("Connection Failed: ".mysqli_connect_error());
    }

    /* create the db */
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";

    /*Create table in db */
    if(mysqli_query($con,$sql)){
        $con = mysqli_connect($servername,$username,$password,$dbname);

        $sql = "
            CREATE TABLE IF NOT EXISTS games2(
                id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                game_title VARCHAR(30) NOT NULL,                
                game_developer VARCHAR(30) NOT NULL,
                game_publisher VARCHAR(30) NOT NULL,
                game_platform  VARCHAR(30) NOT NULL,
                game_price FLOAT
            );
        ";

        /* execute query */
        if(mysqli_query($con,$sql)){
            return $con;
        }else{
            echo "Unable to create table!";
        }

    }else{
        echo "Database creation failed!".mysqli_error($con);
    }

}
