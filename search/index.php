<?php
$search =  $_GET['search'];
include "../ListItem.php";

$searchItems = new ListItem();
$rows = $searchItems->searchItem($search);

if (empty($rows)) {
    echo "No results found";
} else {
    foreach ($rows as $row) {
        echo $row['id'];
        echo $row['name'];
        echo $row['price'];
    }
}
// SELECT cart.id, items.name, items.price, quantity, quantity*items.price AS totalAmount
// FROM cart
// INNER JOIN items ON cart.user_id=items.id
// WHERE user_id=1;