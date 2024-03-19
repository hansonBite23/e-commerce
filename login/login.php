<?php
include_once("../connection.php");
session_start();
$username =  mysqli_escape_string($con, $_POST['username']);
$password =  mysqli_escape_string($con, $_POST['password']);
$action = $_POST['action'];
$hashedPassword = md5($password);

if (empty($username)) {
    session_start();
    $_SESSION['emptyFieldUsername'] = "Username must require";
    header("Location:index.php");
}
if (empty($password)) {
    session_start();
    $_SESSION['emptyFieldPassword'] = "Password must require";
    header("Location:index.php");
} else {
    $sql = "SELECT * FROM `user_account` WHERE username = '$username' AND password = '$hashedPassword'";
    $query = mysqli_query($con, $sql);
    if (mysqli_num_rows($query) === 1) {
        if ($action === 'goToCart') {
            session_start();
            $row = mysqli_fetch_assoc($query);
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['firstname'] = $row['firstname'];
            header("Location:../cart/");
        } else {
            session_start();
            $row = mysqli_fetch_assoc($query);
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['firstname'] = $row['firstname'];
            header("Location:../index.php");
        }
    } else {
        $_SESSION['invalid'] = 'Invalid Username or Password';
        header("Location: index.php?error");
    }
}
