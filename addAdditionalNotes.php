<?php
//fetch user data
include("userData.php");

$servername = "localhost";
$username = "root";
$password = "";
$database = "selfodb";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

$addN_id = "";
$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $addN_id = $_POST["addN_id"];

    do {
        if (empty($addN_id)) {
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

        $addN_id = "";

        $successMessage = "Additional notes added correctly";

        header("location: listAdditionalNotes.php");
        exit;

    } while (false);
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="icon" href="images/icon.png"/>
    <title>Additional Notes</title>
    <link rel="stylesheet" href="css/nav-S.css">
</head>
<body>
    <div class="header">
        <div class="logo">
        <a href="<?php echo htmlspecialchars($mainPageURL); ?>"><img src="images/selfo.jpg" alt="Company Logo"></a>
        </div>
    </div>
<main>
    <h2>Upload Additional Notes</h2>

    <?php
    if (!empty($errorMessage)) {
        echo "<div class='alert alert-danger'>$errorMessage</div>";
    }

    if (!empty($successMessage)) {
        echo "<div class='alert alert-success'>$successMessage</div>";
    }
    ?>

    <form action="uploadAddNotes.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="addN_id">Note ID:</label>
            <input type="text" name="addN_id" id="addN_id" value="<?php echo $addN_id; ?>">
        </div>
        <div class="form-group">
            <label for="fileToUpload">Select file to upload:</label>
            <input type="file" name="fileToUpload" id="fileToUpload">
        </div>
        <div class="form-buttons">
            <input type="submit" value="Upload File" name="submit" class="btn btn-primary">
            <a class="btn btn-outline-primary" href="listAdditionalNotes.php" role="button">Cancel</a>
        </div>
    </form>
</main>

</body>
</html>
