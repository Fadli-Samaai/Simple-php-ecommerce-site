<?php
require_once 'config/dbconn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration Status</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="site-container">
        <aside class="sidebar">
            <nav class="navigation">
                <h3>Navigation</h3>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="RegisterUser.php" class="active">Register</a></li>
                    <li><a href="ProcessOrder.php">Place Order</a></li>
                </ul>
            </nav>
        </aside>

        <div class="main-content">
            <header class="header">
                <h1>Registration Status</h1>
            </header>

            <main class="content-area">
                <?php
                $stmt = null;
                $count = 0;
                $is_submission_valid = false;

                if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
                    foreach ($_POST as $value) {
                        if (empty($value)) {
                            $count++;
                        }
                    }

                    if ($count === 0) {
                        $is_submission_valid = true;
                    }

                    if (!$is_submission_valid) {
                        echo "<div class='status-message status-error'>";
                        echo "<h3>Oops! There was a problem.</h3>";
                        echo "<p>Please fill in all fields. You left out $count field(s).</p>";
                        echo "<a href='RegisterUser.php' class='btn'>Return to Form</a>";
                        echo "</div>";
                    } else {
                        $fname = $_POST['firstname'];
                        $lname = $_POST['lastname'];
                        $email = $_POST['emailaddress'];
                        $phone = $_POST['phone'];
                        $idnum = $_POST['idnum'];
                        $address = $_POST['address'];

                        $stmt = $conn->prepare("INSERT INTO customer 
                            (customer_first_name, customer_last_name, customer_phone, customer_email, customer_address, customer_sa_id) 
                            VALUES (?, ?, ?, ?, ?, ?)");

                        if (!$stmt) {
                            echo "<div class='status-message status-error'>";
                            echo "<h3>Database Error</h3>";
                            echo "<p>Prepare failed: " . htmlspecialchars($conn->error) . "</p>";
                            echo "</div>";
                        } else {
                            $stmt->bind_param("ssssss", $fname, $lname, $phone, $email, $address, $idnum);

                            if ($stmt->execute()) {
                                echo "<div class='status-message status-success'>";
                                echo "<h3>Registration Successful!</h3>";
                                echo "<p>Welcome, " . htmlspecialchars($fname) . " " . htmlspecialchars($lname) . ". You can now proceed to place an order.</p>";
                                echo "<a href='ProcessOrder.php' class='btn'>Place an Order</a>";
                                echo "</div>";
                            } else {
                                echo "<div class='status-message status-error'>";
                                echo "<h3>Registration Failed</h3>";
                                echo "<p>Error: " . htmlspecialchars($stmt->error) . "</p>";
                                echo "<a href='RegisterUser.php' class='btn'>Return to Form</a>";
                                echo "</div>";
                            }
                        }
                    }
                } else {
                    echo "<div class='form-container'>";
                    echo "<h2>Register an Account</h2>";
                    echo "<p>Fill out the form on our registration page to create your account.</p>";
                    echo "<a href='RegisterUser.php' class='btn'>Go to Registration Form</a>";
                    echo "</div>";
                }

                if ($stmt) {
                    $stmt->close();
                }

                $conn->close();
                ?>
            </main>
        </div>
    </div>
</body>
</html>
