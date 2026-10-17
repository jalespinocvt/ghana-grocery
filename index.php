
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ghana Grocery Inventory</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f2f5f3;
            color: #26352d;
        }

        header {
            background: #245c43;
            color: white;
            text-align: center;
            padding: 28px 15px;
        }

        header h1 {
            margin: 0 0 8px;
            font-size: 30px;
        }

        header p {
            margin: 0;
            color: #e0eee5;
            font-size: 14px;
        }

        .container {
            width: 92%;
            max-width: 1050px;
            margin: 30px auto;
        }

        .intro {
            text-align: center;
            margin-bottom: 25px;
        }

        .intro h2 {
            color: #245c43;
            margin-bottom: 8px;
        }

        .intro p {
            color: #68766d;
            font-size: 14px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
        }

        .card {
            background: white;
            padding: 22px;
            border-radius: 10px;
            box-shadow: 0 3px 12px #0000000d;
            border-top: 4px solid #28734d;
            display: flex;
            flex-direction: column;
            min-height: 190px;
        }

        .card h3 {
            margin: 0 0 10px;
            font-size: 18px;
        }

        .card p {
            color: #68766d;
            font-size: 13px;
            line-height: 1.5;
            margin: 0 0 20px;
            flex-grow: 1;
        }

        .button {
            display: block;
            width: 100%;
            padding: 12px 10px;
            background: #28734d;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            font-size: 13px;
        }

        .button:hover {
            background: #1d593b;
        }

        .fetch {
            border-top-color: #2874a6;
        }

        .fetch .button {
            background: #2874a6;
        }

        .fetch .button:hover {
            background: #1d5b83;
        }

        .insert {
            border-top-color: #28734d;
        }

        .update {
            border-top-color: #c18a22;
        }

        .update .button {
            background: #b77d15;
        }

        .update .button:hover {
            background: #93630f;
        }

        .delete {
            border-top-color: #b83b3b;
        }

        .delete .button {
            background: #b83b3b;
        }

        .delete .button:hover {
            background: #922c2c;
        }

        .database {
            border-top-color: #6652a3;
        }

        .database .button {
            background: #6652a3;
        }

        .database .button:hover {
            background: #4f3f83;
        }

        .section-title {
            margin: 30px 0 15px;
            color: #245c43;
            font-size: 19px;
        }

        footer {
            text-align: center;
            padding: 22px;
            color: #738077;
            font-size: 12px;
        }

        @media (max-width: 750px) {
            .grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 480px) {
            .grid {
                grid-template-columns: 1fr;
            }

            header h1 {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>

<header>
    <h1>Ghana Grocery Inventory</h1>
    <p>PDO Methods Activity | Grocery Database Management System</p>
</header>

<main class="container">

    <section class="intro">
        <h2>Inventory Dashboard</h2>
        <p>Select a command below to manage and view grocery records.</p>
    </section>

    <h2 class="section-title">PDO Commands</h2>

    <section class="grid">

        <div class="card fetch">
            <h3>View All Records</h3>
            <p>Display grocery products and their details using PDO fetchAll().</p>
            <a class="button" href="fetch_all.php">View All Items</a>
        </div>

        <div class="card fetch">
            <h3>Fetch One Record</h3>
            <p>Retrieve and display one grocery product using PDO fetch().</p>
            <a class="button" href="fetch.php">Fetch One Item</a>
        </div>

        <div class="card insert">
            <h3>Insert New Item</h3>
            <p>Add a new grocery product to the database using a form.</p>
            <a class="button" href="insert.php">Add Grocery Item</a>
        </div>

        <div class="card update">
            <h3>Update Item</h3>
            <p>Find a product and edit its information, price, or stock.</p>
            <a class="button" href="update.php">Update Grocery Item</a>
        </div>

        <div class="card delete">
            <h3>Delete Item</h3>
            <p>Find a product, review its details, and confirm deletion.</p>
            <a class="button" href="delete.php">Delete Grocery Item</a>
        </div>

        <div class="card database">
            <h3>Database Management</h3>
            <p>Open phpMyAdmin to inspect the database and grocery records.</p>
            <a class="button" href="http://localhost/phpmyadmin" target="_blank" rel="noopener">Open phpMyAdmin</a>
        </div>

    </section>

    <h2 class="section-title">Database Information</h2>

    <section class="card">
        <h3>Ghana Grocery Database</h3>
        <p>
            Database: ghana_grocery_db<br>
            Table: groceries<br>
            Connection: PHP Data Objects (PDO)<br>
            Server: MySQL
        </p>
        <a class="button" href="fetch_all.php">Browse Grocery Inventory</a>
    </section>

</main>

<footer>
    Ghana Grocery Inventory System | PDO Methods Activity
</footer>

</body>
</html>
