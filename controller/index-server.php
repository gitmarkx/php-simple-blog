<?php
require('model/db.php');

if (isset($_POST['btnLogin'])) {
    $username = $_POST['username'];
    $password = sha1($_POST['password']);

    if (empty($username) || empty($password)) {
        $error = 'Required all fields';
    } else {
        if (login($username, $password)) {
            header("Location: ./view/post.php?id=" . $_SESSION['id'] . "?user=" . $_SESSION['username']);
        } else {
            $error = 'Invalid Credentials';
        }
    }
}

if (isset($_POST['btnLogout'])) {
    $_SESSION["id"] = "";
    $_SESSION["username"] = "";
    session_destroy();
    header("Location: ../index.php");
}

// if (isset($_POST['btnSaveUser'])) {
//     $fname = $_POST['fname'];
//     $lname = $_POST['lname'];
//     $age = $_POST['age'];
//     $username = $_POST['username'];
//     $password = sha1($_POST['password']);

//     if (empty($fname) || empty($lname) || empty($age) || empty($username) || empty($password)) {
//         $error = "Required!";
//     } else {
//         $mes = create_user($fname, $lname, $age, $username, $password);
//     }
// }
