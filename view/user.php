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

        <form action="<?php $_SELF_PHP ?>" method="POST">
            <input type="submit" value="logout" name="btnLogout">
        </form>


        <div class="cust-container">
            <?php if (!empty($mes)) { ?>
                <h2><?php echo $mes; ?></h2>
            <?php } ?>
            <a href="add-user.php" class="btn btn-primary">Add</a>
            <hr>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Age</th>
                        <th>Username</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (displayuser() as $user) { ?>
                        <tr>
                            <td><?php echo $user['id'] ?></td>
                            <td><?php echo $user['fname'] ?></td>
                            <td><?php echo $user['lname'] ?></td>
                            <td><?php echo $user['age'] ?></td>
                            <td><?php echo $user['username'] ?></td>
                            <td>
                                <button class="btn btn-info" id="btnEdit" data-toggle="modal" data-target="#updatemodal">Update</button>
                                <button class="btn btn-danger" id="btnDelete" data-toggle="modal" data-target="#deletemodal">Delete</button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- Update Modal -->
        <div class="modal" id="updatemodal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Update Data</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="<?php $_SELF_PHP ?>" method="POST">
                            <input class="form-control" type="text" placeholder="Firstname" name="id" id="id">
                            <div class="form-group">
                                <label for="email">Firstname</label>
                                <input class="form-control" placeholder="Firstname" name="fname" id="fname">
                            </div>
                            <div class="form-group">
                                <label for="email">Lastname</label>
                                <input class="form-control" placeholder="Lastname" name="lname" id="lname">
                            </div>
                            <div class="form-group">
                                <label for="email">Age</label>
                                <input class="form-control" placeholder="Age" name="age" id="age">
                            </div>
                            <input type="submit" class="btn btn-primary btn-block" value="Update" name="btnUpdateUser">
                        </form>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <div class="modal" id="deletemodal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Update Data</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="<?php $_SELF_PHP ?>" method="POST">
                            <input class="form-control" type="hidden" placeholder="Firstname" name="id" id="iddelete">
                            <p>Do you want to delete this user? <b><span id="userName"></span></b></p>
                            <input type="submit" class="btn btn-primary btn-block" value="Delete" name="btnDeleteUser">
                        </form>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <script>
            $(document).on('click', '#btnEdit', function() {
                var tr = $(this).closest('tr');
                var id = tr.find('td:eq(0)').text();
                var fname = tr.find('td:eq(1)').text();
                var lname = tr.find('td:eq(2)').text();
                var age = tr.find('td:eq(3)').text();

                $('#id').val(id);
                $('#fname').val(fname);
                $('#lname').val(lname);
                $('#age').val(age);
            });

            $(document).on('click', '#btnDelete', function() {
                var tr = $(this).closest('tr');
                var id = tr.find('td:eq(0)').text();
                var fname = tr.find('td:eq(1)').text();
                var lname = tr.find('td:eq(2)').text();
                var age = tr.find('td:eq(3)').text();

                $('#iddelete').val(id);
                $('#userName').text(fname + ' ' + lname);
            });
        </script>

    </body>

    </html>

<?php
} else {
    header("location: ../index.php?Please_login");
} ?>