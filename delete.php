
<?php
require_once "dbconfig.php"; // Connect to the database

$message = "";
$item = null;

// Find the selected item
if (isset($_GET["item_id"]) && $_GET["item_id"] !== "") {
    $stmt = $pdo->prepare("SELECT * FROM groceries WHERE item_id = :item_id");
    $stmt->execute([":item_id" => $_GET["item_id"]]);
    $item = $stmt->fetch();

    if (!$item) {
        $message = "No grocery item found with that ID.";
    }
}

// Delete the selected item
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["item_id"])) {
    $stmt = $pdo->prepare("DELETE FROM groceries WHERE item_id = :item_id");
    $stmt->execute([":item_id" => $_POST["item_id"]]);

    if ($stmt->rowCount() > 0) {
        $message = "Grocery item deleted successfully!";
    } else {
        $message = "No grocery item was deleted.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Delete Grocery Item</title>

<style>
* { box-sizing: border-box; }

body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #f4f6f5;
    color: #29352e;
    font-size: 13px;
}

header {
    background: #8b3030;
    color: white;
    text-align: center;
    padding: 14px;
}

header h1 { margin: 0 0 5px; font-size: 22px; }
header p { margin: 0; }

.container {
    width: 94%;
    max-width: 850px;
    margin: 18px auto;
}

.card {
    background: white;
    padding: 18px;
    margin-bottom: 14px;
    border-radius: 8px;
    box-shadow: 0 2px 8px #00000010;
}

h2 {
    color: #8b3030;
    margin: 0 0 12px;
    font-size: 18px;
}

.hint { color: #68766d; margin: 0 0 12px; }

.search-form {
    display: flex;
    gap: 10px;
    align-items: end;
}

.field {
    display: flex;
    flex-direction: column;
    gap: 5px;
    flex: 1;
    max-width: 300px;
}

label { font-weight: bold; }

input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccd5ce;
    border-radius: 5px;
    font-size: 13px;
}

button, .link {
    display: inline-block;
    padding: 10px 14px;
    border: 0;
    border-radius: 5px;
    font-size: 12px;
    font-weight: bold;
    text-decoration: none;
    text-align: center;
    cursor: pointer;
}

.primary { background: #8b3030; color: white; }
.secondary { background: #e8eee9; color: #2c4937; }

.warning {
    background: #fff0f0;
    border: 1px solid #f0caca;
    padding: 12px;
    border-radius: 6px;
    margin: 12px 0;
}

.details {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 12px;
}

.detail {
    padding: 10px;
    background: #f6f8f6;
    border-radius: 5px;
    overflow-wrap: anywhere;
}

.detail strong {
    display: block;
    color: #68766d;
    font-size: 11px;
    margin-bottom: 5px;
}

.actions {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
    margin-top: 15px;
}

.message {
    padding: 12px;
    background: #e5f5e9;
    color: #24663b;
    border-radius: 5px;
    margin-bottom: 14px;
}

footer {
    text-align: center;
    padding: 10px;
    color: #738077;
    font-size: 11px;
}

@media (max-width: 550px) {
    .details { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    .search-form { align-items: stretch; flex-direction: column; }
    .field { max-width: none; }
}
</style>
</head>

<body>
<header>
    <h1>Ghana Grocery Inventory</h1>
    <p>Find and remove a grocery record</p>
</header>

<main class="container">

    <?php if ($message !== ""): ?>
        <div class="message"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>

    <section class="card">
        <h2>Find Grocery Item</h2>
        <p class="hint">Enter the item ID to view the product before deleting it.</p>

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

    <?php if ($item): ?>
    <section class="card">
        <h2>Product Details</h2>

        <div class="warning">
            <strong>Warning:</strong> Deleting this item permanently removes its database record.
            Check the details before confirming.
        </div>

        <div class="details">
            <div class="detail"><strong>Item ID</strong><?php echo htmlspecialchars($item["item_id"]); ?></div>
            <div class="detail"><strong>Product Name</strong><?php echo htmlspecialchars($item["product_name"]); ?></div>
            <div class="detail"><strong>Brand</strong><?php echo htmlspecialchars($item["brand_name"]); ?></div>
            <div class="detail"><strong>Category</strong><?php echo htmlspecialchars($item["category"]); ?></div>
            <div class="detail"><strong>Country of Origin</strong><?php echo htmlspecialchars($item["country_of_origin"]); ?></div>
            <div class="detail"><strong>Package Size</strong><?php echo htmlspecialchars($item["package_size"]); ?></div>
            <div class="detail"><strong>Price (GHS)</strong><?php echo htmlspecialchars($item["price_ghs"]); ?></div>
            <div class="detail"><strong>Stock Quantity</strong><?php echo htmlspecialchars($item["stock_quantity"]); ?></div>
            <div class="detail"><strong>Expiration Date</strong><?php echo htmlspecialchars($item["expiration_date"]); ?></div>
            <div class="detail"><strong>Availability</strong><?php echo $item["is_available"] ? "Available" : "Unavailable"; ?></div>
        </div>

        <form method="POST" onsubmit="return confirm('Are you sure you want to permanently delete this grocery item?');">
            <input type="hidden" name="item_id" value="<?php echo htmlspecialchars($item["item_id"]); ?>">
            <div class="actions">
                <button type="submit" class="primary">Delete This Item</button>
                <a href="delete.php" class="link secondary">Cancel</a>
                <a href="fetch_all.php" class="link secondary">View All Items</a>
                <a href="index.php" class="link secondary">Home</a>
            </div>
        </form>
    </section>
    <?php endif; ?>

</main>

<footer>Ghana Grocery Inventory System | PDO Project</footer>
</body>
</html>
