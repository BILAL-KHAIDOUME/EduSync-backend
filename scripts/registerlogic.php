<?php
include("database.php");


$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_confirmation = $_POST['password_confirmation'];
$signup_btn = $_POST['signup'];

if (empty($name) || empty($email) || empty($password) || empty($password_confirmation)){
    header("Location: ../public/register.php?error=empty");
    exit();
}

if(!filter_var($email , FILTER_VALIDATE_EMAIL)) {
    header("Location: ../public/register.php?error=empty");
}

if(isset($signup_btn)){
    header("Location: ../public/login.php");
}

$sql = "INSERT INTO users (firstname , email , password)
VALUES (? , ? , ?  )";


$stmt = mysqli_prepare($conn , $sql);

mysqli_stmt_bind_param($stmt , "sss" , $name , $email , $password) ;

mysqli_stmt_execute($stmt);


mysqli_stmt_close($stmt);
mysqli_close($conn);


?>




