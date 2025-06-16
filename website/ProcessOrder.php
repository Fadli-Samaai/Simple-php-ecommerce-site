<?php
require_once 'config/dbconn.php';

$sql = "SELECT product_id, product_name, unit_price, units_in_stock FROM products ORDER BY product_id";
$products_result = $conn->query($sql);

$image_map = [
    1 => 'xbox_series_s.jpg',
    2 => 'xbox_series_x.jpg',
    3 => 'playstation_5_disc.jpg',
    4 => 'nintendo_switch.jpg',
    5 => 'playstation_5_digital.jpg'
];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place an Order</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="site-container">
        <aside class="sidebar">
            <nav class="navigation">
                <h3>Navigation</h3>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="RegisterUser.php">Register</a></li>
                    <li><a href="ProcessOrder.php" class="active">Place Order</a></li>
                </ul>
            </nav>
        </aside>

        <div class="main-content">
            <header class="header">
                <h1>Place Your Order</h1>
            </header>

            <main class="content-area">
                <h2>Select Items for Your Order</h2>
                
                <form action="OrderReciept.php" method="POST">
                    <div style="overflow-x:auto;"> <table class="order-table">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Select</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($products_result && $products_result->num_rows > 0) {
                                    while ($product = $products_result->fetch_assoc()) {
                                        $product_id = $product['product_id'];             
                                        $image_file = isset($image_map[$product_id]) ? $image_map[$product_id] : 'default.jpg';
                                        
                                        echo "<tr>";
                                        echo "<td><img src='images/" . htmlspecialchars($image_file) . "' alt='" . htmlspecialchars($product['product_name']) . "'></td>";
                                        echo "<td class='product-name'>" . htmlspecialchars($product['product_name']) . "</td>";
                                        echo "<td class='price'>R " . number_format($product['unit_price'], 2) . "</td>";
                                        echo "<td>";
                                        if ($product['units_in_stock'] > 0) {
                                            echo "<input type='checkbox' name='products[]' value='" . $product_id . "'>";
                                        } else {
                                            echo "<span class='out-of-stock'>Out of Stock</span>";
                                        }
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='4'>No products available at the moment.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="order-submission-form">
                        <h3>Confirm Your Order</h3>
                        <div class="form-group">
                            <label for="orderemail">Enter your registered email address:</label>
                            <input type="email" id="orderemail" name="orderemail" placeholder="e.g., you@example.com" required>
                        </div>
                        <button type="submit" class="btn">Submit Order</button>
                    </div>
                </form>
            </main>
        </div>
    </div>
    <?php
    $conn->close();
    ?>
</body>
</html>