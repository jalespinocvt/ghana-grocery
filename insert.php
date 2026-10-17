
<?php
require_once "dbconfig.php"; // Connect to the database

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the values from the form
    $sql = "INSERT INTO groceries
            (product_name, brand_name, category, country_of_origin, package_size, price_ghs, stock_quantity, expiration_date, is_available)
            VALUES
            (:product_name, :brand_name, :category, :country_of_origin, :package_size, :price_ghs, :stock_quantity, :expiration_date, :is_available)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ":product_name" => $_POST["product_name"],
        ":brand_name" => $_POST["brand_name"],
        ":category" => $_POST["category"],
        ":country_of_origin" => $_POST["country_of_origin"],
        ":package_size" => $_POST["package_size"],
        ":price_ghs" => $_POST["price_ghs"],
        ":stock_quantity" => $_POST["stock_quantity"],
        ":expiration_date" => $_POST["expiration_date"],
        ":is_available" => $_POST["is_available"]
    ]);

    $message = "Grocery item added successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Insert Grocery Item</title>
</head>
<body>
    <h2>Add a Grocery Item</h2>

    <p><?php echo htmlspecialchars($message); ?></p>

    <form method="POST">
        Product Name: <input type="text" name="product_name" required><br><br>
        Brand Name: <input type="text" name="brand_name" required><br><br>
        Category: <input type="text" name="category" required><br><br>
        Country of Origin: <input type="text" name="country_of_origin" required><br><br>
        Package Size: <input type="text" name="package_size" required><br><br>
        Price (GHS): <input type="number" name="price_ghs" step="0.01" min="0" required><br><br>
        Stock Quantity: <input type="number" name="stock_quantity" min="0" required><br><br>
        Expiration Date: <input type="date" name="expiration_date" required><br><br>

        Available:
        <select name="is_available">
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select><br><br>

        <button type="submit">Add Item</button>
    </form>

    <p><a href="fetch_all.php">View All Grocery Items</a></p>
</body>
</html>
