<?php

//registration
function emptyInputSignup($name, $email, $pwd, $pwdRepeat) {
    return empty($name) || empty($email) || empty($pwd) || empty($pwdRepeat);
}
function invalidEmail($email) {
    return !filter_var($email, FILTER_VALIDATE_EMAIL);
}

function pwdMatch($pwd, $pwdRepeat) {
    return $pwd !== $pwdRepeat;
}

function nameExists($conn, $name, $email) {
    $sql = "SELECT * FROM users WHERE UsersName = ? OR UsersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../register.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $name, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row; // Return user data if found
    } else {
        return false; // No user found
    }

}

function nameValid($name) {
    return !preg_match("/^[a-zA-Z\s]*$/", $name); // Allow alphabetic characters and spaces
}

function createUser($conn, $name, $email, $pwd) {
    $sql = "INSERT INTO users (UsersName, UsersEmail, Userspwd) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../register.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: ../login.php?Registration=success");
    exit();
}


