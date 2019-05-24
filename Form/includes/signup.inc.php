<?php
if (isset($_POST['signup-submit'])) {
    require 'dbh.inc.php';
    $username = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = _POST['pass'];
    $passwordRepeat = _POST['re_pass'];


    if (empty($username) || empty($email) || empty($phone) || empty($address) || empty($password) || empty($passwordRepeat)) {
        header("Location: ../signup.php?error=emptyfields&name=" . $username . "&email=" . $email . "&phone=" . $phone . "&address=" . $address);
        exit();
    } 
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error=invalidusername&email&phone=" . $phone . "&address=" . $address);
        exit();
    } 
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?error=invalidemails&name=" . $username . "&phone=" . $phone . "&address=" . $address);
        exit();
    } 
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error=invalidusername&email=" . $email . "&phone=" . $phone . "&address=" . $address);
        exit();
    } 
    else if ($password !== $passwordRepeat) {
        header("Location: ../signup.php?error=passwordcheck&name=" . $username . "&email=" . $email . "&phone=" . $phone . "&address=" . $address);
        exit();
    } 
    else {
        $sql = "INSERT INTO users(name, phone, address, password, email) VALUES (?, ?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../signup.php?error=sqlerror");
            exit();
        } else {
            $hashedpwd = md5($password);
            mysqli_stmt_bind_param($stmt, "sssss", $username, $phone, $address, $hashedpwd, $email);
            mysqli_stmt_execute($stmt);
            header("Location: ../signup.php?signup=success");
            exit();
        }
    }
}

else {
    header("Location: ../signup.php?signup=success");
    exit();
}
