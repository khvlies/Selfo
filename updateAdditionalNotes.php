<?php
// Fetch user data
include("userData.php");

// Enable error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$servername = "localhost";
$username = "root";
$password = "";
$database = "selfodb";

// Database connection
$conn = new mysqli($servername, $username, $password, $database);

$addN_id = "";
$tutor_id = "";
$file_name = "";
$file_path = "";
$errorMessage = "";
$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (!isset($_GET["addN_id"])) {
        header("Location: listAdditionalNotes.php");
        exit;
    }

    $addN_id = $_GET["addN_id"];

    $sql = "SELECT * FROM additional_notes WHERE addN_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $addN_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        header("Location: listAdditionalNotes.php");
        exit;
    }

    $tutor_id = $row['tutor_id'];
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize user input
    $addN_id = $_POST['addN_id'];
    $tutor_id = $_POST['tutor_id'];

    // Initialize uploadOk to 1
    $uploadOk = 1;

    if ($_FILES["fileToUpload"]["error"] != UPLOAD_ERR_NO_FILE) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Validate the file
        if ($_FILES["fileToUpload"]["size"] > 5000000) { // 5MB limit
            $errorMessage = "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        if ($fileType != "pdf" && $fileType != "docx" && $fileType != "txt" && $fileType != "pptx") {
            $errorMessage = "Sorry, only PDF, DOCX, TXT & PPTX files are allowed.";
            $uploadOk = 0;
        }
        if (file_exists($target_file)) {
            $fileNameWithoutExt = pathinfo($target_file, PATHINFO_FILENAME);
            $newFileName = $fileNameWithoutExt . "_" . time() . "." . $fileType;
            $target_file = $target_dir . $newFileName;
        }

        if ($uploadOk == 1 && move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $file_name = basename($target_file);
            $file_path = $target_file;
        } else {
            $errorMessage = "Sorry, there was an error uploading your file.";
            $uploadOk = 0;
        }
    }

    if (empty($errorMessage)) {
        // Prepare an update statement
        if ($file_name && $file_path) {
            $sql = "UPDATE additional_notes SET tutor_id = ?, file_name = ?, file_path = ? WHERE addN_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $tutor_id, $file_name, $file_path, $addN_id);
        } else {
            $sql = "UPDATE additional_notes SET tutor_id = ? WHERE addN_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $tutor_id, $addN_id);
        }

        // Execute the statement
        $stmt->execute();

        // Check if any row was updated
        if ($stmt->affected_rows > 0) {
            $successMessage = "Record updated successfully.";
            // Redirect to listAdditionalNotes.php after successful update
            header("Location: listAdditionalNotes.php");
            exit();
        } else {
            $errorMessage = "No record found with the specified ID.";
        }

        // Close the statement
        $stmt->close();
    }
}

// Close the connection at the end of the script
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/icon.png"/>
    <title>Update Additional Notes</title>
    <link rel="stylesheet" href="css/nav-S.css">
</head>
<body>
    <div class="header">
        <div class="logo">
        <a href="<?php echo htmlspecialchars($mainPageURL); ?>"><img src="images/selfo.jpg" alt="Company Logo"></a>
        </div>
    </div>
    <main>
        <div class="container my-5">
            <h2>Update Additional Notes</h2>

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
                <div class="form-group">
                    <label for="addN_id">ID:</label>
                    <input type="text" class="form-control" name="addN_id" id="addN_id" value="<?php echo htmlspecialchars($addN_id); ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="tutor_id">Tutor:</label>
                    <select name="tutor_id" id="tutor_id" class="form-control" required>
                        <?php
                        // Fetch tutors from the database
                        $sql = "SELECT tutor_id, tutor_name FROM tutor";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            $selected = ($row['tutor_id'] == $tutor_id) ? "selected" : "";
                            echo "<option value='{$row['tutor_id']}' $selected>{$row['tutor_name']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="fileToUpload">Upload New File (Optional):</label>
                    <input type="file" name="fileToUpload" id="fileToUpload" class="form-control">
                </div>
                <div class="form-buttons">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a class="btn btn-outline-primary" href="listAdditionalNotes.php" role="button">Cancel</a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>

<?php
$conn->close();
?>
