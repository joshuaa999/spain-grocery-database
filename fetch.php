
<?php
require_once "dbconfig.php";

// Select one grocery record.
$sql = "SELECT * FROM grocery_items WHERE item_id = :item_id";
$stmt = $pdo->prepare($sql);

// Search for the record with item_id = 1.
$stmt->execute(["item_id" => 1]);

// Fetch one record as an associative array.
$item = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fetch Item | Spain Grocery</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f3f6f4;
            color: #26352d;
        }

        .navigation {
            padding: 15px 6%;
            background: white;
            border-bottom: 1px solid #e1e9e3;
        }

        .navigation a {
            display: inline-block;
            margin: 4px 12px 4px 0;
            color: #2563eb;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
        }

        .navigation a:hover {
            text-decoration: underline;
        }

        header {
            background: #173f35;
            color: white;
            padding: 25px 6%;
        }

        header h1 {
            margin: 0 0 7px;
        }

        header p {
            margin: 0;
            color: #d5e5dc;
        }

        main {
            max-width: 1100px;
            width: 90%;
            margin: 30px auto;
        }

        .panel {
            background: white;
            padding: 25px;
            border: 1px solid #e1e9e3;
            border-radius: 12px;
        }

        h2 {
            margin-top: 0;
        }

        pre {
            padding: 20px;
            background: #f3f6f4;
            border: 1px solid #e1e9e3;
            border-radius: 8px;
            overflow-x: auto;
            white-space: pre-wrap;
        }
    </style>
</head>

<body>

<nav class="navigation">
    <a href="display_table.php">Home</a>
    <a href="fetch.php">Fetch</a>
    <a href="fetch_all.php">Fetch All</a>
    <a href="insert.php">Insert</a>
    <a href="update.php">Update</a>
    <a href="delete.php">Delete</a>
</nav>

<header>
    <h1>Spain Grocery</h1>
    <p>Inventory Management System</p>
</header>

<main>
    <section class="panel">
        <h2>Fetch One Grocery Record</h2>
        <p>This page demonstrates PDO's <code>fetch()</code> method.</p>

        <pre><?php print_r($item); ?></pre>
    </section>
</main>

</body>
</html>
