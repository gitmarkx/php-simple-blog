<?php
require('controller/index-server.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="view/assets/css/style.css">
</head>

<body>

    <div class="cust-container">
        <?php if (!empty($error)) { ?>
            <h2 class="display_message"><?php echo $error; ?></h2>
        <?php } ?>
        <?php if (!empty($mes)) { ?>
            <h2 class="display_message"><?php echo $mes; ?></h2>
        <?php } ?>
        <form action="" method="POST">
            <div class="form-group">
                <label for="">Username</label>
                <input type="text" class="form-control" placeholder="Enter username" id="username" name="username">

            </div>
            <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" placeholder="Enter password" id="password" name="password">
            </div>
            <input type="submit" class="btn btn-primary btn-block" name="btnLogin" value="Login">
        </form>
        <hr>
        <a type="button" data-toggle="collapse" data-target="#createaccount" style="color: #0056b3;">Create account</a>
        <div id="createaccount" class="collapse">
            <div class="p-5">
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
                    <input type="submit" class="btn btn-primary btn-block" value="Sign Up" name="btnSaveUser">
                </form>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        setTimeout(function() {
            $('.display_message').fadeOut('fast');
        }, 3000); // <-- time in milliseconds
    </script>

</body>

</html>