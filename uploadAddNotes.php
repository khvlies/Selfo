<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$message = "";
$redirectScript = "";

if (isset($_POST["submit"])) {
    $check = filesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        $message = "File is valid.";
        $uploadOk = 1;
    } else {
        $message = "File is not valid.";
        $uploadOk = 0;
    }

    if (file_exists($target_file)) {
        $redirectScript = "<script>
                    alert('The file already exist.');
                    window.location.href = 'listAdditionalNotes.php';
                </script>";
        $uploadOk = 0;
    }

    if ($_FILES["fileToUpload"]["size"] > 5000000) { // 5MB limit
        $redirectScript = "<script>
                    alert('The file is too large.');
                    window.location.href = 'listAdditionalNotes.php';
                </script>";
        $uploadOk = 0;
    }

    if ($fileType != "pdf" && $fileType != "docx" && $fileType != "txt" && $fileType != "pptx") {
        $redirectScript = "<script>
                    alert('Sorry, only PDF, DOCX, TXT & PPTX files are allowed.');
                    window.location.href = 'listAdditionalNotes.php';
                </script>";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $fileName = basename($_FILES["fileToUpload"]["name"]);
            $filePath = $target_file;
            $tutorId = $_POST["tutor_id"]; // Capture tutor ID

            $conn = new mysqli("localhost", "root", "", "selfodb");

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "INSERT INTO additional_notes (file_name, file_path, tutor_id) VALUES ('$fileName', '$filePath', '$tutorId')";

            if ($conn->query($sql) === TRUE) {
                $message = "The file " . htmlspecialchars($fileName) . " has been uploaded.";
                $redirectScript = "<script>
                    alert('The file has been uploaded successfully.');
                    window.location.href = 'listAdditionalNotes.php';
                </script>";
            } else {
                $message = "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
        } else {
            $message = "Sorry, there was an error uploading your file.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/icon.png"/>
    <title>Upload Additional Notes</title>
    <link rel="stylesheet" href="css/nav-S.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <main>
    <div class="container my-5">
        <h2>Upload Additional Notes</h2>

        <?php
        if (!empty($message)) {
            echo "<div class='alert alert-info'>$message</div>";
        }

        if (!empty($redirectScript)) {
            echo $redirectScript;
        }
        ?>
    </div>
    </main>
</body>
</html>
