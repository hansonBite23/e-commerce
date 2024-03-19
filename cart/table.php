<?php
include '../ListItem.php';
?>

<table class="table">
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
    $carts = $cart->showCartItems();
    foreach ($carts as $cart) {
    ?>
        <tbody>
            <tr>
                <!-- <td><input type="checkbox" name="checked_id[]" class="checkbox" value="<?php echo $cart['id']; ?>" /></td> -->

                <th scope="row"><?php echo $cart['name']; ?></th>
                <td><?php echo $cart['price']; ?></td>

                <td>
                    <div class="origQuantity">
                        <?php echo $cart['quantity']; ?>
                    </div>

                </td>
                <td>Php. <?php echo $cart['totalAmount']; ?></td>
                <td>

                    <button class="btn btn-warning changeQuantity" id="<?php echo $cart['id']; ?>" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit Quantity</button>
                    <button class="btn btn-danger">Delete</button>
                </td>
            </tr>

        </tbody>
    <?php
    }
    ?>


</table>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Change Quantity</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <input type="hidden" id="cart-id">
                    <label for="qty">Quantity:</label>
                    <select name="qty" class="qtySelect">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
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