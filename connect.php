<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'BibiFarm';


$conn = new mysqli($servername, $username, $password);
// sql script to create database
$create_database = "CREATE DATABASE IF NOT EXISTS ".$database;

//execution of the database script
$exec_database = mysqli_query($conn, $create_database);


//check connection
if(!$conn){
    echo 'error'.mysqli_error($conn);
}


mysqli_select_db($conn, $database);


?>

