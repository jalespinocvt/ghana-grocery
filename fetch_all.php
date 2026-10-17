<?php
require_once "dbconfig.php"; // Connect to the database

$sql = "SELECT * FROM groceries"; // Get all grocery records
$stmt = $pdo->query($sql);
$groceries = $stmt->fetchAll(); // Store all results

echo "<h2>Ghana Grocery Products - PDO fetchAll()</h2>";
echo "<p>Total records: " . count($groceries) . "</p>"; // Show total records

echo "<table border='1' cellpadding='8'>"; // Create the table
echo "<tr>
        <th>Item ID</th>
        <th>Product Name</th>
        <th>Brand</th>
        <th>Category</th>
        <th>Country of Origin</th>
        <th>Package Size</th>
        <th>Price (GHS)</th>
        <th>Stock</th>
        <th>Expiration Date</th>
        <th>Available</th>
      </tr>";

// Display each grocery record
foreach ($groceries as $item) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($item["item_id"]) . "</td>";
    echo "<td>" . htmlspecialchars($item["product_name"]) . "</td>";
    echo "<td>" . htmlspecialchars($item["brand_name"]) . "</td>";
    echo "<td>" . htmlspecialchars($item["category"]) . "</td>";
    echo "<td>" . htmlspecialchars($item["country_of_origin"]) . "</td>";
    echo "<td>" . htmlspecialchars($item["package_size"]) . "</td>";
    echo "<td>" . htmlspecialchars($item["price_ghs"]) . "</td>";
    echo "<td>" . htmlspecialchars($item["stock_quantity"]) . "</td>";
    echo "<td>" . htmlspecialchars($item["expiration_date"]) . "</td>";
    echo "<td>" . ($item["is_available"] ? "Yes" : "No") . "</td>";
    echo "</tr>";
}

echo "</table>"; // Close the table
?>