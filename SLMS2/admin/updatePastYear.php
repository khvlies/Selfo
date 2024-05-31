<?php
// Enable error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$servername = "localhost";
$username = "root";
$password = "";
$database = "educationdb";

// Database connection
$conn = new mysqli("localhost", "root", "", "educationdb");

$paper_id ="";
$course_code ="";
$content_LinkHref ="";
$admin_id ="";

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if 'paper_id' is set
        if (isset($_POST['paper_id'])) {
            $id = $_POST['paper_id']; // ID to update (VARCHAR)
        } else {
            throw new Exception("Error: 'paper_id' not set.");
        }

    // Retrieve and sanitize user input
        $paper_id = $conn->real_escape_string($_POST['paper_id']);
        $course_code = $conn->real_escape_string($_POST['course_code']);
        $content_LinkHref = $conn->real_escape_string($_POST['content_LinkHref']);
        $admin_id = $conn->real_escape_string($_POST['admin_id']);

    // Prepare an update statement
        $stmt = $conn->prepare("UPDATE past_year_paper SET course_code = ?, content_LinkHref = ?, admin_id = ? WHERE paper_id = ?");
        $stmt->bind_param("ssssssss", $course_code, $content_LinkHref, $admin_id, $paper_id);

    // Execute the statement
        $stmt->execute();

    // Check if any row was updated
    if ($stmt->affected_rows > 0) {
        $successMessage = "Record updated successfully.";
        // Redirect to listPastYear.php after successful update
        header("Location: /SLMS2/listPastYear.php");
        exit();
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
    <title>Past Year</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src ="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Update Past Year Paper</h2>

        <?php
        if (!empty($errorMessage)) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }

        if (!empty($successMessage)) {
            echo "
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>$successMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>

        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="paper_id" value="<?php echo $paper_id; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Course Code</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="course_code" value="<?php echo $course_code; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Content</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="content_LinkHref" value="<?php echo $content_LinkHref; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Admin ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="admin_id" value="<?php echo $admin_id; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/SLMS2/listPastYear.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>