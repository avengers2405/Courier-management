<?php

session_start();
if(isset($_SESSION['uid'])){
    echo "";
    }else{
    header('location: ../index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <style>
        body
        {
        background-image:url('../images/1920_1080.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        }
    </style>
</head>
<body>
    <?php include('header.php'); ?>
    <div align='center' style="font-weight: bold;font-family:'Times New Roman', Times, serif"><br><br><br><br>
        <h2>This is STORMBREAKER Courier Management Service</h2>
        <h4>The fastest courier service of India</h4><br><br>
        <h3>DBMS MINI PROJECT</h3><br>
        <h6>By:</h6><br>
        <h6>23201 Aditya Uttarwar</h6>
        <h6>23202 Yuvraj Aher</h6>
        <h6>23203 Tanaya Akkalkote</h6>
        <h6>23204 Akshit Mishra</h6>
    </div>
</body>
</html>