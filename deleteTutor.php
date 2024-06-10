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
            <div class="form-group">
                <label for="tutor_id">ID:</label>
                <input type="text" class="form-control" name="tutor_id" value="" readonly>
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn btn-primary">Delete</button>
                <a class="btn btn-outline-primary" href="listTutor.php" role="button">Cancel</a>
            </div>
        </form>
    </div>
    </main>
</body>
</html>