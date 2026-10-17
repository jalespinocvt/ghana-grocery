
<?php
require_once "dbconfig.php"; // Connect to the database

$sql = "SELECT * FROM groceries LIMIT 1"; // Get one grocery record
$stmt = $pdo->query($sql);
$item = $stmt->fetch(); // Fetch the first record

echo "<h2>Ghana Grocery Product - PDO fetch()</h2>";

if ($item) { // Check if a record exists
    echo "Item ID: " . htmlspecialchars($item["item_id"]) . "<br>";
    echo "Product Name: " . htmlspecialchars($item["product_name"]) . "<br>";
    echo "Brand: " . htmlspecialchars($item["brand_name"]) . "<br>";
    echo "Category: " . htmlspecialchars($item["category"]) . "<br>";
    echo "Country of Origin: " . htmlspecialchars($item["country_of_origin"]) . "<br>";
    echo "Package Size: " . htmlspecialchars($item["package_size"]) . "<br>";
    echo "Price (GHS): " . htmlspecialchars($item["price_ghs"]) . "<br>";
    echo "Stock Quantity: " . htmlspecialchars($item["stock_quantity"]) . "<br>";
    echo "Expiration Date: " . htmlspecialchars($item["expiration_date"]) . "<br>";
    echo "Available: " . ($item["is_available"] ? "Yes" : "No") . "<br>";
} else {
    echo "No grocery records found.";
}
?>
