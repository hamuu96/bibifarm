<?php

include('connect.php');

$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'BibiFarm';


$conn = new mysqli($servername, $username, $password,$database);
// sql script to create database
$create_database = "CREATE DATABASE IF NOT EXISTS ".$database;

//execution of the database script
$exec_database = mysqli_query($conn, $create_database);

//produce table

$create_produce = 'CREATE TABLE  IF NOT EXISTS PRODUCE(
    produceID int(4) primary key, 
    produceName varchar(20) not null , 
    producePrice int(4) not null,
    produceDescription varchar(400),
    img varchar(200)
)';

//excution of produce table
$exec_produce = mysqli_query($conn, $create_produce);

//produce insertion
$insert_onion = "INSERT  INTO  `PRODUCE` (produceID, produceName, producePrice, produceDescription,img)
                    VALUES (01, 'Onion', 200,'The red onions are mostly large to medium size and has a mellow test.','images/produces/ onion.jpg')";

$exec_iProduce = mysqli_query($conn, $insert_onion);

//insert tomatoes
$insert_tomatoes = "INSERT  INTO  `PRODUCE` (produceID, produceName,  producePrice, produceDescription,img)
                    VALUES (02, 'Tomatoes', 300, 'Tomatoes are normally rounded, large, edible, pulpy berry of an herb of the nightshade family native to South America','images/produces/tomato1.jpg')";

$exec_tomatoes = mysqli_query($conn, $insert_tomatoes);
//insert tomatoes
$insert_green = "INSERT  INTO  `PRODUCE` (produceID, produceName, producePrice, produceDescription,img)
                    VALUES (03, 'Green bell pepers', 100, 'A fresh, crisp green bell pepper is a tasty vegetable that can be a regular part of your healthy eating plan.','images/produces/hoho2.jpg')";

$exec_green = mysqli_query($conn, $insert_green);

//insert tomatoes
$insert_water = "INSERT  INTO  `PRODUCE` (produceID, produceName, producePrice, produceDescription,img)
                    VALUES (04, 'Watermelon',150, 'Watermelons are mostly water about 92 percent but this refreshing fruit is soaked with nutrients.','images/produces/watermelon1.jpg')";

$exec_water = mysqli_query($conn, $insert_water);
//insert tomatoes
$insert_pepers = "INSERT  INTO  `PRODUCE` (produceID, produceName, producePrice, produceDescription,img)
                    VALUES (05, 'pepers', 100,'Peppers are the dried unripe fruit grown in the plant called piper nigrum','images/produces/peper.jpg')";

$exec_pepers = mysqli_query($conn, $insert_pepers);
//insert tomatoes
$insert_avacado = "INSERT  INTO  `PRODUCE` (produceID, produceName, producePrice, produceDescription,img)
                    VALUES (06, 'Avacado', 80,'Avocados are commercially valuable and are cultivated in tropical and Mediterranean climates throughout the world.','images/produces/avacado.jpg')";

$exec_avacado = mysqli_query($conn, $insert_avacado);


// customer sql scripts
$sql_customer = 'CREATE TABLE IF NOT EXISTS CUSTOMER(
    userID int(6) auto_increment primary key, 
    firstname varchar(7), 
    lastname varchar(30), 
    phoneNo varchar(12), 
    email varchar(40), 
    c_address varchar(30), 
    username varchar(25), 
    password varchar(100)
)';

$exec_client = mysqli_query( $conn, $sql_customer); 
if($exec_client){
    echo 'successul';
}
else{
    echo 'error'.mysqli_error($conn);
}

 if(!$exec_iProduce  and !$exec_tomatoes and !$exec_green and !$insert_water and !$insert_pepers and  !$insert_avacado  and   !mysqli_query($conn, $create_produce) and !$exec_client ){
     echo 'error'.mysqli_error($conn);
 }
 else{
     // echo 'successful'.mysqli_error($conn);
      header('Location:main.php');
      exit;
 }


//check connection
if(!$conn){
    echo 'error'.mysqli_error($conn);
}


mysqli_select_db($conn, $database);


?>

