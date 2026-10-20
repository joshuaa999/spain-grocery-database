
<?php
require_once "dbconfig.php";

$message = "";
$messageType = "";
$deletedItem = null;

// Delete only when the form is submitted.
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $itemId = filter_input(INPUT_POST, "item_id", FILTER_VALIDATE_INT);

    if (!$itemId || $itemId < 1) {
        $message = "Please provide a valid item ID.";
        $messageType = "error";
    } else {
        // Check which item will be deleted.
        $check = $pdo->prepare(
            "SELECT item_name FROM grocery_items WHERE item_id = :id"
        );
        $check->execute(["id" => $itemId]);
        $deletedItem = $check->fetch(PDO::FETCH_ASSOC);

        if ($deletedItem) {
            $delete = $pdo->prepare(
                "DELETE FROM grocery_items WHERE item_id = :id"
            );
            $delete->execute(["id" => $itemId]);

            $message = "Item '" . $deletedItem["item_name"]
                     . "' was deleted successfully.";
            $messageType = "success";
        } else {
            $message = "No grocery item found with that ID.";
            $messageType = "error";
        }
    }
}

// Load a record for preview before deletion.
$item = null;

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"])) {
    $itemId = filter_var($_GET["id"], FILTER_VALIDATE_INT);

    if ($itemId && $itemId > 0) {
        $stmt = $pdo->prepare(
            "SELECT * FROM grocery_items WHERE item_id = :id"
        );
        $stmt->execute(["id" => $itemId]);
        $item = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$item) {
            $message = "No grocery item found with that ID.";
            $messageType = "error";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Grocery Item | Spain Grocery</title>

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f3f6f4;
            color: #26352d;
        }

        header {
            background: #173f35;
            color: white;
            padding: 25px 6%;
        }

        header h1 { margin: 0 0 7px; }
        header p { margin: 0; color: #d5e5dc; }

        main {
            max-width: 750px;
            width: 92%;
            margin: 30px auto;
        }

        .panel {
            background: white;
            padding: 28px;
            border: 1px solid #e1e9e3;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(25, 55, 38, 0.05);
        }

        h2 { margin-top: 0; }

        .description {
            color: #718077;
            font-size: 14px;
            margin-bottom: 24px;
        }

        .message {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 7px;
            font-size: 14px;
        }

        .success { background: #e7f5eb; color: #206338; }
        .error { background: #fbe9e7; color: #9c2f25; }

        .field {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 18px;
        }

        label { font-size: 13px; font-weight: bold; }

        input {
            width: 100%;
            padding: 11px;
            border: 1px solid #ccd8cf;
            border-radius: 7px;
            font-size: 14px;
        }

        button {
            border: none;
            background: #a83232;
            color: white;
            padding: 12px 20px;
            border-radius: 7px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover { background: #842626; }

        .find-button {
            background: #236247;
        }

        .find-button:hover { background: #173f35; }

        .item-preview {
            background: #f7f9f7;
            border: 1px solid #e1e9e3;
            border-radius: 8px;
            padding: 18px;
            margin: 20px 0;
        }

        .item-preview p { margin: 8px 0; }

        .warning {
            color: #9c2f25;
            font-size: 14px;
            margin-bottom: 18px;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: #236247;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
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
        <h2>Delete Grocery Item</h2>
        <p class="description">
            Find a grocery record by ID and review it before deletion.
        </p>

        <?php if ($message !== ""): ?>
            <div class="message <?= htmlspecialchars($messageType) ?>">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <?php if (!$item): ?>
            <form method="GET" action="delete.php">
                <div class="field">
                    <label for="id">Grocery Item ID</label>
                    <input type="number" id="id" name="id"
                           min="1" required>
                </div>
                <button class="find-button" type="submit">Find Item</button>
            </form>
        <?php else: ?>
            <div class="item-preview">
                <p><strong>ID:</strong>
                    <?= htmlspecialchars((string)$item["item_id"]) ?></p>
                <p><strong>Item:</strong>
                    <?= htmlspecialchars($item["item_name"]) ?></p>
                <p><strong>Brand:</strong>
                    <?= htmlspecialchars($item["brand_name"]) ?></p>
                <p><strong>Category:</strong>
                    <?= htmlspecialchars($item["category"]) ?></p>
                <p><strong>Price:</strong>
                    €<?= number_format((float)$item["price_eur"], 2) ?></p>
                <p><strong>Stock:</strong>
                    <?= htmlspecialchars((string)$item["stock_quantity"]) ?></p>
            </div>

            <p class="warning">
                Warning: Deleting this record cannot be undone through this page.
            </p>

            <form method="POST" action="delete.php"
                  onsubmit="return confirm('Are you sure you want to delete this grocery item?');">
                <input type="hidden" name="item_id"
                       value="<?= htmlspecialchars((string)$item["item_id"]) ?>">
                <button type="submit">Confirm Delete</button>
            </form>
        <?php endif; ?>

        <a class="back-link" href="display_table.php">
            ← Back to Inventory
        </a>
    </section>
</main>

</body>
</html>
