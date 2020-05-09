<?php
session_start();

if (isset($_SESSION['isLogged'])) {
    if ($_SESSION['usertype'] != 1){
        header("location: index.php");
    }
} else {
    header("location: ./auth/index.php");
}

require_once('./layouts/header.php');
require_once('./db/connection.php');
$query = "SELECT * FROM students";
$result = mysqli_query($con, $query);

?>

<h1 class="text-center">Students Data</h1>

<div class="container" style="margin-top:30px">
    <div class="row float-right">
        <div class="col-md-8">
            <a href="./addStudent.php"><button class="btn btn-success" style="margin-bottom:10px">Add New</button></a>
        </div>
        <div class="col-md-4">
            <a href="./auth/logout.php"><button class="btn btn-info" style="margin-bottom:10px">Logout</button></a>
        </div>
    </div>
    <table class="table table-dark">
    <thead>
        <tr>
        <th scope="col">ID</th>
        <th scope="col">First Name</th>
        <th scope="col">Last Name</th>
        <th scope="col">Username</th>
        <th scope="col">Web Programming</th>
        <th scope="col">Java Programming</th>
        <th scope="col">Mobile App Development</th>
        <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = mysqli_fetch_assoc($result)){
            echo "<tr>
                <th scope='row'>".$row['id']."</th>
                <td>".$row['first_name']."</td>
                <td>".$row['last_name']."</td>
                <td>".$row['username']."</td>
                <td>".$row['subject1']."</td>
                <td>".$row['subject2']."</td>
                <td>".$row['subject3']."</td>
                <td><row>
                    <a href='editStudent.php?id=".$row['id']."'><button>edit</button></a>
                    <a href='deleteStudent.php?id=".$row['id']."'><button>delete</button></a>
                </row></td>
            </tr>";
        }
        ?>
    </tbody>
    </table>
</div>

<?php require_once('./layouts/footer.php');