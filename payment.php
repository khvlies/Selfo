<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/icon.png"/>
    <title>Payment Form</title>
    <link rel="stylesheet" href="css/nav-S.css">
</head>
<body>
    <div class="header">
        <div class="logo">
        <a href="<?php echo htmlspecialchars($mainPageURL); ?>"><img src="images/selfo.jpg" alt="Company Logo"></a>
        </div>
    </div>
<main style="margin-top: 100px">
<div class="container">
    <h2>Payment Form</h2>
    <form action="payment_process.php" method="POST">
        <?php
        session_start();
        // Save user details in session
        $_SESSION['premiumname'] = $_POST['premiumname'];
        $_SESSION['premiumpass'] = $_POST['premiumpass'];
        $_SESSION['premiumphone'] = $_POST['premiumphone'];
        $_SESSION['premiumemail'] = $_POST['premiumemail'];
        ?>
        <div class="form-group">
            <label for="cardName">Cardholder Name</label>
            <input type="text" id="cardName" name="cardName" required>
        </div>
        <div class="form-group">
            <label for="cardNumber">Card Number</label>
            <input type="text" id="cardNumber" name="cardNumber" required>
        </div>
        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" id="amount" name="amount" value="65.00" readonly>
        </div>
        <button type="submit" class="btn btn-primary">Submit Payment</button>
        <a class="btn btn-outline-primary" href="signupType.php" role="button">Cancel</a>
    </form>
</div>
</main>
</html>