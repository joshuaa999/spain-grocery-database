
<?php
require_once "dbconfig.php";

$message = "";
$messageType = "";
$item = null;

// Update the selected record when the form is submitted.
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $itemId = filter_input(INPUT_POST, "item_id", FILTER_VALIDATE_INT);
    $itemName = trim($_POST["item_name"] ?? "");
    $brandName = trim($_POST["brand_name"] ?? "");
    $category = trim($_POST["category"] ?? "");
    $country = trim($_POST["country_of_origin"] ?? "");
    $price = $_POST["price_eur"] ?? "";
    $stock = $_POST["stock_quantity"] ?? "";
    $expiryDate = $_POST["expiry_date"] ?? "";

    if (
        !$itemId || $itemName === "" || $brandName === "" ||
        $category === "" || $country === "" ||
        !is_numeric($price) || $price < 0 ||
        filter_var($stock, FILTER_VALIDATE_INT) === false ||
        $stock < 0
    ) {
        $message = "Please enter valid information in all required fields.";
        $messageType = "error";
    } else {
        $sql = "UPDATE grocery_items
                SET item_name = :item_name,
                    brand_name = :brand_name,
                    category = :category,
                    country_of_origin = :country,
                    price_eur = :price,
                    stock_quantity = :stock,
                    expiry_date = :expiry_date
                WHERE item_id = :item_id";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            "item_name" => $itemName,
            "brand_name" => $brandName,
            "category" => $category,
            "country" => $country,
            "price" => $price,
            "stock" => $stock,
            "expiry_date" => $expiryDate === "" ? null : $expiryDate,
            "item_id" => $itemId
        ]);

        $message = $stmt->rowCount() > 0
            ? "Grocery item updated successfully!"
            : "No changes were made, or the item ID does not exist.";
        $messageType = "success";

        // Load the current record again.
        $item = $pdo->prepare(
            "SELECT * FROM grocery_items WHERE item_id = :item_id"
        );
        $item->execute(["item_id" => $itemId]);
        $item = $item->fetch(PDO::FETCH_ASSOC);
    }
}

// Load an existing record when an ID is selected in the URL.
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"])) {
    $itemId = filter_var($_GET["id"], FILTER_VALIDATE_INT);

    if ($itemId) {
        $stmt = $pdo->prepare(
            "SELECT * FROM grocery_items WHERE item_id = :item_id"
        );
        $stmt->execute(["item_id" => $itemId]);
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
    <title>Update Grocery Item | Spain Grocery</title>

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
            max-width: 850px;
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
            margin-bottom: 17px;
        }

        label { font-size: 13px; font-weight: bold; }

        input {
            width: 100%;
            padding: 11px;
            border: 1px solid #ccd8cf;
            border-radius: 7px;
            font-size: 14px;
        }

        input:focus {
            outline: 2px solid #b8d7c4;
            border-color: #34745b;
        }

        button {
            border: none;
            background: #236247;
            color: white;
            padding: 12px 20px;
            border-radius: 7px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover { background: #173f35; }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: #236247;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
        }

        .id-help {
            padding: 14px;
            background: #edf4ef;
            border-radius: 7px;
            font-size: 14px;
            margin-bottom: 20px;
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
        <h2>Update Grocery Item</h2>
        <p class="description">
            Select a record by ID, then edit its details.
        </p>

        <?php if ($message !== ""): ?>
            <div class="message <?= htmlspecialchars($messageType) ?>">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <?php if (!$item): ?>
            <form method="GET" action="update.php">
                <div class="field">
                    <label for="id">Grocery Item ID</label>
                    <input type="number" id="id" name="id"
                           min="1" required>
                </div>
                <button type="submit">Find Item</button>
            </form>

            <div class="id-help">
                Tip: Find the item's ID in your inventory table before editing.
            </div>
        <?php else: ?>
            <div class="id-help">
                You are editing grocery item ID:
                <strong><?= htmlspecialchars((string)$item["item_id"]) ?></strong>
            </div>

            <form method="POST" action="update.php">
                <input type="hidden" name="item_id"
                       value="<?= htmlspecialchars((string)$item["item_id"]) ?>">

                <div class="field">
                    <label for="item_name">Item Name</label>
                    <input type="text" id="item_name" name="item_name"
                           maxlength="100" required
                           value="<?= htmlspecialchars($item["item_name"]) ?>">
                </div>

                <div class="field">
                    <label for="brand_name">Brand Name</label>
                    <input type="text" id="brand_name" name="brand_name"
                           maxlength="100" required
                           value="<?= htmlspecialchars($item["brand_name"]) ?>">
                </div>

                <div class="field">
                    <label for="category">Category</label>
                    <input type="text" id="category" name="category"
                           maxlength="50" required
                           value="<?= htmlspecialchars($item["category"]) ?>">
                </div>

                <div class="field">
                    <label for="country_of_origin">Country of Origin</label>
                    <input type="text" id="country_of_origin"
                           name="country_of_origin" maxlength="50" required
                           value="<?= htmlspecialchars($item["country_of_origin"]) ?>">
                </div>

                <div class="field">
                    <label for="price_eur">Price (€)</label>
                    <input type="number" id="price_eur" name="price_eur"
                           min="0" step="0.01" required
                           value="<?= htmlspecialchars((string)$item["price_eur"]) ?>">
                </div>

                <div class="field">
                    <label for="stock_quantity">Stock Quantity</label>
                    <input type="number" id="stock_quantity"
                           name="stock_quantity" min="0" step="1" required
                           value="<?= htmlspecialchars((string)$item["stock_quantity"]) ?>">
                </div>

                <div class="field">
                    <label for="expiry_date">Expiry Date (optional)</label>
                    <input type="date" id="expiry_date" name="expiry_date"
                           value="<?= htmlspecialchars($item["expiry_date"] ?? "") ?>">
                </div>

                <button type="submit">Save Changes</button>
            </form>
        <?php endif; ?>

        <a class="back-link" href="display_table.php">
            ← Back to Inventory
        </a>
    </section>
</main>

</body>
</html>
