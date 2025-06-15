<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-t">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
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
                <h1>Create an Account</h1>
            </header>

            <main class="content-area">
                <div class="form-container">
                    <h2>Fill in the form below to register:</h2>
                    <form action="Register.php" method="POST">
                        <div class="form-group">
                            <label for="firstname">First Name</label>
                            <input type="text" id="firstname" name="firstname" placeholder="Your first name..." required>
                        </div>
                        <div class="form-group">
                            <label for="lastname">Last Name</label>
                            <input type="text" id="lastname" name="lastname" placeholder="Your last name..." required>
                        </div>
                        <div class="form-group">
                            <label for="emailaddress">Email Address</label>
                            <input type="email" id="emailaddress" name="emailaddress" placeholder="Your email address..." required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Contact Number</label>
                            <input type="tel" id="phone" name="phone" placeholder="Contact number..." required>
                        </div>
                        <div class="form-group">
                            <label for="address">Delivery Address</label>
                            <input type="text" id="address" name="address" placeholder="Enter delivery address..." required>
                        </div>
                        <div class="form-group">
                            <label for="idnum">SA ID Number</label>
                            <input type="text" id="idnum" name="idnum" placeholder="Your ID number..." required>
                        </div>
                        <button type="submit" class="btn">Register</button>
                    </form>
                </div>
            </main>
        </div>
    </div>
</body>
</html>