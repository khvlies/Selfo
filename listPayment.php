<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/icon.png"/>
    <title>Payment</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include('nav-A.php'); ?>
    <main>
    <div class="container my-5">
        <h2>Payment Transaction Record</h2>
        <a class="btn btn-secondary" href="downloadReport.php" role="button">Download Report</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>CARDHOLDER NAME</th>
                    <th>CARD NUMBER</th>
                    <th>AMOUNT</th>
                    <th>PAYMENT DATE</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "selfodb";

                // Create connection
                $connection = new mysqli($servername, $username, $password, $database);

                // Check connection
                if ($connection->connect_error) {
                    die("Connection failed: " . $connection->connect_error);
                }

                // Read all rows from the database table
                $sql = "SELECT * FROM payment";
                $result = $connection->query($sql);

                if (!$result) {
                    die("Invalid query: " . $connection->error);
                }

                // Read data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['cardholder_name']}</td>
                    <td>{$row['card_number']}</td>
                    <td>{$row['amount']}</td>
                    <td>{$row['payment_date']}</td>
                </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    </main>
</body>
</html>
