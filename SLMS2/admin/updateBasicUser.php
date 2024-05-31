<?php
// Enable error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$servername = "localhost";
$username = "root";
$password = "";
$database = "educationdb";

// Database connection
$conn = new mysqli("localhost", "root", "", "educationdb");

$basic_id ="";
$basic_password ="";
$basic_name ="";
$basic_phone="";
$basic_email ="";
$study_id ="";
$paper_id ="";
$admin_id ="";

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if 'basic_id' is set
        if (isset($_POST['basic_id'])) {
            $id = $_POST['basic_id']; // ID to update (VARCHAR)
        } else {
            throw new Exception("Error: 'basic_id' not set.");
        }

    // Retrieve and sanitize user input
        $basic_id = $conn->real_escape_string($_POST['basic_id']);
        $basic_password = $conn->real_escape_string($_POST['basic_password']);
        $basic_name = $conn->real_escape_string($_POST['basic_name']);
        $basic_phone = $conn->real_escape_string($_POST['basic_phone']);
        $basic_email = $conn->real_escape_string($_POST['basic_email']);
        $study_id = $conn->real_escape_string($_POST['study_id']);
        $paper_id = $conn->real_escape_string($_POST['paper_id']);
        $admin_id = $conn->real_escape_string($_POST['admin_id']);

    // Prepare an update statement
        $stmt = $conn->prepare("UPDATE basic_user SET basic_password = ?, basic_name = ?, basic_phone = ?, basic_email = ?, study_id = ?, paper_id = ?, admin_id = ? WHERE basic_id = ?");
        $stmt->bind_param("ssssssss", $basic_password, $basic_name, $basic_phone, $basic_email, $study_id, $paper_id, $admin_id, $basic_id);

    // Execute the statement
        $stmt->execute();

    // Check if any row was updated
    if ($stmt->affected_rows > 0) {
        $successMessage = "Record updated successfully.";
        // Redirect to listBasicUser.php after successful update
        header("Location: /SLMS2/listBasicUser.php");
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
    <title>Basic User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src ="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Update User</h2>

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
                    <input type="text" class="form-control" name="basic_id" value="<?php echo $basic_id; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="basic_password" value="<?php echo $basic_password; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="basic_name" value="<?php echo $basic_name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Phone Number</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="basic_phone" value="<?php echo $basic_phone; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="basic_email" value="<?php echo $basic_email; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Study Material ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="study_id" value="<?php echo $study_id; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Past Year Paper ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="paper_id" value="<?php echo $paper_id; ?>">
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
                    <a class="btn btn-outline-primary" href="/SLMS2/listBasicUser.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>