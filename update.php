
<?php
require_once "dbconfig.php"; // Connect to the database

$item_id = 1; // ID of the item to update

$sql = "UPDATE groceries 
        SET price_ghs = :price_ghs, stock_quantity = :stock_quantity 
        WHERE item_id = :item_id";

$stmt = $pdo->prepare($sql); // Prepare the query

$stmt->execute([
    ":price_ghs" => 25.50,
    ":stock_quantity" => 60,
    ":item_id" => $item_id
]); // Save the changes

if ($stmt->rowCount() > 0) {
    echo "Grocery item updated successfully!";
} else {
    echo "No changes made. Check the item ID or existing values.";
}
?>
