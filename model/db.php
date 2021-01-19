<?php
session_start();
date_default_timezone_set('Asia/Manila');

function db()
{
    return new PDO("mysql:host=localhost;dbname=blog", "root", "");
}

// LOGIN MODEL
function login($username, $password)
{
    $db = db();
    $sql = "SELECT * FROM user WHERE username = ? && password = ?";
    $cmd = $db->prepare($sql);
    $cmd->execute(array($username, $password));
    $row = $cmd->fetch();
    $count = $cmd->rowCount();

    if ($count >= 1) {
        $page_flag = true;
        $_SESSION["id"] = $row['id'];
        $_SESSION["username"] = $username;
    } else {
        $page_flag = false;
    }

    $db = null;
    return $page_flag;
}
// LOGIN MODEL

// USER MODEL
// create user
function create_user($fname, $lname, $age, $username, $password)
{
    $db = db();
    $sql = "INSERT INTO user (fname, lname, age, username, password) VALUES (?,?,?,?,?)";
    $cmd = $db->prepare($sql);
    $cmd->execute(array($fname, $lname, $age, $username, $password));
    $db = null;

    return "Successfully Added";
}
// USER MODEL


//POST MODEL
function add_post($data)
{
    $db = db();
    $sql = "INSERT INTO post (userid, content, date) VALUES (?, ?, ?)";
    $cmd = $db->prepare($sql);
    $cmd->execute($data);
    $db = null;

    return "Successfully added post";
}

// DISPLAY ALL POST 
function display_post()
{
    $db = db();
    $sql = "SELECT post.postid,	post.content, post.date, user.fname, user.lname FROM post INNER JOIN user ON post.userid = user.id ORDER BY post.date DESC";
    $cmd = $db->prepare($sql);
    $cmd->execute();
    $row = $cmd->fetchAll();
    $db = null;

    return $row;
}

// DISPLAY ALL COMMENT{
function display_comment($postid)
{
    $data = array($postid);
    $db = db();
    $sql = "SELECT user.fname, post_comment.comment, post_comment.date FROM post_comment INNER JOIN user ON post_comment.userid = user.id WHERE post_comment.postid = ?";
    $cmd = $db->prepare($sql);
    $cmd->execute($data);
    $row = $cmd->fetchAll();
    $db = null;

    return $row;
}

// DISPLAY ALL LIKE{
function display_like($postid)
{
    $data = array($postid);
    $db = db();
    $sql = "SELECT post_reaction.postid FROM post_reaction WHERE post_reaction.postid = ? ";
    $cmd = $db->prepare($sql);
    $cmd->execute($data);
    $row = $cmd->fetchAll();
    $db = null;

    return $row;
}

function display_like_by_user($postid)
{
    $data = array($postid, $_SESSION['id']);
    $db = db();
    $sql = "SELECT post_reaction.postid FROM post_reaction WHERE post_reaction.postid = ? and post_reaction.userid = ?";
    $cmd = $db->prepare($sql);
    $cmd->execute($data);
    $row = $cmd->fetchAll();
    $db = null;

    return $row;
}

// ADD COMMENT
function add_comment($data)
{
    $db = db();
    $sql = "INSERT INTO post_comment (postid, userid, comment, date) VALUES (?, ?, ?, ?)";
    $cmd = $db->prepare($sql);
    $cmd->execute($data);
    $db = null;

    return "Successfully added post";
}

function add_reaction($data)
{
    $userid = $_SESSION['id'];
    $postid = $data[0];
    $deletedata = array($postid, $userid);

    $db = db();
    $sql = "SELECT post_reaction.postid FROM post_reaction WHERE post_reaction.postid = ? and post_reaction.userid = ?";
    $cmd = $db->prepare($sql);
    $cmd->execute($deletedata);
    $row = $cmd->fetchall();
    if (count($row) == 1) {
        $sql = "DELETE FROM post_reaction WHERE postid = ? and userid = ?";
        $cmd = $db->prepare($sql);
        $cmd->execute($deletedata);
    } else {
        $sql = "INSERT INTO post_reaction (postid, userid, reaction, date) VALUES (?, ?, ?, ?)";
        $cmd = $db->prepare($sql);
        $cmd->execute($data);
    }
    $db = null;

    return "Successfully added post";
}
//POST MODEL
