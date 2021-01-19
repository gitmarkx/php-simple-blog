<?php
require('../model/db.php');

if (isset($_POST['btnLogout'])) {
    $_SESSION["id"] = "";
    $_SESSION["username"] = "";
    session_destroy();
    header("Location: ../index.php");
}




if (isset($_POST['btnUpdateUser'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $age = $_POST['age'];
    $id = $_POST['id'];

    if (empty($fname) || empty($lname) || empty($age)) {
        $error = "Required!";
    } else {
        $mes = update($fname, $lname, $age, $id);
    }
}

if (isset($_POST['btnDeleteUser'])) {
    $id = $_POST['id'];
    $mes = delete($id);
}




// update user
function update($fname, $lname,  $age, $id)
{
    $db = db();
    $sql = "UPDATE user set fname=?, lname=?, age=? WHERE id=? ";
    $cmd = $db->prepare($sql);
    $cmd->execute(array($fname, $lname, $age, $id));
    $db = null;

    return "Successfully Updated";
}

// update user
function delete($id)
{
    $db = db();
    $sql = "DELETE FROM user WHERE id = ?";
    $cmd = $db->prepare($sql);
    $cmd->execute(array($id));
    $db = null;

    return "Successfully Deleted";
}

// display all user
function displayuser()
{
    $db = db();
    $sql = "SELECT * FROM user ORDER BY id DESC";
    $cmd = $db->prepare($sql);
    $cmd->execute();
    $row = $cmd->fetchAll();
    $db = null;

    return $row;
}
