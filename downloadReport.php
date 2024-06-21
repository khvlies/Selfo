<?php
session_start();
include('dbconn_selfo.php');

// Ensure the user is authenticated before allowing the download
if (!isset($_SESSION['admin'])) {
    header("Location: loginpage.php");
    exit();
}

// Fetch data
$sql = "SELECT id, cardholder_name, card_number, amount, payment_date FROM payment";
$result = mysqli_query($dbconn, $sql);

if (!$result) {
    die("Invalid query: " . mysqli_error($dbconn));
}

$payments = [];
while ($row = mysqli_fetch_assoc($result)) {
    $payments[] = $row;
}

// Close the database connection
mysqli_close($dbconn);

// Set headers to force download of the JSON file
header('Content-Type: application/json');
header('Content-Disposition: attachment; filename="payment_report.json"');

// Output the JSON data
echo json_encode($payments, JSON_PRETTY_PRINT);
?>
