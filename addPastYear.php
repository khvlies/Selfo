<?php
//fetch user data
include("userData.php");

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
        if ( empty($paper_id) || empty($course_code) ) {
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
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/icon.png"/>
    <title>Past Year</title>
    <link rel="stylesheet" href="css/nav-S.css">
</head>
<body>
    <div class="header">
        <div class="logo">
        <a href="<?php echo htmlspecialchars($mainPageURL); ?>"><img src="images/selfo.jpg" alt="Company Logo"></a>
        </div>
    </div>
<main>
<h2>Upload Past Year</h2>
<form action="uploadPY.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="course_code">Course Code</label>
        <input type="text" name="course_code" value="<?php echo $course_code; ?>">
    </div>
    <div class="form-group">
        <label for="fileToUpload">Select file to upload:</label>
        <input type="file" name="fileToUpload" id="fileToUpload">
    </div>
    <div class="form-buttons">
    <input class="btn btn-primary" type="submit" value="Upload File" name="submit">
    <a class="btn btn-outline-primary" href="listPastYear.php" role="button">Cancel</a>
    </div>
</form>
</main>
</body>
</html>
