<?php
// Enable error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$servername = "localhost";
$username = "root";
$password = "";
$database = "selfodb";

// Database connection
$conn = new mysqli($servername, $username, $password, $database);

$tutor_id ="";
$tutor_password ="";
$tutor_name ="";
$tutor_phone ="";
$tutor_email ="";

$errorMessage = "";
$successMessage = "";

try {
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if (!isset($_GET["tutor_id"])) {
            header("location: listTutor.php");
            exit;
        }

        $tutor_id = $_GET["tutor_id"];

        $sql = "SELECT * FROM tutor WHERE tutor_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $tutor_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if (!$row) {
            header("location: listTutor.php");
            exit;
        }

        $tutor_password = $row["tutor_password"];
        $tutor_name = $row["tutor_name"];
        $tutor_phone = $row["tutor_phone"];
        $tutor_email = $row["tutor_email"];
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve and sanitize user input
        $tutor_id = $_POST['tutor_id'];
        $tutor_password = $_POST['tutor_password'];
        $tutor_name = $_POST['tutor_name'];
        $tutor_phone = $_POST['tutor_phone'];
        $tutor_email = $_POST['tutor_email'];


        // Prepare an update statement
        $sql = "UPDATE tutor SET tutor_password = ?, tutor_name = ?, tutor_phone = ?, tutor_email = ?  WHERE tutor_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $tutor_password, $tutor_name, $tutor_phone, $tutor_email, $tutor_id);

        // Execute the statement
        $stmt->execute();

        // Check if any row was updated
        if ($stmt->affected_rows > 0) {
            $successMessage = "Record updated successfully.";
            // Redirect to listTutor.php after successful update
            header("Location: listTutor.php");
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
    <link rel="icon" href="images/icon.png"/>
    <title>Tutor</title>
    <link rel="stylesheet" href="css/style2.css">
    <script src ="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <main>
    <div class="container my-5">
        <h2>Update Tutor</h2>

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
                    <input type="text" class="form-control" name="tutor_id" value="<?php echo $tutor_id; ?>" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="tutor_password" value="<?php echo $tutor_password; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="tutor_name" value="<?php echo $tutor_name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Phone Number</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="tutor_phone" value="<?php echo $tutor_phone; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="tutor_email" value="<?php echo $tutor_email; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="listTutor.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
    </main>
</body>
</html>