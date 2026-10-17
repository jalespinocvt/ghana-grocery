
<?php
require_once "dbconfig.php"; // Connect to the database

$message = "";
$item = null;

// Find the selected item
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

    // Reload the updated item
    $stmt = $pdo->prepare("SELECT * FROM groceries WHERE item_id = :item_id");
    $stmt->execute([":item_id" => $_POST["item_id"]]);
    $item = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Update Grocery Item</title>

<style>
* { box-sizing: border-box; }

body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #f2f5f3;
    color: #26352d;
    font-size: 13px;
}

header {
    background: #245c43;
    color: white;
    padding: 12px;
    text-align: center;
}

header h1 { margin: 0 0 4px; font-size: 22px; }
header p { margin: 0; font-size: 12px; }

.container {
    width: 96%;
    max-width: 1000px;
    margin: 12px auto;
}

.card {
    background: white;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 2px 8px #00000010;
    margin-bottom: 12px;
}

h2 {
    margin: 0 0 10px;
    color: #245c43;
    font-size: 17px;
}

.hint { color: #68766d; margin: 0 0 10px; }

.search-form {
    display: flex;
    align-items: end;
    gap: 10px;
}

.search-form .field { max-width: 250px; }

.form-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 10px 14px;
}

.field {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

label { font-weight: bold; }

input, select {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccd7cf;
    border-radius: 5px;
    font-size: 13px;
    background: white;
}

input:focus, select:focus {
    outline: 2px solid #b5d9c2;
    border-color: #28734d;
}

button, .link {
    padding: 9px 13px;
    border: 0;
    border-radius: 5px;
    font-size: 12px;
    font-weight: bold;
    text-decoration: none;
    cursor: pointer;
    display: inline-block;
    text-align: center;
}

.primary { background: #28734d; color: white; }
.secondary { background: #e8eee9; color: #2c4937; }

.actions {
    display: flex;
    gap: 8px;
    margin-top: 13px;
    flex-wrap: wrap;
}

.message {
    background: #e5f5e9;
    color: #24663b;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 12px;
}

footer {
    text-align: center;
    color: #738077;
    font-size: 11px;
    padding: 8px;
}

@media (max-width: 650px) {
    .form-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
}

@media (max-width: 420px) {
    .form-grid { grid-template-columns: 1fr; }
    .search-form { align-items: stretch; flex-direction: column; }
}
</style>
</head>

<body>
<header>
    <h1>Ghana Grocery Inventory</h1>
    <p>Update product information and stock</p>
</header>

<main class="container">
    <section class="card">
        <h2>Find Grocery Item</h2>
        <form method="GET" class="search-form">
            <div class="field">
                <label for="item_id">Item ID</label>
                <input type="number" id="item_id" name="item_id" min="1"
                       value="<?php echo isset($_GET["item_id"]) ? htmlspecialchars($_GET["item_id"]) : ""; ?>"
                       required>
            </div>
            <button type="submit" class="primary">Find Item</button>
        </form>
    </section>

    <?php if ($message !== ""): ?>
        <div class="message"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>

    <?php if ($item): ?>
    <section class="card">
        <h2>Edit Grocery Details (ID: <?php echo htmlspecialchars($item["item_id"]); ?>)</h2>
        <p class="hint">Edit the details and save your changes.</p>

        <form method="POST">
            <input type="hidden" name="item_id" value="<?php echo htmlspecialchars($item["item_id"]); ?>">

            <div class="form-grid">
                <div class="field">
                    <label for="product_name">Product Name</label>
                    <input id="product_name" name="product_name" value="<?php echo htmlspecialchars($item["product_name"]); ?>" required>
                </div>

                <div class="field">
                    <label for="brand_name">Brand Name</label>
                    <input id="brand_name" name="brand_name" value="<?php echo htmlspecialchars($item["brand_name"]); ?>" required>
                </div>

                <div class="field">
                    <label for="category">Category</label>
                    <input id="category" name="category" value="<?php echo htmlspecialchars($item["category"]); ?>" required>
                </div>

                <div class="field">
                    <label for="country_of_origin">Country of Origin</label>
                    <input id="country_of_origin" name="country_of_origin" value="<?php echo htmlspecialchars($item["country_of_origin"]); ?>" required>
                </div>

                <div class="field">
                    <label for="package_size">Package Size</label>
                    <input id="package_size" name="package_size" value="<?php echo htmlspecialchars($item["package_size"]); ?>" required>
                </div>

                <div class="field">
                    <label for="price_ghs">Price (GHS)</label>
                    <input type="number" id="price_ghs" name="price_ghs" step="0.01" min="0" value="<?php echo htmlspecialchars($item["price_ghs"]); ?>" required>
                </div>

                <div class="field">
                    <label for="stock_quantity">Stock Quantity</label>
                    <input type="number" id="stock_quantity" name="stock_quantity" min="0" value="<?php echo htmlspecialchars($item["stock_quantity"]); ?>" required>
                </div>

                <div class="field">
                    <label for="expiration_date">Expiration Date</label>
                    <input type="date" id="expiration_date" name="expiration_date" value="<?php echo htmlspecialchars($item["expiration_date"]); ?>" required>
                </div>

                <div class="field">
                    <label for="is_available">Availability</label>
                    <select id="is_available" name="is_available">
                        <option value="1" <?php echo $item["is_available"] ? "selected" : ""; ?>>Available</option>
                        <option value="0" <?php echo !$item["is_available"] ? "selected" : ""; ?>>Unavailable</option>
                    </select>
                </div>
            </div>

            <div class="actions">
                <button type="submit" class="primary">Save Changes</button>
                <a href="update.php" class="link secondary">Cancel</a>
                <a href="fetch_all.php" class="link secondary">View All Items</a>
                <a href="index.php" class="link secondary">Home</a>
            </div>
        </form>
    </section>
    <?php elseif (isset($_GET["item_id"])): ?>
    <section class="card">
        No grocery item found with that ID.
        <a href="fetch_all.php" class="link secondary">View All Items</a>
    </section>
    <?php endif; ?>
</main>

<footer>Ghana Grocery Inventory System | PDO Project</footer>
</body>
</html>
