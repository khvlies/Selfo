<?php
// Enable error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$servername = "localhost";
$username = "root";
$password = "";
$database = "selfodb";

// Database connection
$conn = new mysqli($servername, $username, $password, $database);

$study_id ="";
$course_code ="";
$pdf_link ="";

$errorMessage = "";
$successMessage = "";

try {
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if (!isset($_GET["study_id"])) {
            header("location: /SLMS2/listStudyMaterial.php");
            exit;
        }

        $study_id = $_GET["study_id"];

        $sql = "SELECT * FROM study_material WHERE study_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $study_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if (!$row) {
            header("location: /SLMS2/listStudyMaterial.php");
            exit;
        }

        $course_code = $row["course_code"];
        $pdf_link = $row["pdf_link"];

    } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve and sanitize user input
        $study_id = $_POST['study_id'];
        $course_code = $_POST['course_code'];
        $pdf_link = $_POST['pdf_link'];

        // Prepare an update statement
        $sql = "UPDATE study_material SET course_code = ?, pdf_link = ? WHERE study_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $course_code, $pdf_link, $study_id);

        // Execute the statement
        $stmt->execute();

        // Check if any row was updated
        if ($stmt->affected_rows > 0) {
            $successMessage = "Record updated successfully.";
            // Redirect to listStudyMaterial.php after successful update
            header("Location: /SLMS2/listStudyMaterial.php");
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
    <title>Study Material</title>
    <link rel="stylesheet" href="css/style2.css">
    <script src ="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <main>
    <div class="container my-5">
        <h2>Update Study Material</h2>

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
                        <input type="text" class="form-control" name="study_id" value="<?php echo $study_id; ?>" readonly>
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
                    <input type="text" class="form-control" name="pdf_link" value="<?php echo $pdf_link; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/SLMS2/listStudyMaterial.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
    </main>
</body>
</html>