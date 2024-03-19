<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/loginStyle.css">

    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>

<body>

    <div class="container my-5">
        <div class="row">
            <div class="col-sm-6 d-flex align-items-center justify-content-center ">
                <svg xmlns="http://www.w3.org/2000/svg" width="240" height="240" fill="currentColor" class="bi bi-cart2" viewBox="0 0 16 16">
                    <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l1.25 5h8.22l1.25-5zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0" />
                </svg>
            </div>

            <div class="col-sm-6 d-flex align-items-center justify-content-center">
                <div class="shadow px-3 mb-5 bg-body rounded">
                    <form action="login.php" method="POST">
                        <h2 class="text-center">Login</h2>
                        <div class="mb-3">
                            <label for="inputUsername" class="form-label">Username</label>
                            <input type="name" name="username" class="form-control" id="exampleInputEmail1" placeholder="Username">
                            <?php

                            //         include 'error-message.php';
                            //         if (isset($_SESSION['emptyFieldUsername'])) {
                            //             echo "
                            // <div class='field-error'>
                            //     " . $_SESSION['emptyFieldUsername'] . "
                            // </div>";
                            //             unset($_SESSION['emptyFieldUsername']);
                            //         }
                            ?>
                            <div class="mb-3 ">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                <?php


                                if (isset($_SESSION['emptyFieldPassword'])) {
                                    echo '
                    <div class="field-error">
                        ' . $_SESSION['emptyFieldPassword'] . '
                    </div>';
                                    unset($_SESSION['emptyFieldPassword']);
                                }
                                ?>
                            </div>
                            <?php if (isset($_GET['action'])) { ?>
                                <input type="hidden" name="action" value="<?php echo $_GET['action']; ?>">
                            <?php }
                            ?>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Log In</button>
                            </div>
                            <span>Not a member? Register <a href="register.php">here</a></span>
                    </form>
                </div>
            </div>
        </div>

    </div>


</body>

</html>