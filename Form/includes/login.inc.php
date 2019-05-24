<?php
if (isset($_POST['login-submit'])) {
    require 'dbh.inc.php';
    $email = $_POST['your_email'];
    $password = $_POST['your_pass'];

    if (empty($email) || empty($password)) {
        header("Location: ../index.php?error=emptyfields&email=" . $email);
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../index.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                $pwdCheck = md5($password);
                if ($pwdCheck == $row['password']) {
                    header("Location: ../index.php?error=wrongpwd");
                    exit();
                } else if($pwdCheck == true){
                    session_start();
                    $_SESSION['userId'] = $row['id'];
                    $_SESSION['userUid'] = $row['name'];
                    header("Location: ../index.php?login=success");
                    exit();
                }
                else {
                    header("Location: ../index.php?error=sqlerror");
                    exit();
                }
            } else {
                header("Location: ../index.php?error=nouser");
            }
        }
    }
} else {
    header("Location: ../index.php");
    exit();
}
