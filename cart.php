<?php
// SELECT cart.id, cart.item_id, items.name, items.price, quantity, quantity*items.price AS totalAmount 
// FROM cart 
// LEFT JOIN items ON cart.item_id = items.id;
//  WHERE user_id=1;

//echo $_POST['item_id'] . ' Quantity: ' . $_POST['qty'] . ' Action: ' . $_POST['action'];
// Store cart

$action = $_POST['action'];

if ($action === 'addToCart') {
    include "ListItem.php";
    $item_id = $_POST['item_id'];
    $qty = $_POST['qty'];
    $action = $_POST['action'];
    $user_id = $_POST['user_id'];
    $addToCart = new ListItem();
    $addToCart->addToCart($item_id, $user_id, $qty);
} elseif ($action === 'getCartId') {
    $id = $_POST['id'];
    include "ListItem.php";
    $getCartId = new ListItem();
    $getCartId->getCartId($id);
} elseif ($action === 'changeQuantity') {
    $id = $_POST['id'];
    $qty = $_POST['qty'];
    include "ListItem.php";
    $updateQty = new ListItem();
    $updateQty->updateQuantity($id, $qty);
} elseif ($action === 'deleteCartId') {
    include "ListItem.php";
    $id = $_POST['id'];
    $delete = new ListItem();
    $delete->deleteCartId($id);
}
