<?php
require_once 'config/dbconn.php';

$subtotal = 0;
$vat_percentage = 0.15;
$order_items = [];
$customer_data = null;
$error_message = '';

if (isset($_POST['orderemail']) && !empty($_POST['orderemail']) && isset($_POST['products']) && is_array($_POST['products'])) {
    
    $emailaddress = $_POST['orderemail'];
    $selected_product_ids = $_POST['products'];

    $sql = "SELECT customer_id, customer_first_name, customer_last_name, customer_address FROM customer WHERE customer_email = '" . $conn->real_escape_string($emailaddress) . "'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $customer_data = $result->fetch_assoc();
        $cid = $customer_data['customer_id'];
        
        $conn->begin_transaction();

        try {
            $date = date("Y-m-d");
            $sql_order = "INSERT INTO orders (customer_id, order_date) VALUES ('$cid', '$date')";
            if (!$conn->query($sql_order)) {
                throw new Exception("Could not create order record.");
            }
            $order_id = $conn->insert_id;

            $product_ids_string = implode(',', array_map('intval', $selected_product_ids));
            $sql_products = "SELECT product_id, product_name, unit_price FROM products WHERE product_id IN ($product_ids_string)";
            $products_result = $conn->query($sql_products);

            while ($product = $products_result->fetch_assoc()) {
                $product_id = $product['product_id'];
                $unit_price = $product['unit_price'];

                $order_items[] = $product;
                $subtotal += $unit_price;

                $sql_details = "INSERT INTO orderdetails (order_id, product_id, unit_price) VALUES ('$order_id', '$product_id', '$unit_price')";
                if (!$conn->query($sql_details)) {
                    throw new Exception("Failed to save order detail for product ID $product_id.");
                }

                $sql_update_stock = "UPDATE products SET units_in_stock = units_in_stock - 1 WHERE product_id = $product_id";
                if (!$conn->query($sql_update_stock)) {
                    throw new Exception("Failed to update stock for product ID $product_id.");
                }
            }
            $conn->commit();

        } catch (Exception $e) {
            $conn->rollback();
            $error_message = $e->getMessage();
        }

    } else {
        $error_message = "No registered customer found with that email address. Please check the email or register first.";
    }
} else {
    if (empty($_POST['products'])) {
        $error_message = "You did not select any products to order.";
    } else {
        $error_message = "Your order could not be processed. Please ensure you provide a valid email address.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Receipt</title>
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
                <h1>Order Receipt</h1>
            </header>

            <main class="content-area">
                <?php if ($error_message): ?>
                    <div class="status-message status-error">
                        <h3>Order Could Not Be Processed</h3>
                        <p><?php echo htmlspecialchars($error_message); ?></p>
                        <a href="ProcessOrder.php" class="btn">Return to Order Page</a>
                    </div>
                <?php elseif ($customer_data && !empty($order_items)): ?>
                    <div class="receipt-container">
                        <div class="receipt-header">
                            <h2>Thank You For Your Order!</h2>
                            <p>Order Date: <?php echo date("F j, Y"); ?></p>
                        </div>

                        <div class="customer-details">
                            <h3>Shipping To:</h3>
                            <p>
                                <strong><?php echo htmlspecialchars($customer_data['customer_first_name'] . ' ' . $customer_data['customer_last_name']); ?></strong><br>
                                <?php echo htmlspecialchars($customer_data['customer_address']); ?><br>
                                Email: <?php echo htmlspecialchars($_POST['orderemail']); ?>
                            </p>
                        </div>

                        <div class="receipt-details">
                            <h3>Order Summary</h3>
                            <table class="receipt-table">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($order_items as $item): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                                        <td>R <?php echo number_format($item['unit_price'], 2); ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>Subtotal</td>
                                        <td>R <?php echo number_format($subtotal, 2); ?></td>
                                    </tr>
                                    <tr>
                                        <td>VAT (15%)</td>
                                        <td>R <?php $vat = $subtotal * $vat_percentage; echo number_format($vat, 2); ?></td>
                                    </tr>
                                    <tr class="total-row">
                                        <td>Total</td>
                                        <td>R <?php $total = $subtotal + $vat; echo number_format($total, 2); ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="receipt-footer">
                            <p>A confirmation has been sent to your email address.</p>
                            <a href="index.php" class="btn">Return to Home Page</a>
                        </div>
                    </div>
                <?php endif; ?>
            </main>
        </div>
    </div>
    <?php
    $conn->close();
    ?>
</body>
</html>