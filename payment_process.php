<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/icon.png"/>
    <title>Payment Process</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #097F94;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #fff;
            margin: 0;
        }
        .payment-result {
            background-color: #fff;
            color: #097F94;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
            text-align: center;
        }
        .payment-result h2 {
            margin-bottom: 20px;
        }
        .btn {
            display: inline-block;
            padding: 15px;
            width: 25px;
            background-color: #097F94;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
            transition: background-color 0.3s, color 0.3s;
            text-decoration: none;
        }
        .btn:hover {
            background-color: #ffffff;
            color: #097F94;
            border: 1px solid #097F94;
        }
        @media (max-width: 600px) {
            .payment-result {
                padding: 20px;
            }
            .btn {
                font-size: 14px;
            }
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

        // Insert payment details into the payment table, including the amount
        $stmt = $dbconn->prepare("INSERT INTO payment (cardholder_name, card_number, amount) VALUES (?, ?, ?)");
        $stmt->bind_param("ssd", $cardName, $cardNumber, $amount);

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
                echo "<p>Cardholder Name: " . htmlspecialchars($cardName) . "</p>";
                echo "<p>Card Number: " . htmlspecialchars($cardNumber) . "</p>";
                echo "<p>Amount: RM " . number_format($amount, 2, '.', '') . "</p>";
                echo "<p>Account successfully created!</p>";
                echo '<a href="#" class="btn" onclick="downloadReceipt()">Download Receipt</a>';
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
    function downloadReceipt() {
        const cardName = '<?php echo htmlspecialchars($cardName); ?>';
        const cardNumber = '<?php echo htmlspecialchars($cardNumber); ?>';
        const amount = '<?php echo number_format($amount, 2, '.', ''); ?>';

        const receiptContent = `
            <!DOCTYPE html>
            <html>
            <head>
                <title>Payment Receipt</title>
                <style>
                    body { font-family: Arial, sans-serif; }
                    .receipt-container {
                        width: 80%;
                        margin: 0 auto;
                        padding: 20px;
                        border: 1px solid #ddd;
                        border-radius: 5px;
                    }
                    h2 {
                        text-align: center;
                    }
                    .details {
                        margin-top: 20px;
                    }
                    .details p {
                        margin: 5px 0;
                    }
                </style>
            </head>
            <body>
                <div class="receipt-container">
                    <h2>Payment Receipt</h2>
                    <div class="details">
                        <p>Cardholder Name: ${cardName}</p>
                        <p>Card Number: ${cardNumber}</p>
                        <p>Amount: RM ${amount}</p>
                        <p>Account successfully created!</p>
                    </div>
                </div>
            </body>
            </html>
        `;

        const blob = new Blob([receiptContent], { type: 'text/html' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'receipt.html';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);

        // Redirect to login page after the download
        setTimeout(() => {
            window.location.href = 'loginpage.php'; // Replace with your actual login page URL
        }, 1000); // Delay to ensure download starts before redirection
    }
</script>

</body>
</html>
