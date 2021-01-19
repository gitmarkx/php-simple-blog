<?php
require('../controller/post-server.php');
if ($_SESSION) {
?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Bootstrap Example</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/css/style.css">

        <style>
            .btnLike .fa-thumbs-up:before {
                content: "\f164";
                color: #636A72;
            }

            .btnLike.open .fa-thumbs-up:before {
                content: "\f164";
                color: blue;
            }

            .btnLike.open {
                color: blue;
                font-weight: 700;
            }
        </style>
    </head>

    <body>

        <div class="cust-container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
                <a class="navbar-brand" href="#">Home</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <!-- <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a> -->
                        </li>
                    </ul>
                    <p class="nav-link" href="#" style="margin: .5rem 0;">Welcome: <a href="view-post.php"><?php echo $_SESSION['username'] ?></a></p>
                    <form action="<?php $_SELF_PHP ?>" method="POST" class="nav-link">
                        <button class="btn" type="submit" value="logout" name="btnLogout"><i class="fas fa-sign-out-alt"></i></button>
                    </form>
                </div>
            </nav>

            <?php if (!empty($mes)) { ?>
                <h2><?php echo $mes; ?></h2>
            <?php } ?>
            <a href="add-post.php" class="btn btn-primary" data-toggle="collapse" data-target="#newpostcont"> New Post</a><br><br>
            <div class="collapse" id="newpostcont">
                <form action="<?php $_SELF_PHP ?>" method="POST">
                    <div class="form-group">
                        <!-- <label for="">Content</label> -->
                        <textarea class="form-control" placeholder="What's on your mind, <?php echo $_SESSION['username'] ?> ? " name="content" cols="30" rows="5"></textarea>
                        <?php if (!empty($error)) { ?>
                            <p style="color: red;"><?php echo $error; ?></p>
                        <?php } ?>
                    </div>
                    <input type="submit" class="btn btn-primary btn-block" value="Submit" name="btnSavePost">
                    <!-- <a href="user.php">Go to list</a> -->
                </form>
            </div>
            <hr>
            <?php foreach (display_post() as $post) {
                $postid =  $post['postid'];
            ?>
                <div class="card mb-5">
                    <div class="card-body">
                        <p style="margin: 0;"><b><?php echo $post['fname'] . " " . $post['lname'] ?></b></p>
                        <p style="margin: 0; font-size: 13px; color: #65676b;">
                            <?php
                            $postdate = date_format(new DateTime($post['date']), 'F j, Y');
                            // CHECK IF EXCEED 24 HOURS
                            $postolddate = strtotime(date($post['date']));
                            $currentdate = strtotime(date('Y-m-d H:i:s'));
                            $timediff = $currentdate - $postolddate;
                            // CHECK IF EXCEED 1 HOUR
                            $hour1 = 0;
                            $hour2 = 0;
                            $date1 = $post['date'];
                            $date2 = date('Y-m-d H:i:s');
                            $datetimeObj1 = new DateTime($date1);
                            $datetimeObj2 = new DateTime($date2);
                            $interval = $datetimeObj1->diff($datetimeObj2);
                            if ($timediff >= 86400) {
                                echo $postdate;
                            } else {
                                if ($interval->format('%h') == 0) {
                                    $hour2 = $interval->format('%i');
                                    echo $hour2 . "m";
                                } else {
                                    $hour2 = $interval->format('%h');
                                    echo $hour2 . "h";
                                }
                            }
                            ?>
                        </p>
                        <br>
                        <p><?php echo $post['content'] ?></p>

                        <div class="d-flex">
                            <div class="flex-fill">
                                <p style="text-align: left; margin: 0;">
                                    <a data-toggle="modal" data-target="#LikeModal" type="button" class="like<?php echo $post['postid'] ?> btnShowLike">
                                        <?php
                                        $countlike = count(display_like($postid));
                                        if ($countlike > 0) {
                                            echo '<i class="fas fa-thumbs-up" style="color: white; background-color: blue; padding: 5px; border-radius: 50px; font-size: 10px; position: relative; top: -3px;"></i> ' . $countlike;
                                        }
                                        ?>
                                    </a>
                                </p>
                            </div>
                            <div class="flex-fill">
                                <p style="text-align: right; margin: 0;">
                                    <a type="button" class="btntogglecommentcont comment<?php echo $post['postid'] ?>">
                                        <?php
                                        $countcomment = count(display_comment($postid));

                                        $comment1 = $countcomment > 1 ? 'Comments' : 'Comment';
                                        if ($countcomment > 0) {
                                            echo $countcomment . ' ' . $comment1;
                                        }
                                        ?>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body d-flex" style="padding: .5rem 1.25rem;">
                        <div class="flex-fill">
                            <form action="<?php $_SELF_PHP ?>" method="POST">
                                <button class="btnLike btn btn-default btn-block <?php echo $liketrue = (count(display_like_by_user($postid)) == 1) ? 'open' : ''; ?>" type="button" value="<?php echo $post['postid'] ?>" type="submit"><i class=" far fa-thumbs-up"></i> Like</button>
                            </form>
                        </div>
                        <div class="flex-fill">
                            <button class="btntogglecommentcont btn btn-default btn-block"><i class="far fa-comment-alt"></i> Comment</button>
                        </div>
                    </div>
                    <div class="card-footer commentpanel" id="">
                        <div class="<?php echo $post['postid'] ?>">
                            <?php

                            foreach (display_comment($postid) as $comment) { ?>
                                <p>
                                    <b><?php echo $comment['fname'] ?></b> <br>
                                    <span><?php echo $comment['comment'] ?></span>
                                </p>
                                <hr>
                            <?php } ?>
                        </div>
                        <form action="<?php $_SELF_PHP ?>" method="POST" id="commentform">
                            <div class="input-group">
                                <input type="text" class="form-control inputcomment" name="inputcomment" placeholder="Write your comment...">
                                <div class="input-group-append">
                                    <input style="background-color: white; border-top: 1px solid #ced4da; border-right: 1px solid #ced4da; border-bottom: 1px solid #ced4da; color: transparent;" class="btn btnPostcomment" type="submit" name="btnPostcomment" value="<?php echo $post['postid'] ?>" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php } ?>
        </div>


        <!-- The Modal -->
        <div class="modal" id="LikeModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <p class="modal-title">
                            <i class="fas fa-thumbs-up" style="color: white; background-color: blue; padding: 5px; border-radius: 50px; font-size: 10px; position: relative; top: -3px;"></i>
                            <span></span>
                        </p>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        Modal body..
                    </div>
                </div>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <script>
            $(document).on("click", ".btnPostcomment", function(e) {
                event.preventDefault();
                var tr = $(this).closest('.input-group');
                var comment = tr.find('.inputcomment').val();
                var postid = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "../controller/post-server.php",
                    data: {
                        postid: postid,
                        comment: comment
                    },
                    success: function(data) {
                        $('.' + postid).load('../controller/post-server.php', {
                            'refreshcommentid': postid
                        });
                        $('.comment' + postid).load('../controller/post-server.php', {
                            'refreshcommentcount': postid
                        });
                        tr.find('.inputcomment').val('');
                        // $('.comment_content').load('../controller/comment.php');
                    }
                    // ,
                    // error: function(ts) {
                    //     alert(ts.responseText)
                    // }
                });
            });

            $(document).on("click", ".btntogglecommentcont", function(e) {
                // // data-toggle="collapse" data-target=".commentpanel"
                var cardcont = $(this).closest('.card');
                // // var cardfooter = tr.find('.card-footer').val();
                // $(this).data('target', $('.commentpanel'));
                $(cardcont.find('.card-footer')).collapse('toggle');
            });

            $(document).on('click', '.btnLike', function() {
                event.preventDefault();
                $(this).toggleClass('open');
                var postid = $(this).val();

                $.ajax({
                    type: "POST",
                    url: "../controller/post-server.php",
                    data: {
                        likepostid: postid
                    },
                    success: function(data) {
                        $('.like' + postid).load('../controller/post-server.php', {
                            'refreshlikeid': postid
                        });
                    }
                    // ,
                    // error: function(ts) {
                    //     alert(ts.responseText)
                    // }
                });
            });

            $(document).on('click', '.btnShowLike', function() {
                // alert($(this).attr('class').split(' ')[0]);
                var totalike = $(this).text();
                $('.modal-title span').text(totalike);
            });
        </script>
    </body>

    </html>

<?php
} else {
    header("location: ../index.php?Please_login");
} ?>