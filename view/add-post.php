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

        <link rel="stylesheet" href="assets/css/style.css">
    </head>

    <body>

        <div class="cust-container">
            <?php if (!empty($mes)) { ?>
                <h2><?php echo $mes; ?></h2>
            <?php } ?>
            <form action="<?php $_SELF_PHP ?>" method="POST">
                <div class="form-group">
                    <label for="">Content</label>
                    <textarea class="form-control" placeholder="Content" name="content" cols="30" rows="10"></textarea>
                    <?php if (!empty($error)) { ?>
                        <p style="color: red;"><?php echo $error; ?></p>
                    <?php } ?>
                </div>
                <input type="submit" class="btn btn-primary btn-block" value="Submit" name="btnSavePost">
                <!-- <a href="user.php">Go to list</a> -->
            </form>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    </body>

    </html>

<?php
} else {
    header("location: ../index.php?Please_login");
} ?>