<?php 
    session_start();

    include("config.php");

    $_SESSION["name"] = $_POST["name"];
    $_SESSION["password"] = $_POST["password"];

    // creating connection
    $conn = mysqli_connect($server,$username,$pass);
    if(!$conn) {
        echo "Error while connecting : ",mysqli_error($conn);
        exit();
    }

    // creating database
    $sql1 = "CREATE DATABASE IF NOT EXISTS weatherDB";
    if(!mysqli_query($conn,$sql1)) {
        echo "Error while creating database : ",mysqli_error($conn);
        exit();
    }

    mysqli_close($conn);

    $db = "weatherDB";
    $conn = mysqli_connect($server,$username,$pass,$db);

    // creating table
    $sql2 = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
        name VARCHAR(50) NOT NULL,
        password VARCHAR(50) NOT NULL
    )";
    if(!mysqli_query($conn,$sql2)) {
        echo "Error while creating table : ",mysqli_error($conn);
        exit();
    }

    // inserting values 
    $sql3 = "INSERT INTO users (name,password) VALUES('".$_POST["name"]."','".$_POST["password"]."')";
    if(!mysqli_query($conn,$sql3)) {
        echo "Error while inserting values : ",mysqli_error($conn);
        exit();
    }

    include("app.html");
    
    mysqli_close($conn);
?>