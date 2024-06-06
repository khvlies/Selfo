<?php
// Enable error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$servername = "localhost";
$username = "root";
$password = "";
$database = "selfodb";

// Database connection
$conn = new mysqli($servername, $username, $password, $database);

$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the ID from the form
    $tutor_id = $_POST['tutor_id'];

    // Ensure the ID is not empty
    if (empty($tutor_id)) {
        echo "Error: 'tutor_id' not set.";
        exit();
    }

    // Prepare the SQL statement to delete the record
    $stmt = $conn->prepare("DELETE FROM tutor WHERE tutor_id = ?");
    $stmt->bind_param("s", $tutor_id);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/icon.png"/>
    <title>Tutor</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src ="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this record?");
        }
    </script>
</head>
<body>
    <div class="container my-5">
        <h2>Delete Tutor</h2>

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
                    <input type="text" class="form-control" name="tutor_id" value="" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-secondary" href="listTutor.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>