<?php

$servername = "localhost";
$username = "root";
$password = "";
$databse = "online_exams";

$con = new mysqli($servername, $username, $password, $databse);

if ($con->connect_error) {
    die("connection failed: " . $con->connect_error);
}