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
        include 'connection.php';

        $sqlSelect = "SELECT SUM(quantity) AS total_quantity FROM cart WHERE item_id = $item_id";
        $result = mysqli_query($con, $sqlSelect);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $existingQuantity = $row['total_quantity'];

            // Check if adding the new quantity will exceed 10
            $totalQuantity = $existingQuantity + $qty;

            if ($totalQuantity >= 10) {

                echo  "Alert: Quantity exceeds 10. Cannot add to cart";
            } else {

                $sqlInsert = "INSERT INTO cart (item_id, quantity) VALUES ($item_id, $qty)";
                $insertResult = mysqli_query($con, $sqlInsert);

                if ($insertResult) {
                    echo "Item added to cart successfully.";
                } else {
                    echo "Error: " . mysqli_error($con);
                }
            }
        } else {
            echo "Error: " . mysqli_error($con);
        }

        // Close the database connection
        mysqli_close($con);
    }

    public function showCartItems()
    {
        include 'connection.php';
        $sql = 'SELECT cart.id, cart.item_id,items.name, SUM(cart.quantity) AS total_quantity, items.price, SUM(cart.quantity * items.price) AS totalAmount 
        FROM cart 
        LEFT JOIN items ON cart.item_id = items.id 
        GROUP BY items.name;';
        $result =  mysqli_query($con, $sql);
        return $result;
    }

    public function getCartId($id)
    {
        include 'connection.php';
        $sql = "SELECT items.name, cart.id, cart.item_id, items.price,SUM(quantity) as total_quantity, quantity*items.price AS totalAmount 
        FROM cart
        LEFT JOIN items ON cart.item_id = items.id 
        WHERE items.id = '$id' 
        GROUP BY items.name";
        $result =  mysqli_query($con, $sql);
        $rows = mysqli_fetch_assoc($result);
        $cartId = json_encode($rows);
        echo $cartId;
    }

    public function updateQuantity($id, $qty)
    {
        include 'connection.php';
        // Get the current quantity from the cart table
        $sqlSelect = "SELECT quantity FROM cart WHERE id = $id";
        $result = mysqli_query($con, $sqlSelect);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $currentQty = $row['quantity'];

            // Calculate the new total quantity
            $totalQty = $currentQty + $newQty;

            // Update the quantity in the cart table
            $sqlUpdate = "UPDATE cart SET quantity = $totalQty WHERE id = $id";
            $updateResult = mysqli_query($con, $sqlUpdate);

            if ($updateResult) {
                echo "Quantity updated successfully.";
            } else {
                echo "Error updating quantity: " . mysqli_error($con);
            }
        } else {
            echo "Record not found.";
        }

        // Close the database connection
        mysqli_close($con);
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
