
<?php
require_once "dbconfig.php"; // Connect to the database

$message = "";
$item = null;

// Get the selected item
if (isset($_GET["item_id"])) {
    $stmt = $pdo->prepare("SELECT * FROM groceries WHERE item_id = :item_id");
    $stmt->execute([":item_id" => $_GET["item_id"]]);
    $item = $stmt->fetch();
}

// Save the changes
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $sql = "UPDATE groceries SET
            product_name = :product_name,
            brand_name = :brand_name,
            category = :category,
            country_of_origin = :country_of_origin,
            package_size = :package_size,
            price_ghs = :price_ghs,
            stock_quantity = :stock_quantity,
            expiration_date = :expiration_date,
            is_available = :is_available
            WHERE item_id = :item_id";

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
        ":is_available" => $_POST["is_available"],
        ":item_id" => $_POST["item_id"]
    ]);

    $message = "Grocery item updated successfully!";

    // Load the updated item
    $stmt = $pdo->prepare("SELECT * FROM groceries WHERE item_id = :item_id");
    $stmt->execute([":item_id" => $_POST["item_id"]]);
    $item = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Grocery Item</title>
</head>
<body>
    <h2>Update a Grocery Item</h2>

    <p><?php echo htmlspecialchars($message); ?></p>

    <form method="GET">
        Item ID:
        <input type="number" name="item_id" min="1" required>
        <button type="submit">Find Item</button>
    </form>

    <?php if ($item): ?>
        <form method="POST">
            <input type="hidden" name="item_id" value="<?php echo htmlspecialchars($item["item_id"]); ?>">

            Product Name:
            <input type="text" name="product_name" value="<?php echo htmlspecialchars($item["product_name"]); ?>" required><br><br>

            Brand Name:
            <input type="text" name="brand_name" value="<?php echo htmlspecialchars($item["brand_name"]); ?>" required><br><br>

            Category:
            <input type="text" name="category" value="<?php echo htmlspecialchars($item["category"]); ?>" required><br><br>

            Country of Origin:
            <input type="text" name="country_of_origin" value="<?php echo htmlspecialchars($item["country_of_origin"]); ?>" required><br><br>

            Package Size:
            <input type="text" name="package_size" value="<?php echo htmlspecialchars($item["package_size"]); ?>" required><br><br>

            Price (GHS):
            <input type="number" name="price_ghs" step="0.01" min="0" value="<?php echo htmlspecialchars($item["price_ghs"]); ?>" required><br><br>

            Stock Quantity:
            <input type="number" name="stock_quantity" min="0" value="<?php echo htmlspecialchars($item["stock_quantity"]); ?>" required><br><br>

            Expiration Date:
            <input type="date" name="expiration_date" value="<?php echo htmlspecialchars($item["expiration_date"]); ?>" required><br><br>

            Available:
            <select name="is_available">
                <option value="1" <?php echo $item["is_available"] ? "selected" : ""; ?>>Yes</option>
                <option value="0" <?php echo !$item["is_available"] ? "selected" : ""; ?>>No</option>
            </select><br><br>

            <button type="submit">Save Changes</button>
        </form>
    <?php elseif (isset($_GET["item_id"])): ?>
        <p>No grocery item found with that ID.</p>
    <?php endif; ?>

    <p><a href="fetch_all.php">View All Grocery Items</a></p>
</body>
</html>
