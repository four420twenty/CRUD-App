<?php

session_start();

include_once 'action.php';

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>CRUD App</title>
</head>
<body>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">CRUD App</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
            </ul>
        </div>
                <form class="d-flex">
                    <input class="form-control me-2" type="text" placeholder="Search">
                    <button class="btn btn-primary" type="button">Search</button>
                </form>
    </div>
</nav>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h3 class="text-center text-dark mt-2">Advanced CRUD App Using PHP & MySQLi Prepared Statement (Object Oriented)</h3>
            <hr>

            <?php if (isset($_SESSION['response'])) { ?>
                <div class="alert text-center alert-<?= $_SESSION['res_type'] ?> alert-dismissible">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <b text-center><?= $_SESSION['response'] ?></b>
                </div>
            <?php
                }
            unset($_SESSION['response']);
            ?>

        </div>
    </div>
    
    <div class="row">
        <div class="col-md-4">

            <h3 class="text-center text-info">Add Record</h3>

            <form action="action.php" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Enter name" required>
                </div>

                <br>

                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Enter e-mail" required>
                </div>

                </br>

                <div class="form-group">
                    <input type="tel" name="phone" class="form-control" placeholder="Enter phone" required>
                </div>

                <br>

                <div class="form-group">
                    <input type="file" name="image" class="custom-file">
                </div>

                <br>

                <div class="form-group">
                    <input type="submit" name="add" class="btn btn-primary btn-block" value="Add Record">
                </div>
            </form>
        </div>
        <div class="col-md-8">

            <?php
                $query = "SELECT * FROM `crud`";
                $stmt = $conn->prepare($query);
                $stmt->execute();
                $result = $stmt->get_result();
            ?>
            <h3 class="text-center text-info">Records Present In The Database</h3>

            <table class="table  table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><img src="<?= $row['photo'] ?>" width="60"></td>
                            <td><?= $row['name'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['phone'] ?></td>
                            <td>
                                <a href="details.php?details=<?= $row['id'] ?>" class="btn btn-primary">Details</a> |
                                <a href="action.php?delete=<?= $row['id'] ?>" class="btn btn-danger">Delete</a> |
                                <a href="index.php?edit=<?= $row['id'] ?>" class="btn btn-success">Edit</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>

            </table>
        </div>
    </div>
</div>

</body>
</html>