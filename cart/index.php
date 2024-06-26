<?php
include '../ListItem.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/style.css">
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

                    <form action="../search/" method="get" class="d-flex mx-3 my-1" role="search">
                        <input name="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                    <div class="dropdown mx-2">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $_SESSION['firstname']; ?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
                        </ul>
                    </div>
                    <div>
                        <a href="" type="button" class="btn btn-danger mx-3 position-relative badge-total"><i class="bi bi-cart3"></i>
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
            </div>
        </nav>

        <div class="container">
            <div class="m-3">
                <div class="row">
                    <div class="col-md-4">
                        <a href="../" class="btn btn-primary">
                            <i class="bi bi-arrow-left-circle"></i>
                        </a>
                    </div>

                    <div class="col-md-3">
                        <h2 class="text-center">My Cart</h2>
                    </div>
                </div>
            </div>

            <table class="table" id="data">
                <thead>
                    <tr>
                        <!-- <th><input type="checkbox" id="select_all" value="" /></th> -->
                        <th scope="col">Item</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>

                <?php
                $cart = new ListItem();
                $userId = $_SESSION['user_id'];
                $carts = $cart->showCartItems($userId);

                foreach ($carts as $cart) {
                ?>
                    <tbody>
                        <tr>
                            <!-- <td><input type="checkbox" name="checked_id[]" class="checkbox" value="<?php echo $cart['id']; ?>" /></td> -->

                            <th scope="row"><?php echo $cart['name']; ?></th>
                            <td><?php echo $cart['price']; ?></td>

                            <td>
                                <div class="origQuantity">
                                    <?php echo $cart['total_quantity']; ?>
                                </div>

                            </td>
                            <td id="total-amount">Php. <?php echo $cart['totalAmount']; ?></td>
                            <td>

                                <button class="btn btn-warning changeQuantity" id="<?php echo $cart['id']; ?>" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-danger deleteId" id="<?php echo $cart['id']; ?>"><i class="bi bi-trash3-fill"></i></button>
                            </td>
                        </tr>

                    </tbody>
                <?php
                }
                ?>


            </table>
            <!-- <input type="submit" class="btn btn-danger" name="bulk_delete_submit" value="Delete" />
        </form> -->
        </div>


        <!-- Modal Edit -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Change Quantity</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <input type="hidden" id="item-id">
                            <label for="qty">Quantity:</label>
                            <select name="qty" class="qtySelect">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>

                            <div class="price">

                            </div>

                            <div class="total"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="update-quantity">Save changes</button>
                    </div>

                    </form>
                </div>
            </div>
        </div>



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <script>
            $(document).ready(function() {

                $("td").each(function() {
                    var id = $(this).attr("id");

                    console.log(id);
                });



                $('.changeQuantity').click(function() {
                    //alert('Hello');
                    var id = $(this).attr('id');
                    //console.log(id);
                    $.ajax({
                        type: "POST",
                        url: "../cart.php",
                        data: {
                            id: id,
                            action: 'getCartId'
                        },
                        dataType: "json",
                        success: function(response) {
                            // console.log(response.total_quantity);
                            //$('.modal-body').html(response);
                            //  console.log(response);
                            let title = response.name;
                            let qty = response.quantity;
                            let id = response.id;
                            let total_quantity = response.total_quantity;
                            //console.log(response);
                            //Display the value to <select> to class'qtySelect'
                            $('.qtySelect').val(total_quantity);
                            $('#item-id').val(id);
                        }
                    });
                });


                $('#update-quantity').click(function(e) {
                    e.preventDefault();
                    // $('#update-quantity')[0].reset();
                    $('#exampleModal').modal('hide');
                    let newQty = $('.qtySelect').val();
                    let id = $('#item-id').val();
                    //console.log(newQty);
                    // console.log(id);
                    $.ajax({
                        type: "post",
                        url: "../cart.php",
                        data: {
                            qty: newQty,
                            id: id,
                            action: 'changeQuantity'
                        },
                        success: function(response) {
                            location.reload();
                            //  $('#update-quantity')[0].reset();
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(xhr.status);
                            alert(thrownError);
                        }
                    });
                });

                $(".deleteId").click(function() {
                    let id = $(this).attr('id');
                    // alert(id);


                    $.ajax({
                        type: "POST",
                        url: "../cart.php",
                        data: {
                            id: id,
                            action: 'deleteCartId'
                        },

                        success: function(response) {
                            alert(response);
                            location.reload();
                        }
                    });

                });
                // $('#select_all').on('click', function() {
                //     if (this.checked) {
                //         $('.checkbox').each(function() {
                //             this.checked = true;
                //         });
                //     } else {
                //         $('.checkbox').each(function() {
                //             this.checked = false;
                //         });
                //     }
                // });

                // $('.checkbox').on('click', function() {
                //     if ($('.checkbox:checked').length == $('.checkbox').length) {
                //         $('#select_all').prop('checked', true);
                //     } else {
                //         $('#select_all').prop('checked', false);
                //     }
                // });

                // function delete_confirm() {
                //     if ($('.checkbox:checked').length > 0) {
                //         var result = confirm("Are you sure to delete selected users?");
                //         if (result) {
                //             return true;
                //         } else {
                //             return false;
                //         }
                //     } else {
                //         alert('Select at least 1 record to delete.');
                //         return false;
                //     }
                // }

            });
        </script>
    <?php } else {
        header('Location:../login/?action=goToCart');
    }
    ?>
</body>

</html>