<?php
require('../model/db.php');

// LOGOUT
if (isset($_POST['btnLogout'])) {
    $_SESSION["id"] = "";
    $_SESSION["username"] = "";
    session_destroy();
    header("Location: ../index.php");
}

// INSERT NEW POST
if (isset($_POST['btnSavePost'])) {
    $id = $_SESSION['id'];
    $content = $_POST['content'];
    $date = date('Y-m-d H:i:s');
    $data = array($id, $content, $date);

    if (empty($content)) {
        $error = "All fields are required!";
    } else {
        $mes = add_post($data);
        header("Refresh:0");
    }
}

// INSERT COMMENT 
if (isset($_POST['postid'])) {
    $comment = $_POST['comment'];
    $postid = $_POST['postid'];
    $date = date('Y-m-d H:i:s');
    $userid = $_SESSION['id'];
    $data = array($postid, $userid, $comment, $date);
    add_comment($data);
}

// AJAX - REFRESH COMMENT CONTAINER WHEN NEW COMMENT IS SAVE
if (isset($_REQUEST['refreshcommentid'])) {
    $returncommentdata;
    $postid =  $_REQUEST['refreshcommentid'];
    foreach (display_comment($postid) as $comment) {

        $returncommentdata = "<p>";
        $returncommentdata .= "<b>" . $comment['fname'] . "</b> <br>";
        $returncommentdata .= "<span>" . $comment['comment'] . "</span>";
        $returncommentdata .= "</p>";
        $returncommentdata .= "<hr>";

        echo $returncommentdata;
    }
}

// AJAX - REFRESH COMMENT COUNT WHEN NEW COMMENT IS SAVE
if (isset($_REQUEST['refreshcommentcount'])) {
    $postid =  $_REQUEST['refreshcommentcount'];

    $countcomment = count(display_comment($postid));
    $comment1 = $countcomment > 1 ? 'Comments' : 'Comment';
    if ($countcomment > 0) {
        echo $countcomment . ' ' . $comment1;
    }
}

// INSERT LIKE 
if (isset($_POST['likepostid'])) {
    $reaction = "Like";
    $postid = $_POST['likepostid'];
    $date = date('Y-m-d');
    $userid = $_SESSION['id'];
    $data = array($postid, $userid, $reaction, $date);
    add_reaction($data);
}

// AJAX - REFRESH LIKE COUNT WHEN NEW COMMENT IS SAVE
if (isset($_REQUEST['refreshlikeid'])) {
    $returncommentdata;
    $postid =  $_REQUEST['refreshlikeid'];
    $countlike = count(display_like($postid));
    if ($countlike > 0) {
        echo '<i class="fas fa-thumbs-up" style="color: white; background-color: blue; padding: 5px; border-radius: 50px; font-size: 10px; position: relative; top: -3px;"></i> ' . $countlike;
    }
}
 