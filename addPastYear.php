<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "selfodb";

//create connection
$connection = new mysqli($servername, $username, $password, $database);

$paper_id ="";
$course_code ="";

$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'POST'){
    $paper_id =$_POST["paper_id"];
    $course_code =$_POST["course_code"];

    do {
        if ( empty($study_id) || empty($course_code) ) {
            $errorMessage = "All the fields are required";
            break;
        }

        // Add new material to database
        $sql = "INSERT INTO past_year_paper (paper_id, course_code) VALUES ('$paper_id', '$course_code')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $paper_id ="";
        $course_code ="";


        $successMessage = "past year added correctly";

        header("location: listPastYear.php");
        exit;

    } while (false);
}
?>
<!DOCTYPE html>
<html>
<body>

<h2>Upload Past Year</h2>
<form action="uploadPY.php" method="post" enctype="multipart/form-data">
    <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Course Code</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="course_code" value="<?php echo $course_code; ?>">
        </div>
    </div>
    Select file to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload File" name="submit">
</form>

</body>
</html>
