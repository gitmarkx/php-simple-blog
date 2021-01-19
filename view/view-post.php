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
                    <p class="nav-link" href="#">Welcome: <a href="view-post.php"><?php echo $_SESSION['username'] ?></a></p>
                    <form action="<?php $_SELF_PHP ?>" method="POST" class="nav-link">
                        <input type="submit" value="logout" name="btnLogout">
                    </form>
                </div>
            </nav>


            <form action="<?php $_SELF_PHP ?>" method="POST" class="nav-link">

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