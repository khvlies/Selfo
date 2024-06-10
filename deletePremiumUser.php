<?php
//fetch user data
include("userData.php");

// Enable error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$servername = "localhost";
$username = "root";
$password = "";
$database = "selfodb";

// Database connection
$conn = new mysqli($servername, $username, $password, $database);

$errorMessage = "";

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if 'premium_id' is set
        if (isset($_POST['premium_id'])) {
            $id = $_POST['premium_id']; // ID to delete (VARCHAR)
        } else {
            throw new Exception("Error: 'premium_id' not set.");
        }

        // Prepare a delete statement
        $stmt = $conn->prepare("DELETE FROM premium_user WHERE premium_id = ?");
        $stmt->bind_param("s", $id); // "s" indicates the parameter is a string

        // Execute the statement
        $stmt->execute();

        // Check if any row was deleted
        if ($stmt->affected_rows > 0) {
            // Record deleted successfully, redirect to listPremiumUser.php
            header("Location: listPremiumUser.php");
            exit;
        } else {
            $errorMessage = "No record found with the specified ID.";
        }

        // Close the statement and connection
        $stmt->close();
    }
    $conn->close();
} catch (mysqli_sql_exception $e) {
    $errorMessage = "Error: " . $e->getMessage();
} catch (Exception $e) {
    $errorMessage = "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/icon.png"/>
    <title>Premium User</title>
    <link rel="stylesheet" href="css/nav-S.css">
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this record?");
        }
    </script>
</head>
<body>
    <div class="header">
        <div class="logo">
        <a href="<?php echo htmlspecialchars($mainPageURL); ?>"><img src="images/selfo.jpg" alt="Company Logo"></a>
        </div>
    </div>
    <main>
    <div class="container my-5">
        <h2>Delete User</h2>

        <?php
        if (!empty($errorMessage)) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>

        <form method="post" onsubmit="return confirmDelete()">
            <div class="form-group">
                <label for="premium_id">ID:</label>
                <input type="text" class="form-control" name="premium_id" value="">
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn btn-primary">Delete</button>
                <a class="btn btn-outline-primary" href="listPremiumUser.php" role="button">Cancel</a>
            </div>
        </form>
    </div>
    </main>
</body>
</html>