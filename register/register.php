<?php
include_once("../connection.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstname = $_POST['firstname'];
    $middlename =  $_POST['middlename'];
    $lastname =  $_POST['lastname'];
    $birthday =  $_POST['birthday'];
    $username =  $_POST['username'];
    $password =  $_POST['password'];

    $hashedPassword = md5($password);
    $existsql = "SELECT username FROM `user_account` WHERE username = '$username'";
    $checkUser = mysqli_query($con, $existsql);
    if (mysqli_num_rows($checkUser) === 1) {
        session_start();
        $_SESSION['already_exists'] = 'Username already exists';
        header('Location:index.php');
    } else {
        $insert = "INSERT INTO `user_account`(`firstname`, `middlename`, `lastname`, `birthday`, `username`, `password`)
                VALUES ('$firstname','$middlename','$lastname','$birthday','$username','$hashedPassword')";
        if ($con->query($insert) === TRUE) {
            $sql = "SELECT * from `user_account` where user_id =(SELECT LAST_INSERT_ID());";
            $result = $con->query($sql);
            while ($row = $result->fetch_assoc()) {
                session_start();
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['firstname'] = $row['firstname'];
                header("Location:../index.php");
            }
        }
    }
}
