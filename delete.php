
<?php
require_once "dbconfig.php"; // Connect to the database

$item_id = 104; // ID of the item to delete

$sql = "DELETE FROM groceries WHERE item_id = :item_id";
$stmt = $pdo->prepare($sql); // Prepare the query
$stmt->execute([":item_id" => $item_id]); // Delete the selected item

if ($stmt->rowCount() > 0) {
    echo "Grocery item deleted successfully!";
} else {
    echo "No matching grocery item found.";
}
?>
