<?php

session_start();

if (isset($_SESSION['isLogged'])) {
    if ($_SESSION['usertype'] != 0){
        header("location: ./admin.php");
    }
} else {
    header("location: ../auth/index.php");
}

require_once('./db/connection.php');

$user = $_SESSION['username'];
$studentQuery = "SELECT * FROM students WHERE username = '$user'";
$resultQuery = mysqli_query($con, $studentQuery);
$result = mysqli_fetch_assoc($resultQuery);

require('./layouts/header.php');
?>

<h1 class="text-center"> Welcome <?php echo($result['first_name']); ?> </h1>
<div class="container" style="margin-top:30px">
<div class="row float-right">
    <div class="col-md-4">
        <a href="./auth/logout.php"><button class="btn btn-info" style="margin-bottom:10px">Logout</button></a>
    </div>
</div>
    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                <div class="card-header">Web Programming</div>
                <div class="card-body">
                    <h5 class="card-title">Marks</h5>
                    <p class="card-text"><?php echo($result['subject1']) ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
                <div class="card-header">Java Programming</div>
                <div class="card-body">
                    <h5 class="card-title">Marks</h5>
                    <p class="card-text"><?php echo($result['subject2']) ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                <div class="card-header">Mobile App Development</div>
                <div class="card-body">
                    <h5 class="card-title">Marks</h5>
                    <p class="card-text"><?php echo($result['subject3']) ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require('./layouts/footer.php');
?>