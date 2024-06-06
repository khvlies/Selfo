<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "selfodb";

//create connection
$connection = new mysqli($servername, $username, $password, $database);

$addN_id ="";

$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'POST'){
    $addN_id =$_POST["addN_id"];

    do {
        if ( empty($addN_id) || empty($course_code) ) {
            $errorMessage = "All the fields are required";
            break;
        }

        // Add new material to database
        $sql = "INSERT INTO additional_notes (addN_id) VALUES ('$addN_id')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $addN_id ="";


        $successMessage = "additional notes added correctly";

        header("location: listAdditionalNotes.php");
        exit;

    } while (false);
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/style2.css">
</head>
<body>

<h2>Upload Additional Notes</h2>
<form action="uploadAddNotes.php" method="post" enctype="multipart/form-data">
    Select file to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload File" name="submit">
    <div class="col-sm-3 d-grid">
        <a class="btn btn-outline-primary" href="listAdditionalNotes.php" role="button">Cancel</a>
    </div>
</form>

</body>
</html>
