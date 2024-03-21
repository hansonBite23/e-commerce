<?php
session_start();
include "ListItem.php";
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Commerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <?php
    if (isset($_SESSION['user_id'])) {
    ?>
        <div class="userID" id="<?php echo $_SESSION['user_id']; ?>"></div>
        <nav class="navbar navbar-expand-lg ">
            <div class="container-fluid">
                <a class="navbar-brand" href="/e-commerce/">Shop</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                    </ul>

                    <form action="search/" method="get" class="d-flex mx-3 my-1" role="search">
                        <input name="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $_SESSION['firstname']; ?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>

                        </ul>
                    </div>

                    <a href="cart/" type="button" class="btn btn-danger mx-3 position-relative badge-total"><i class="bi bi-cart3"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            <div class="added-items">
                                <?php
                                $count = new ListItem();
                                $userId = $_SESSION['user_id'];
                                $countTotal = $count->totalCartItems($userId);
                                ?>
                            </div>
                            <span class="visually-hidden">unread messages</span>
                        </span>
                    </a>

                </div>
            </div>
        </nav>

        <div class="container">
            <div class="alert alert-primary alert-dismissible fade show addSuccess" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <div class="alert alert-danger alert-dismissible fade show  exceed" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <div class="col-md-12 m-3">
                <div class="row grid">
                    <?php
                    $list = new ListItem();
                    $items = $list->index();

                    foreach ($items as $item) {
                    ?>
                        <div class=" col-xs-12 col-md-6 col-lg-3">
                            <div class="card p-3 mb-3" idNum='<?php echo $item['id']; ?>' style="width: 240px;">
                                <img src="<?php echo $item['img']; ?>" alt="<?php echo $item['img']; ?>" class="mx-auto" height="144" width="144">
                                <div class="card-body text-center">
                                    <h5><?php echo $item['name']; ?></h5>
                                    <p>Php. <?php echo $item['price']; ?></p>
                                    <button class="btn btn-success addToCart" itemNumber="<?php echo $item['id']; ?>">Add To Cart</button>
                                    <label for="qty">Quantity:</label>
                                    <select name="qty" class="qtySelect m-3">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Add Comment -->
                    <?php
                    }
                    ?>


                </div>
            </div>

            <div class="res"></div>
        </div>
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
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                    </ul>
                    <form action="search/" method="get" class="d-flex mx-3 my-1" role="search">
                        <input name="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                    <a href="login/" type="button" class="btn btn-danger ">Cart</a>

                    <a href="login/" type="button" class="btn btn-primary mx-3">Login</a>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="alert alert-primary addSuccess" role="alert">
            </div>
            <div class="col-md-12 m-3">
                <div class="row grid">
                    <?php
                    $list = new ListItem();
                    $items = $list->index();

                    foreach ($items as $item) {
                    ?>
                        <div class=" col-xs-12 col-md-6 col-lg-3">
                            <div class="card p-3 mb-3" idNum='<?php echo $item['id']; ?>' style="width: 240px;">
                                <img src="<?php echo $item['img']; ?>" class="mx-auto" height="144" width="144">
                                <div class="card-body text-center">
                                    <h5><?php echo $item['name']; ?></h5>
                                    <p>Php. <?php echo $item['price']; ?></p>
                                    <a href="login/" class="btn btn-success">Add to Cart</a>
                                    <label for="qty">Quantity:</label>
                                    <select name="qty" class="qtySelect m-3">
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
                    ?>


                </div>
            </div>

            <div class="res"></div>
        </div>
    <?php
    }
    ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {

            $('.addSuccess').hide();
            $('.exceed').hide();
            $('.addToCart').click(function(e) {
                e.preventDefault();

                // Find the parent card element
                var card = $(this).closest('.card');

                // console.log(card.attr('idNum'));
                // Find the select element within the card
                var selectElement = card.find('.qtySelect');

                // Get the selected value from the select element
                var selectedQty = selectElement.val();
                // Get the item ID from the button's 'itemNumber' attribute
                var itemId = $(this).attr('itemNumber');

                var user_id = $('.userID').attr('id');
                //console.log(user_id);
                $.ajax({
                    type: "POST",
                    url: "cart.php",
                    data: {
                        item_id: itemId,
                        qty: selectedQty,
                        user_id: user_id,
                        action: 'addToCart'
                    },

                    success: function(response) {
                        if (response === 'exceed') {
                            $('.exceed').show().html("Exceeded to 10");
                        } else {
                            $('.addSuccess').show().html(response);
                            $('span').load(' .added-items');

                        } //alert(response);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('An error occurred. Please try again.');
                    }
                });
            });
        });
    </script>
</body>

</html>

<!-- tbl Cart
item
User
qty -->