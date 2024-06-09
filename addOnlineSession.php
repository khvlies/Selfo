<?php
//fetch user data
include("userData.php");

$servername = "localhost";
$username = "root";
$password = "";
$database = "selfodb";

//create connection
$connection = new mysqli($servername, $username, $password, $database);

$online_id = "";
$course_code = "";
$link_meet = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $online_id = $_POST["online_id"];
    $course_code = $_POST["course_code"];
    $link_meet = $_POST["link_meet"];

    do {
        if (empty($online_id) || empty($course_code) || empty($link_meet)) {
            $errorMessage = "All the fields are required";
            break;
        }

        // Add new material to database
        $sql = "INSERT INTO online_session (online_id, course_code, link_meet) VALUES ('$online_id', '$course_code', '$link_meet')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $online_id = "";
        $course_code = "";
        $link_meet = "";

        $successMessage = "Online session added correctly";

        header("location: listOnlineSession.php");
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
    <link rel="stylesheet" href="css/nav-S.css">
    <title>New Online Session</title>
</head>
<body>
    <div class="header">
        <div class="logo">
        <a href="<?php echo htmlspecialchars($mainPageURL); ?>"><img src="images/selfo.jpg" alt="Company Logo"></a>
        </div>
    </div>
<main>
    <div class="container my-5">
        <h2>New Online Session</h2>

        <?php
        if (!empty($errorMessage)) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>
        <form method="post">
            <div class="form-group">
                <label for="online_id">ID</label>
                <input type="text" class="form-control" name="online_id" id="online_id" value="<?php echo $online_id; ?>">
            </div>
            <div class="form-group">
                <label for="course_code">Course Code</label>
                <input type="text" class="form-control" name="course_code" id="course_code" value="<?php echo $course_code; ?>">
            </div>
            <div class="form-group">
                <label for="link_meet">Link Session</label>
                <input type="text" class="form-control" name="link_meet" id="link_meet" value="<?php echo $link_meet; ?>">
            </div>
           
            <?php
            if (!empty($successMessage)) {
                echo "
                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <strong>$successMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                ";
            }
            ?>

            <div class="form-buttons">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a class="btn btn-outline-primary" href="listOnlineSession.php" role="button">Cancel</a>
            </div>
        </form>
    </div> 
</main>
</body>
</html>
