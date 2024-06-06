<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .payment-form {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            text-align: center;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="payment-form">
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
        <button type="submit" class="btn">Submit Payment</button>
    </form>
</div>

</body>
</html>