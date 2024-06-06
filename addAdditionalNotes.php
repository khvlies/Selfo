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
        if ( empty($study_id) || empty($course_code) ) {
            $errorMessage = "All the fields are required";
            break;
        }

        // Add new material to database
        $sql = "INSERT INTO additional_notes (addN_id) VALUES ('$study_id')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $study_id ="";


        $successMessage = "additional notes added correctly";

        header("location: listAdditionalNotes.php");
        exit;

    } while (false);
}
?>
<!DOCTYPE html>
<html>
<body>

<h2>Upload Additional Notes</h2>
<form action="uploadAddNotes.php" method="post" enctype="multipart/form-data">
    Select file to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload File" name="submit">
</form>

</body>
</html>
