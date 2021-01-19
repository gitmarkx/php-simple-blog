<?php
require('../controller/user-server.php');
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
                    <label for="">Firstname</label>
                    <input class="form-control" placeholder="Firstname" name="fname">
                    <?php if (!empty($error)) { ?>
                        <p style="color: red;"><?php echo $error; ?></p>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label for="">Lastname</label>
                    <input class="form-control" placeholder="Lastname" name="lname">
                    <?php if (!empty($error)) { ?>
                        <p style="color: red;"><?php echo $error; ?></p>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label for="">Age</label>
                    <input class="form-control" placeholder="Age" name="age">
                    <?php if (!empty($error)) { ?>
                        <p style="color: red;"><?php echo $error; ?></p>
                    <?php } ?>
                </div>
                <hr>
                <div class="form-group">
                    <label for="">Username</label>
                    <input class="form-control" placeholder="Username" name="username">
                    <?php if (!empty($error)) { ?>
                        <p style="color: red;"><?php echo $error; ?></p>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input class="form-control" placeholder="Password" name="password" type="password">
                    <?php if (!empty($error)) { ?>
                        <p style="color: red;"><?php echo $error; ?></p>
                    <?php } ?>
                </div>
                <input type="submit" class="btn btn-primary btn-block" value="Submit" name="btnSaveUser">
                <a href="user.php">Go to list</a>
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