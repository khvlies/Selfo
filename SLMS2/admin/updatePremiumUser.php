<?php
// Enable error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$servername = "localhost";
$username = "root";
$password = "";
$database = "educationdb";

// Database connection
$conn = new mysqli("localhost", "root", "", "educationdb");

$premium_id ="";
$premium_password ="";
$premium_name ="";
$premium_phone="";
$premium_email ="";
$admin_id ="";
$study_id ="";
$paper_id ="";
$tutor_id ="";

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if 'premium_id' is set
        if (isset($_POST['premium_id'])) {
            $id = $_POST['premium_id']; // ID to update (VARCHAR)
        } else {
            throw new Exception("Error: 'premium_id' not set.");
        }

    // Retrieve and sanitize user input
        $premium_id = $conn->real_escape_string($_POST['premium_id']);
        $premium_password = $conn->real_escape_string($_POST['premium_password']);
        $premium_name = $conn->real_escape_string($_POST['premium_name']);
        $premium_phone = $conn->real_escape_string($_POST['premium_phone']);
        $premium_email = $conn->real_escape_string($_POST['premium_email']);
        $admin_id = $conn->real_escape_string($_POST['admin_id']);
        $study_id = $conn->real_escape_string($_POST['study_id']);
        $paper_id = $conn->real_escape_string($_POST['paper_id']);
        $tutor_id = $conn->real_escape_string($_POST['tutor_id']);

    // Prepare an update statement
        $stmt = $conn->prepare("UPDATE premium_user SET premium_password = ?, premium_name = ?, premium_phone = ?, premium_email = ?, admin_id = ?, study_id = ?, paper_id = ?, tutor_id = ? WHERE premium_id = ?");
        $stmt->bind_param("ssssssss", $premium_password, $premium_name, $premium_phone, $premium_email, $admin_id, $study_id, $paper_id, $tutor_id, $premium_id);

    // Execute the statement
        $stmt->execute();

    // Check if any row was updated
    if ($stmt->affected_rows > 0) {
        $successMessage = "Record updated successfully.";
        // Redirect to listPremiumUser.php after successful update
        header("Location: /SLMS2/listPremiumUser.php");
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
    <title>Premium User</title>
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
                    <input type="text" class="form-control" name="premium_id" value="<?php echo $premium_id; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="premium_password" value="<?php echo $premium_password; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="premium_name" value="<?php echo $premium_name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Phone Number</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="premium_phone" value="<?php echo $premium_phone; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="premium_email" value="<?php echo $premium_email; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Admin ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="admin_id" value="<?php echo $admin_id; ?>">
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
                <label class="col-sm-3 col-form-label">Tutor ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="tutor_id" value="<?php echo $tutor_id; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/SLMS2/listPremiumUser.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>