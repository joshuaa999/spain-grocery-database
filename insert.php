
<?php
require_once "dbconfig.php";

$message = "";
$messageType = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $itemName = trim($_POST["item_name"] ?? "");
    $brandName = trim($_POST["brand_name"] ?? "");
    $category = trim($_POST["category"] ?? "");
    $country = trim($_POST["country_of_origin"] ?? "Spain");
    $price = $_POST["price_eur"] ?? "";
    $stock = $_POST["stock_quantity"] ?? "";
    $expiryDate = $_POST["expiry_date"] ?? "";

    if (
        $itemName === "" || $brandName === "" ||
        $category === "" || $country === "" ||
        !is_numeric($price) || $price < 0 ||
        filter_var($stock, FILTER_VALIDATE_INT) === false ||
        $stock < 0
    ) {
        $message = "Please enter valid information in all required fields.";
        $messageType = "error";
    } else {
        try {
            $sql = "INSERT INTO grocery_items
                (item_name, brand_name, category, country_of_origin,
                 price_eur, stock_quantity, expiry_date)
                VALUES
                (:item_name, :brand_name, :category, :country,
                 :price, :stock, :expiry_date)";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                "item_name" => $itemName,
                "brand_name" => $brandName,
                "category" => $category,
                "country" => $country,
                "price" => $price,
                "stock" => $stock,
                "expiry_date" => $expiryDate === "" ? null : $expiryDate
            ]);

            $message = "Grocery item added successfully!";
            $messageType = "success";
        } catch (PDOException $e) {
            $message = "Unable to add the item. Please check your entries.";
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
    <title>Add Grocery Item | Spain Grocery</title>

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

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .full { grid-column: 1 / -1; }

        label {
            font-size: 13px;
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 11px;
            border: 1px solid #ccd8cf;
            border-radius: 7px;
            font-size: 14px;
            background: white;
        }

        input:focus, select:focus {
            outline: 2px solid #b8d7c4;
            border-color: #34745b;
        }

        button {
            margin-top: 22px;
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

        .message {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 7px;
            font-size: 14px;
        }

        .success {
            background: #e7f5eb;
            color: #206338;
        }

        .error {
            background: #fbe9e7;
            color: #9c2f25;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: #236247;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
        }

        @media (max-width: 600px) {
            .form-grid { grid-template-columns: 1fr; }
            .full { grid-column: auto; }
            .panel { padding: 20px; }
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
        <h2>Add Grocery Item</h2>
        <p class="description">
            Enter the product details below to add a new inventory record.
        </p>

        <?php if ($message !== ""): ?>
            <div class="message <?= htmlspecialchars($messageType) ?>">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="insert.php">
            <div class="form-grid">
                <div class="field">
                    <label for="item_name">Item Name *</label>
                    <input type="text" id="item_name" name="item_name"
                           maxlength="100" required>
                </div>

                <div class="field">
                    <label for="brand_name">Brand Name *</label>
                    <input type="text" id="brand_name" name="brand_name"
                           maxlength="100" required>
                </div>

                <div class="field">
                    <label for="category">Category *</label>
                    <input type="text" id="category" name="category"
                           maxlength="50" required>
                </div>

                <div class="field">
                    <label for="country_of_origin">Country of Origin *</label>
                    <input type="text" id="country_of_origin"
                           name="country_of_origin" value="Spain"
                           maxlength="50" required>
                </div>

                <div class="field">
                    <label for="price_eur">Price (€) *</label>
                    <input type="number" id="price_eur" name="price_eur"
                           min="0" step="0.01" required>
                </div>

                <div class="field">
                    <label for="stock_quantity">Stock Quantity *</label>
                    <input type="number" id="stock_quantity"
                           name="stock_quantity" min="0" step="1" required>
                </div>

                <div class="field full">
                    <label for="expiry_date">Expiry Date (optional)</label>
                    <input type="date" id="expiry_date" name="expiry_date">
                </div>
            </div>

            <button type="submit">Add Item to Inventory</button>
        </form>

        <a class="back-link" href="display_table.php">
            ← Back to Inventory
        </a>
    </section>
</main>

</body>
</html>
