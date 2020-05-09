<?php
session_start();

if (isset($_SESSION['isLogged'])) {
    if ($_SESSION['isLogged'] != 1){
        header("location: ../index.php");
    }
} else {
    header("location: ../auth/index.php");
}

require_once('./layouts/header.php');
require_once('./db/connection.php');

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
    $subject1 = $_POST['subject1'];
    $subject2 = $_POST['subject2'];
    $subject3 = $_POST['subject3'];
    $hashaedPassword = md5($password);

    $query = "INSERT INTO students(first_name, last_name, username, subject1, subject2, subject3) 
    VALUES ('$first_name', '$last_name', '$username', '$subject1', '$subject2', '$subject3')";
    
    $userQuery = "INSERT INTO users(username, password, type) VALUES('$username', '$hashaedPassword', 0)";

    echo($query);
    echo($userQuery);
    
    $userResult = mysqli_query($con, $userQuery);
    $result = mysqli_query($con, $query);
    
    if($result && $userResult){
        header("location: ./admin.php");
    }

}

?>

<h1 class="text-center">Students Data</h1>

<div class="container" style="margin-top:30px">
<form method="POST" action="">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">User Name</label>
      <input type="text" class="form-control" id="inputEmail4" name="username" placeholder="User Name">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Password</label>
      <input type="password" class="form-control" id="inputPassword4" name="password" placeholder="Password">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">First Name</label>
      <input type="text" class="form-control" id="inputEmail5" name="firstname" placeholder="First Name">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Last Name</label>
      <input type="text" class="form-control" id="inputPassword5" name="lastname" placeholder="Last Name">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="inputCity">Web Programming</label>
      <input type="number" name="subject1" class="form-control" id="inputCity">
    </div>
    <div class="form-group col-md-4">
      <label for="inputState"> Java Programming</label>
      <input type="number" name="subject2" class="form-control" id="inputState">
    </div>
    <div class="form-group col-md-4">
      <label for="inputZip"> Mobile App Development</label>
      <input type="number" name="subject3" class="form-control" id="inputZip">
    </div>
  </div>
  <button type="submit" class="btn btn-primary" name="submit">Save</button>
</form>
</div>

<?php require_once('./layouts/footer.php');