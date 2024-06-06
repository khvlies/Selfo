<?php
// Enable error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$servername = "localhost";
$username = "root";
$password = "";
$database = "selfodb";

// Database connection
$conn = new mysqli($servername, $username, $password, $database);

$study_id = "";
$course_code = "";

$errorMessage = "";
$successMessage = "";

try {
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if (!isset($_GET["study_id"])) {
            header("Location: listStudyMaterial.php");
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
            header("Location: listStudyMaterial.php");
            exit;
        }

        $course_code = $row["course_code"];

    } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve and sanitize user input
        $study_id = $_POST['study_id'];
        $course_code = $_POST['course_code'];

        $file_name = "";
        $file_path = "";

        if ($_FILES["fileToUpload"]["error"] != UPLOAD_ERR_NO_FILE) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Validate the file
            if ($_FILES["fileToUpload"]["size"] > 5000000) { // 5MB limit
                $errorMessage = "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            if ($fileType != "pdf" && $fileType != "docx" && $fileType != "txt") {
                $errorMessage = "Sorry, only PDF, DOCX, & TXT files are allowed.";
                $uploadOk = 0;
            }
            if ($uploadOk == 1 && move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $file_name = basename($_FILES["fileToUpload"]["name"]);
                $file_path = $target_file;
            } else {
                $errorMessage = "Sorry, there was an error uploading your file.";
                $uploadOk = 0;
            }
        }

        if (empty($errorMessage)) {
            // Prepare an update statement
            if ($file_name && $file_path) {
                $sql = "UPDATE study_material SET course_code = ?, file_name = ?, file_path = ? WHERE study_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssss", $course_code, $file_name, $file_path, $study_id);
            } else {
                $sql = "UPDATE study_material SET course_code = ? WHERE study_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ss", $course_code, $study_id);
            }

            // Execute the statement
            $stmt->execute();

            // Check if any row was updated
            if ($stmt->affected_rows > 0) {
                $successMessage = "Record updated successfully.";
                // Redirect to listStudyMaterial.php after successful update
                header("Location: listStudyMaterial.php");
                exit();
            } else {
                $errorMessage = "No record found with the specified ID.";
            }

            // Close the statement and connection
            $stmt->close();
        }
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
    <title>Update Study Material</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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

        <form method="post" enctype="multipart/form-data">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="study_id" value="<?php echo htmlspecialchars($study_id); ?>" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Course Code</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="course_code" value="<?php echo htmlspecialchars($course_code); ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Upload New File</label>
                <div class="col-sm-6">
                    <input type="file" class="form-control" name="fileToUpload" id="fileToUpload">
                </div>
            </div>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="listStudyMaterial.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
    </main>
</body>
</html>