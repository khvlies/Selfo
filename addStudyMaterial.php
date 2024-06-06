<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "selfodb";

//create connection
$connection = new mysqli($servername, $username, $password, $database);

$study_id ="";
$course_code ="";

$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'POST'){
    $study_id =$_POST["study_id"];
    $course_code =$_POST["course_code"];

    do {
        if ( empty($study_id) || empty($course_code) ) {
            $errorMessage = "All the fields are required";
            break;
        }

        // Add new material to database
        $sql = "INSERT INTO study_material (study_id, course_code) VALUES ('$study_id', '$course_code')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $study_id ="";
        $course_code ="";


        $successMessage = "study material added correctly";

        header("location: listStudyMaterial.php");
        exit;

    } while (false);
}
?>
<!DOCTYPE html>
<html>
<body>

<h2>Upload Study Material</h2>
<form action="uploadSM.php" method="post" enctype="multipart/form-data">
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
