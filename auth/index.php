<?php
session_start();

if(isset($_SESSION['isLogged'])){
    if($_SESSION['usertype'] == 1){
        header("location: ../admin.php");
    } else {
        header("location: ../index.php");
    }
}

require('../layouts/header.php');
require_once('../db/connection.php');

if (isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $passwordhashed = md5($password);
    $query = "SELECT type FROM users WHERE username='$username' && password='$passwordhashed'";
    $result = mysqli_query($con, $query);
    if ($rows = mysqli_num_rows($result) == 1){
        $user = mysqli_fetch_assoc($result);
        $_SESSION['isLogged'] = true;
        $_SESSION['usertype'] = $user['type'];
        $_SESSION['username'] = $username;
        header("location: ../index.php");
    } else {
        echo '<script language="javascript">';
        echo 'alert("Username or Password Invalid")';
        echo '</script>';
    }
    
}

?>

<div class="container" style="margin-top:50px">
    <div class="row d-flex justify-content-center mx-auto">
        <div class="col-md-6 col-xs-12 div-style">
            <form method="POST" action="">
                <div class="d-flex justify-content-center mx-auto main-label" >
                    <h2>Login</h2>
                </div>
                <div class="form-group">
                    <input type="text" name="username" class="form-control text-box" id="username" aria-describedby="username" placeholder="Enter username">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control text-box" id="password" placeholder="Password">
                </div>
                <div class="form-group justify-content-center d-flex">
                    <button type="submit" class="btn btn-primary button-submit" name="submit">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require('../layouts/footer.php'); ?>