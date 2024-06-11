<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$message = "";
$redirectScript = "";

// Check if file is an actual file or a fake file
if (isset($_POST["submit"])) {
    $check = filesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        $message = "File is valid.";
        $uploadOk = 1;
    } else {
        $message = "File is not valid.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    $redirectScript = "<script>
                alert('The file already exist.');
                window.location.href = 'listStudyMaterial.php';
            </script>";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) { // 5MB limit
    $redirectScript = "<script>
                alert('The file is too large.');
                window.location.href = 'listStudyMaterial.php';
            </script>";
    $uploadOk = 0;
}

// Allow certain file formats
if ($fileType != "pdf" && $fileType != "docx" && $fileType != "txt" && $fileType != "pptx") {
    $redirectScript = "<script>
                alert('Sorry, only PDF, DOCX, TXT & PPTX files are allowed.');
                window.location.href = 'listStudyMaterial.php';
            </script>";
    $uploadOk = 0;
}


// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        // Insert file metadata into database
        $fileName = basename($_FILES["fileToUpload"]["name"]);
        $filePath = $target_file;
        $courseCode = $_POST["course_code"]; // Get course code from the form

        $conn = new mysqli("localhost", "root", "", "selfodb");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO past_year_paper (course_code, file_name, file_path) VALUES ('$courseCode', '$fileName', '$filePath')";

        if ($conn->query($sql) === TRUE) {
            $message = "The file " . htmlspecialchars($fileName) . " has been uploaded.";
            // Prepare the JavaScript to redirect after showing the message
            $redirectScript = "<script>
                alert('The file has been uploaded successfully.');
                window.location.href = 'listPastYear.php';
            </script>";
        } else {
            $message = "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    } else {
        $message = "Sorry, there was an error uploading your file.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/icon.png"/>
    <title>Upload Past Year</title>
    <link rel="stylesheet" href="css/nav-S.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <main>
    <div class="container my-5">
        <h2>Upload Past Year</h2>

        <?php
        if (!empty($message)) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$message</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }

        // Echo the redirect script if it's set
        if (!empty($redirectScript)) {
            echo $redirectScript;
        }
        ?>

        <form action="" method="post" enctype="multipart/form-data">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">File</label>
                <div class="col-sm-6">
                    <input type="file" class="form-control" name="fileToUpload" required>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Course Code</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="course_code" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" name="submit" class="btn btn-primary">Upload</button>
                </div>
            </div>
        </form>
    </div>
    </main>
</body>
</html>