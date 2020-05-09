<?php
session_start();

if (isset($_SESSION['isLogged'])) {
    if ($_SESSION['isLogged'] != 1){
        header("location: ./index.php");
    }
} else {
    header("location: ./auth/index.php");
}

require_once('./db/connection.php');
if(isset($_GET['id'])){
    $studentId = $_GET['id'];
    $deleteQuery = "DELETE FROM students WHERE id= $studentId";
    $result = mysqli_query($con, $deleteQuery);
    if($result){
        header("location: ./admin.php");
    } else {
        die("delete failed");
    }
}