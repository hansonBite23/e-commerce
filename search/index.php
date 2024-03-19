<?php
session_start();
$search =  $_GET['search'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../style.css">

</head>

<body>
    <?php
    if (isset($_SESSION['user_id'])) {
    ?>
        <nav class="navbar navbar-expand-lg ">
            <div class="container-fluid">
                <a class="navbar-brand" href="/e-commerce/">Shop</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../">Home</a>
                        </li>
                    </ul>

                    <form action="" method="get" class="d-flex mx-3 my-1" role="search">
                        <input name="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $_SESSION['firstname']; ?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="../logout.php">Logout</a></li>

                        </ul>
                    </div>
                    <a href="../login" type="button" class="btn btn-danger mx-3"><i class="bi bi-cart3"></i></a>

                </div>
            </div>
        </nav>
    <?php
    } else {
    ?>

        <nav class="navbar navbar-expand-lg ">
            <div class="container-fluid">
                <a class="navbar-brand" href="/e-commerce/">Shop</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../">Home</a>
                        </li>
                    </ul>
                    <form action="" method="get" class="d-flex mx-3 my-1" role="search">
                        <input name="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                    <a href="../login/" type="button" class="btn btn-danger ">Cart</a>

                    <a href="../login/" type="button" class="btn btn-primary mx-3">Login</a>
                </div>
            </div>
        </nav>


    <?php } ?>
    <div class="container my-3">
        <h3>Search for '<?php echo $search; ?>'</h3>
        <div class="col-md-12 m-3">
            <div class="row grid">
                <?php

                include "../ListItem.php";

                $searchItems = new ListItem();
                $rows = $searchItems->searchItem($search);
                if (empty($rows)) {
                    echo "No results found";
                } else {
                    foreach ($rows as $row) {
                ?>
                        <div class=" col-xs-12 col-md-6 col-lg-3">
                            <div class="card p-3 mb-3" style="width: 240px;">
                                <img src="../<?php echo $row['img']; ?>" class="mx-auto" height="144" width="144">
                                <div class="card-body text-center">
                                    <h5><?php echo $row['name']; ?></h5>
                                    <p>Php. <?php echo $row['price']; ?></p>
                                    <a href="../login/" class="btn btn-success">Add to Cart</a>
                                    <label for="qty">Quantity:</label>
                                    <select name="qty" class="qtySelect">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</body>

</html>