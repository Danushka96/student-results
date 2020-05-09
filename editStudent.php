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

$studentId = $_GET['id'];

$selectQuery = "SELECT * FROM students WHERE id=$studentId";
$selectResult = mysqli_query($con, $selectQuery);
$studentData = mysqli_fetch_assoc($selectResult);

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
    $subject1 = $_POST['subject1'];
    $subject2 = $_POST['subject2'];
    $subject3 = $_POST['subject3'];
    $hashaedPassword = md5($password);

    $query = "UPDATE students SET first_name = '$first_name', last_name = '$last_name', subject1 = '$subject1', 
    subject2 = '$subject2', subject3 = '$subject3' WHERE id='$studentId'";
    
    echo($query);
    
    $result = mysqli_query($con, $query);
    
    if($result){
        header("location: ./admin.php");
    }

}

?>

<h1 class="text-center">Students Data</h1>

<div class="container" style="margin-top:30px">
<form method="POST" action="">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">First Name</label>
      <input type="text" class="form-control" id="inputEmail5" name="firstname" placeholder="First Name" value="<?php echo htmlspecialchars($studentData['first_name'])?>">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Last Name</label>
      <input type="text" class="form-control" id="inputPassword5" name="lastname" placeholder="Last Name" value="<?php echo htmlspecialchars($studentData['last_name'])?>">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="inputCity">Web Programming</label>
      <input type="number" name="subject1" class="form-control" id="inputCity" value="<?php echo htmlspecialchars($studentData['subject1'])?>">
    </div>
    <div class="form-group col-md-4">
      <label for="inputState"> Java Programming</label>
      <input type="number" name="subject2" class="form-control" id="inputState" value="<?php echo htmlspecialchars($studentData['subject2'])?>">
    </div>
    <div class="form-group col-md-4">
      <label for="inputZip"> Mobile App Development</label>
      <input type="number" name="subject3" class="form-control" id="inputZip" value="<?php echo htmlspecialchars($studentData['subject3'])?>">
    </div>
  </div>
  <button type="submit" class="btn btn-primary" name="submit">Update</button>
</form>
</div>

<?php require_once('./layouts/footer.php');