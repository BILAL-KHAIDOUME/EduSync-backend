<?php
session_start();
include("database.php");

$email = $_POST['email'];
$password = $_POST['password'];

$_SESSION['email'] = $email;


if(empty($email) || empty($password)) {
    header("Location: ../public/login.php?error=empty");
    exit();
}

if(!filter_var($email , FILTER_VALIDATE_EMAIL)) {
    header("Location: ../public/login.php?error=empty");
    exit();
}

if(isset($_POST['login'])){
    header("Location: ../public/dashboard.php");
}

$sql = "SELECT email , password 
FROM users
";

$result = mysqli_query($conn , $sql);

while($row = mysqli_fetch_assoc($result)) {
    if ($row['email'] == $email && $row['password'] == $password) {
        header("Location: ../public/dashboard.php");
        exit();
    }else{
        header("Location: ../public/login.php");
    }
}

mysqli_close($conn);
?>