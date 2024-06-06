<?php
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src ="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this record?");
        }
    </script>
</head>
<body>
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
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="paper_id" value="<?php echo $paper_id; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-secondary" href="listPastYear.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
    </main>
</body>
</html>