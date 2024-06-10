<?php
//fetch user data
include("userData.php");

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
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/icon.png"/>
    <title>Study Material</title>
    <link rel="stylesheet" href="css/nav-S.css">
</head>
<body>
    <div class="header">
        <div class="logo">
        <a href="<?php echo htmlspecialchars($mainPageURL); ?>"><img src="images/selfo.jpg" alt="Company Logo"></a>
        </div>
    </div>
<main>
<h2>Upload Study Material</h2>
    <form action="uploadSM.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="course_code">Course Code:</label>
            <input type="text" name="course_code" value="<?php echo $course_code; ?>">
        </div>
        <div class="form-group">
            <label for="fileToUpload">Select file to upload:</label>
            <input type="file" name="fileToUpload" id="fileToUpload">
        </div>    
        <div class="form-buttons">
            <input class="btn btn-primary" type="submit" value="Upload File" name="submit">
            <a class="btn btn-outline-primary" href="listStudyMaterial.php" role="button">Cancel</a>
        </div>
    </form>
</main>
</body>
</html>
