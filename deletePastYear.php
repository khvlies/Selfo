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
$paper_id = "";
$errorMessage = "";

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if 'paper_id' is set
        if (!empty($_POST['paper_id'])) {
            $id = $_POST['paper_id']; // ID to delete (VARCHAR)
        } else {
            throw new Exception("Error: 'paper_id' not set.");
        }

        // Retrieve the file path from the database
        $stmt = $conn->prepare("SELECT file_path FROM past_year_paper WHERE paper_id = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($file_path);
            $stmt->fetch();

            // Delete the file from the file system
            if (file_exists($file_path)) {
                unlink($file_path);
            } else {
                throw new Exception("File not found.");
            }

            $stmt->close();

            // Prepare a delete statement for the record
            $stmt = $conn->prepare("DELETE FROM past_year_paper WHERE paper_id = ?");
            $stmt->bind_param("s", $id);

            // Execute the statement
            $stmt->execute();

            // Check if any row was deleted
            if ($stmt->affected_rows > 0) {
                // Record deleted successfully, redirect to listPastYear.php
                header("Location: listPastYear.php");
                exit;
            } else {
                $errorMessage = "No record found with the specified ID.";
            }
        } else {
            $errorMessage = "No record found with the specified ID.";
        }

        // Close the statement and connection
        $stmt->close();
    }
    $conn->close();
} catch (mysqli_sql_exception $e) {
    $errorMessage = "Database error: " . $e->getMessage();
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
    <title>Past Year</title>
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
        <h2>Delete Past Year</h2>

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
                <label for="paper_id">ID:</label>
                <input type="text" name="paper_id" value="<?php echo $paper_id; ?>">
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn btn-primary">Delete</button>
                <a class="btn btn-outline-primary" href="listPastYear.php" role="button">Cancel</a>
            </div>
        </form>
    </div>
    </main>
</body>
</html>