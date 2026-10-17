
<?php
require_once "dbconfig.php"; // Connect to the database

// Set the new grocery product details
$sql = "INSERT INTO groceries 
        (product_name, brand_name, category, country_of_origin, package_size, price_ghs, stock_quantity, expiration_date, is_available)
        VALUES 
        (:product_name, :brand_name, :category, :country_of_origin, :package_size, :price_ghs, :stock_quantity, :expiration_date, :is_available)";

$stmt = $pdo->prepare($sql); // Prepare the query

// Add the product details
$stmt->execute([
    ":product_name" => "Brown Sugar",
    ":brand_name" => "Sweet Ghana",
    ":category" => "Sweeteners",
    ":country_of_origin" => "Ghana",
    ":package_size" => "1 kg",
    ":price_ghs" => 18.50,
    ":stock_quantity" => 40,
    ":expiration_date" => "2027-12-31",
    ":is_available" => 1
]);

echo "Grocery item added successfully!";
?>
