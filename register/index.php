<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- Bootstap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../css/style.css">

    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>

<body>
    <div class="container p-3">
        <h2>Register</h2>
        <p class="text-danger">ONLY PUT A DUMMY PROFILE</p>

        <?php
        if (isset($_SESSION['already_exists'])) {
        ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['already_exists'];  ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
            unset($_SESSION['already_exists']);
        }
        ?>
        <form action="register.php" method="POST">
            <div class="row">
                <div class="col mb-3">
                    <label for="inputUsername" class="form-label">First Name</label>
                    <input type="name" name="firstname" class="form-control" id="exampleInputEmail1" placeholder="First Name">
                </div>

                <div class="col mb-3">
                    <label for="inputUsername" class="form-label">Middle Name</label>
                    <input type="name" name="middlename" class="form-control" id="exampleInputEmail1" placeholder="Middle Name">
                </div>
                <div class="col mb-3">
                    <label for="inputUsername" class="form-label">Lastname</label>
                    <input type="name" name="lastname" class="form-control" id="exampleInputEmail1" placeholder="Last Name">
                </div>
            </div>

            <div class="col mb-3">
                <label for="inputUsername" class="form-label">Birthday</label>
                <input type="date" name="birthday" class="form-control" id="">
            </div>
            <div class="row">
                <div class="col mb-3">
                    <label for="inputUsername" class="form-label">Username</label>
                    <input type="name" name="username" class="form-control" id="exampleInputEmail1" placeholder="Username">
                </div>
                <div class=" col mb-3 ">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Register</button>

            <p>Already have an account? Log In <a href="index.php">here</a></p>

        </form>
    </div>
</body>

</html>