<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Process</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .payment-result {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
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
            margin-top: 20px;
        }
        .btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="payment-result">
    <?php
    session_start();
    include("dbconn_selfo.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $cardName = htmlspecialchars($_POST['cardName']);
        $cardNumber = htmlspecialchars($_POST['cardNumber']);
        $amount = 65.00; // Fixed amount

        $stmt = $dbconn->prepare("INSERT INTO payment (cardholder_name, card_number) VALUES (?, ?)");
        $stmt->bind_param("ss", $cardName, $cardNumber);

        if ($stmt->execute()) {
            // Retrieve premium user details from session
            $b_name = $_SESSION['premiumname'];
            $b_pass = $_SESSION['premiumpass'];
            $b_phone = $_SESSION['premiumphone'];
            $b_email = $_SESSION['premiumemail'];

            // Insert premium user details into the database
            $sqlInsert = "INSERT INTO premium_user (premium_name, premium_password, premium_phone, premium_email) VALUES (?, ?, ?, ?)";
            $stmt2 = $dbconn->prepare($sqlInsert);
            $stmt2->bind_param("ssss", $b_name, $b_pass, $b_phone, $b_email);
            
            if ($stmt2->execute()) {
                echo "<h2>Payment Processed</h2>";
                echo "<p>Cardholder Name: " . $cardName . "</p>";
                echo "<p>Card Number: " . $cardNumber . "</p>";
                echo "<p>Amount: RM " . number_format($amount, 2, '.', '') . "</p>";
                echo "<p>Account successfully created!</p>";
                echo '<button class="btn" onclick="redirectToLogin()">OK</button>';
            } else {
                echo "<p>Error: " . $stmt2->error . "</p>";
            }

            $stmt2->close();
        } else {
            echo "<p>Error: " . $stmt->error . "</p>";
        }

        $stmt->close();
        $dbconn->close();
    } else {
        echo "<p>Invalid request.</p>";
    }
    ?>
</div>

<script>
function redirectToLogin() {
    window.location.href = "loginpage.php";
}
</script>

</body>
</html>
