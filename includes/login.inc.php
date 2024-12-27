<?php
if (isset($_POST["submit"])) {
    $email = trim($_POST["email"]);
    $pwd = trim($_POST["password"]);

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputLogin($email, $pwd)!==false) {
        header("Location: ../login.php?error=emptyinput");
        exit();
    }


    loginUser($conn, $email, $pwd);
} else {
    header('Location: ../login.php');
    exit();
}

if (isset($_GET['error'])) {
    if ($_GET['error'] == "emptyinput") {
        echo '<p class="error-msg" style="color:red;text-align:center;">Please fill in all fields.</p>';
    } elseif ($_GET['error'] == "wronglogin") {
        echo '<p class="error-msg" style="color:red;text-align:center;">Invalid login credentials. Please try again.</p>';
    }
}
