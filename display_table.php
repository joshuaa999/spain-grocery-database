
<?php
require_once "dbconfig.php";

$sql = "SELECT * FROM grocery_items ORDER BY item_id ASC";
$stmt = $pdo->query($sql);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

$totalItems = count($items);
$totalStock = array_sum(array_column($items, "stock_quantity"));
$totalBrands = count(array_unique(array_column($items, "brand_name")));
$totalCategories = count(array_unique(array_column($items, "category")));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spain Grocery | Inventory Dashboard</title>

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

        .header {
            background: #173f35;
            color: white;
            padding: 28px 6%;
        }

        .header h1 {
            margin: 0 0 8px;
            font-size: 30px;
        }

        .header p {
            margin: 0;
            color: #d5e5dc;
            font-size: 14px;
        }

        .container {
            width: 88%;
            max-width: 1450px;
            margin: 30px auto;
        }

        .section-heading {
            margin-bottom: 20px;
        }

        .section-heading h2 {
            margin: 0 0 6px;
            font-size: 23px;
        }

        .section-heading p {
            margin: 0;
            color: #6d7b72;
            font-size: 14px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 28px;
        }

        .card {
            background: white;
            padding: 22px;
            border-radius: 12px;
            border: 1px solid #e1e9e3;
            box-shadow: 0 3px 12px rgba(25, 55, 38, 0.05);
        }

        .card-label {
            color: #718077;
            font-size: 13px;
            margin-bottom: 12px;
        }

        .card-value {
            color: #173f35;
            font-size: 29px;
            font-weight: bold;
        }

        .table-panel {
            background: white;
            border: 1px solid #e1e9e3;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 3px 12px rgba(25, 55, 38, 0.05);
        }

        .table-top {
            padding: 22px;
            border-bottom: 1px solid #e7ece8;
        }

        .table-top h3 {
            margin: 0 0 6px;
            font-size: 18px;
        }

        .table-top p {
            margin: 0 0 16px;
            font-size: 13px;
            color: #718077;
        }

        .search {
            width: 100%;
            max-width: 400px;
            padding: 11px 13px;
            border: 1px solid #ccd8cf;
            border-radius: 7px;
            font-size: 14px;
            outline: none;
        }

        .search:focus {
            border-color: #34745b;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            white-space: nowrap;
            font-size: 13px;
        }

        thead {
            background: #edf4ef;
        }

        th {
            text-align: left;
            padding: 14px 16px;
            color: #315744;
            font-weight: bold;
        }

        td {
            padding: 13px 16px;
            border-top: 1px solid #edf0ed;
        }

        tbody tr:hover {
            background: #f5f9f6;
        }

        .id {
            color: #77857c;
        }

        .brand {
            font-weight: bold;
            color: #315744;
        }

        .category {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 20px;
            background: #edf4ef;
            color: #315744;
            font-size: 12px;
        }

        .price {
            font-weight: bold;
        }

        .stock {
            font-weight: bold;
        }

        .empty-message {
            padding: 24px;
            text-align: center;
            color: #718077;
        }

        .footer {
            text-align: center;
            padding: 25px;
            color: #7a887f;
            font-size: 12px;
        }

        @media (max-width: 900px) {
            .cards {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .container {
                width: 94%;
            }
        }

        @media (max-width: 480px) {
            .header h1 {
                font-size: 24px;
            }

            .cards {
                grid-template-columns: 1fr 1fr;
                gap: 10px;
            }

            .card {
                padding: 15px;
            }

            .card-value {
                font-size: 23px;
            }
        }
        
    </style>
</head>
<body>
<div style="padding: 15px 6%; background: white;">
    <a href="display_table.php">Home</a> |
    <a href="fetch.php">Fetch</a> |
    <a href="fetch_all.php">Fetch All</a> |
    <a href="insert.php">Insert</a> |
    <a href="update.php">Update</a> |
    <a href="delete.php">Delete</a>
</div>
<header class="header">
    <h1>Spain Grocery</h1>
    <p>Inventory Management Dashboard · Spanish Grocery Products</p>
</header>

<main class="container">

    <div class="section-heading">
        <h2>Inventory Overview</h2>
        <p>Monitor your grocery items, brands, categories, and stock levels.</p>
    </div>

    <section class="cards">
        <div class="card">
            <div class="card-label">Total Items</div>
            <div class="card-value"><?= $totalItems ?></div>
        </div>

        <div class="card">
            <div class="card-label">Total Stock Units</div>
            <div class="card-value"><?= number_format($totalStock) ?></div>
        </div>

        <div class="card">
            <div class="card-label">Brands</div>
            <div class="card-value"><?= $totalBrands ?></div>
        </div>

        <div class="card">
            <div class="card-label">Categories</div>
            <div class="card-value"><?= $totalCategories ?></div>
        </div>
    </section>

    <section class="table-panel">
        <div class="table-top">
            <h3>Grocery Inventory</h3>
            <p>Browse all available records in your database.</p>

            <input
                type="text"
                id="searchInput"
                class="search"
                placeholder="Search item, brand, category, or country..."
                aria-label="Search grocery inventory"
            >
        </div>

        <div class="table-wrapper">
            <table id="inventoryTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Item Name</th>
                        <th>Brand</th>
                        <th>Category</th>
                        <th>Country</th>
                        <th>Price (€)</th>
                        <th>Stock</th>
                        <th>Expiry Date</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($items as $item): ?>
                        <tr>
                            <td class="id">
                                <?= htmlspecialchars((string)$item["item_id"]) ?>
                            </td>
                            <td>
                                <?= htmlspecialchars($item["item_name"]) ?>
                            </td>
                            <td class="brand">
                                <?= htmlspecialchars($item["brand_name"]) ?>
                            </td>
                            <td>
                                <span class="category">
                                    <?= htmlspecialchars($item["category"]) ?>
                                </span>
                            </td>
                            <td>
                                <?= htmlspecialchars($item["country_of_origin"]) ?>
                            </td>
                            <td class="price">
                                €<?= number_format((float)$item["price_eur"], 2) ?>
                            </td>
                            <td class="stock">
                                <?= number_format((int)$item["stock_quantity"]) ?>
                            </td>
                            <td>
                                <?= htmlspecialchars($item["expiry_date"] ?? "N/A") ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div id="emptyMessage" class="empty-message" hidden>
                No matching grocery records found.
            </div>
        </div>
    </section>

</main>

<footer class="footer">
    Spain Grocery Inventory System · Powered by PHP, PDO, MySQL, HTML and CSS
</footer>

<script>
    const searchInput = document.getElementById("searchInput");
    const tableRows = document.querySelectorAll("#inventoryTable tbody tr");
    const emptyMessage = document.getElementById("emptyMessage");

    searchInput.addEventListener("input", function () {
        const searchTerm = this.value.toLowerCase().trim();
        let visibleRows = 0;

        tableRows.forEach(function (row) {
            const matches = row.textContent.toLowerCase().includes(searchTerm);

            row.hidden = !matches;

            if (matches) {
                visibleRows++;
            }
        });

        emptyMessage.hidden = visibleRows !== 0;
    });
</script>

</body>
</html>
