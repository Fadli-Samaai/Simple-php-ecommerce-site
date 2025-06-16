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
                $count = 0;
                $is_submission_valid = false;

                if (!empty($_GET)) {
                    foreach ($_GET as $value) {
                        if (empty($value)) {
                            $count++;
                        }
                    }

                    if ($count == 0) {
                        $is_submission_valid = true;
                    }
                }
                
                if (!$is_submission_valid && !empty($_GET)) {
                    echo "<div class='status-message status-error'>";
                    echo "<h3>Oops! There was a problem.</h3>";
                    echo "<p>Please fill in all fields. You left out $count field(s).</p>";
                    echo "<a href='RegisterUser.php' class='btn'>Return to Form</a>";
                    echo "</div>";

                } elseif ($is_submission_valid) {
                    $fname = $_GET['firstname'];
                    $lname = $_GET['lastname'];
                    $email = $_GET['emailaddress'];
                    $phone = $_GET['phone'];
                    $idnum = $_GET['idnum'];
                    $address = $_GET['address'];

                    $sql = "INSERT INTO customer (customer_first_name, customer_last_name, customer_phone, customer_email, customer_address, customer_sa_id)
                            VALUES ('$fname', '$lname', '$phone', '$email', '$address', '$idnum')";

                    if ($conn->query($sql) === TRUE) {
                        echo "<div class='status-message status-success'>";
                        echo "<h3>Registration Successful!</h3>";
                        echo "<p>Welcome, " . htmlspecialchars($fname) . " " . htmlspecialchars($lname) . ". You can now proceed to place an order.</p>";
                        echo "<a href='ProcessOrder.php' class='btn'>Place an Order</a>";
                        echo "</div>";
                    } else {
                        echo "<div class='status-message status-error'>";
                        echo "<h3>Registration Failed</h3>";
                        echo "<p>An error occurred while saving your information. Please try again.</p>";
                        echo "<a href='RegisterUser.php' class='btn'>Return to Form</a>";
                        echo "</div>";
                    }
                } else {
                    echo "<div class='form-container'>";
                    echo "<h2>Register an Account</h2>";
                    echo "<p>Fill out the form on our registration page to create your account.</p>";
                    echo "<a href='RegisterUser.php' class='btn'>Go to Registration Form</a>";
                    echo "</div>";
                }

                $conn->close();
                ?>
            </main>
        </div>
    </div>
</body>
</html>