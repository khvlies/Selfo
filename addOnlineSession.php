<?php
// Fetch user data (assuming this includes connection details)
include("userData.php");

$servername = "localhost";
$username = "root";
$password = "";
$database = "selfodb";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

$course_code = "";
$link_meet = "";
$tutor_id = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $course_code = $_POST["course_code"];
    $link_meet = $_POST["link_meet"];
    $tutor_id = $_POST["tutor_id"];

    do {
        if (empty($course_code) || empty($link_meet) || empty($tutor_id)) {
            $errorMessage = "All fields are required";
            break;
        }

        // Add new session to database
        $sql = "INSERT INTO online_session (course_code, link_meet, tutor_id) VALUES ('$course_code', '$link_meet', '$tutor_id')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $successMessage = "Online session added successfully";

        header("location: listOnlineSession.php");
        exit;

    } while (false);
}

// Fetch tutors for the dropdown
$tutor_sql = "SELECT tutor_id, tutor_name FROM tutor";
$tutor_result = $connection->query($tutor_sql);
$tutors = [];
if ($tutor_result->num_rows > 0) {
    while ($row = $tutor_result->fetch_assoc()) {
        $tutors[] = $row;
    }
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
                    <label for="course_code">Course Code</label>
                    <input type="text" class="form-control" name="course_code" id="course_code" value="<?php echo $course_code; ?>">
                </div>
                <div class="form-group">
                    <label for="link_meet">Link Session</label>
                    <input type="text" class="form-control" name="link_meet" id="link_meet" value="<?php echo $link_meet; ?>">
                </div>
                <div class="form-group">
                    <label for="tutor_id">Tutor</label>
                    <select class="form-control" name="tutor_id" id="tutor_id">
                        <?php
                        foreach ($tutors as $tutor) {
                            echo "<option value=\"{$tutor['tutor_id']}\">{$tutor['tutor_name']}</option>";
                        }
                        ?>
                    </select>
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
