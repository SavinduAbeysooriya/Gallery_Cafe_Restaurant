<?php
//login

function emptyInputLogin($email, $pwd) {
    return empty($email) || empty($pwd);
}


function LoginUser($conn, $email, $pwd){
    $userExists = emailExists($conn, $email);
    if ($userExists===false) {
        header("Location:../admin/loginstaff.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $userExists['UsersPwd'];
    $checkpwd = password_verify($pwd, $pwdHashed);

    if ($checkpwd===false) {
        header('Location:../admin/loginstaff.php?error=wronglogin');
        exit();
    } else {
        session_start();
        $_SESSION['useremail'] = $userExists['UsersEmail'];
        $_SESSION['password'] = $userExists['UsersPwd'];
        header("Location: ../admin/orderdetailsstaff.php");
        exit();
    }
}

function emailExists($conn, $email) {
    $sql = "SELECT * FROM usersstaff WHERE UsersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../admin/loginstaff.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row; // User found
    } else {
        return false; // No user found
    }
 
}
