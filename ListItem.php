<?php
include 'connection.php';

class ListItem
{
    public function index()
    {
        include 'connection.php';
        $sql = 'SELECT * FROM items';
        $result =  mysqli_query($con, $sql);
        return $result;
    }

    public function addToCart($item_id, $qty)
    {
        //echo $item_id . $qty;

        include 'connection.php';
        $sql = 'INSERT  INTO `cart`(`item_id`, `quantity`)
                VALUES (' . $item_id . ',' . $qty . ')';
        $result =  mysqli_query($con, $sql);

        if ($result === true) {
            echo 'Added to Cart';
        } else {
            return "Wrong";
        }
    }

    public function showCartItems()
    {
        include 'connection.php';
        $sql = 'SELECT DISTINCT items.name, cart.id, cart.item_id, items.price, quantity, quantity*items.price AS totalAmount 
        FROM cart
        LEFT JOIN items ON cart.item_id = items.id;';
        $result =  mysqli_query($con, $sql);
        return $result;
    }

    public function getCartId($id)
    {
        include 'connection.php';
        $sql = 'SELECT  items.name, cart.id, cart.item_id, items.price, cart.quantity
        FROM cart
        LEFT JOIN items ON cart.item_id = items.id 
        WHERE cart.id = ' . $id;
        $result =  mysqli_query($con, $sql);
        $rows = mysqli_fetch_assoc($result);
        $cartId = json_encode($rows);
        echo $cartId;
    }

    public function updateQuantity($id, $qty)
    {
        include 'connection.php';
        $sql = 'UPDATE `cart` SET `quantity`=' . $qty . ' WHERE id = ' . $id;
        $result =  mysqli_query($con, $sql);
        if ($result === true) {
            echo "Quantity Updated";
        }
    }

    public function deleteCartId($id)
    {
        include 'connection.php';
        $sql = 'DELETE FROM `cart` WHERE id =' . $id;
        $result =  mysqli_query($con, $sql);
        if ($result === true) {
            echo "Item Deleted From Cart";
        }
    }

    public function searchItem($search)
    {
        include 'connection.php';

        // Check if the connection was successful
        if (!$con) {
            die('Connection failed: ' . mysqli_connect_error());
        }

        // Sanitize the input
        $search = mysqli_real_escape_string($con, $search);

        // Construct the SQL query
        $sql = "SELECT * FROM `items` WHERE name LIKE '%$search%'";

        // Execute the query
        $result = mysqli_query($con, $sql);

        // Check if the query was successful
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                // Fetch all matching rows as an associative array
                $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

                // Free the result set
                mysqli_free_result($result);

                // Close the database connection
                mysqli_close($con);

                // Return the array of matching rows
                return $rows;
            } else {
            }
        } else {
            // Handle the case where the query failed
            echo 'Error: ' . mysqli_error($con);
            mysqli_close($con);
            return null;
        }
    }
}
