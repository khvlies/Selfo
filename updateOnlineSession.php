<?php
// Fetch user data
include("userData.php");

// Enable error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$servername = "localhost";
$username = "root";
$password = "";
$database = "selfodb";

// Database connection
$conn = new mysqli($servername, $username, $password, $database);

$online_id ="";
$course_code ="";
$link_meet ="";
$tutor_id ="";
$tutor_name ="";
$tutors = [];

$errorMessage = "";
$successMessage = "";

try {
    // Fetch tutors for the dropdown
    $tutor_sql = "SELECT tutor_id, tutor_name FROM tutor";
    $tutor_result = $conn->query($tutor_sql);
    if ($tutor_result->num_rows > 0) {
        while ($row = $tutor_result->fetch_assoc()) {
            $tutors[] = $row;
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if (!isset($_GET["online_id"])) {
            header("location: listOnlineSession.php");
            exit;
        }

        $online_id = $_GET["online_id"];

        $sql = "SELECT os.*, t.tutor_name 
                FROM online_session os
                JOIN tutor t ON os.tutor_id = t.tutor_id
                WHERE os.online_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $online_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if (!$row) {
            header("location: listOnlineSession.php");
            exit;
        }

        $course_code = $row["course_code"];
        $link_meet = $row["link_meet"];
        $tutor_id = $row["tutor_id"];
        $tutor_name = $row["tutor_name"];
        
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve and sanitize user input
        $online_id = $_POST['online_id'];
        $course_code = $_POST['course_code'];
        $link_meet = $_POST['link_meet'];
        $tutor_id = $_POST['tutor_id'];

        // Prepare an update statement
        $sql = "UPDATE online_session SET course_code = ?, link_meet = ?, tutor_id = ?  WHERE online_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $course_code, $link_meet, $tutor_id, $online_id);

        // Execute the statement
        $stmt->execute();

        // Check if any row was updated
        if ($stmt->affected_rows > 0) {
            $successMessage = "Record updated successfully.";
            // Redirect to listOnlineSession.php after successful update
            header("Location:listOnlineSession.php");
            exit();
        } else {
            $errorMessage = "No record found with the specified ID.";
        }

        // Close the statement and connection
        $stmt->close();
    }
    $conn->close();
} catch (mysqli_sql_exception $e) {
    $errorMessage = "Error: " . $e->getMessage();
} catch (Exception $e) {
    $errorMessage = "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/icon.png"/>
    <title>Update Online Session</title>
    <link rel="stylesheet" href="css/nav-S.css">
</head>
<body>
    <div class="header">
        <div class="logo">
            <a href="<?php echo htmlspecialchars($mainPageURL); ?>"><img src="images/selfo.jpg" alt="Company Logo"></a>
        </div>
    </div>
    <main>
        <div class="container my-5">
            <h2>Update Online Session</h2>

            <?php if (!empty($errorMessage)): ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong><?php echo $errorMessage; ?></strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (!empty($successMessage)): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong><?php echo $successMessage; ?></strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <form method="post">
                <input type="hidden" name="online_id" value="<?php echo $online_id; ?>">
                <div class="form-group">
                    <label for="course_code" class="col-sm-3 col-form-label">Course Code</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="course_code" id="course_code" value="<?php echo $course_code; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="link_meet" class="col-sm-3 col-form-label">Link Meeting</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="link_meet" id="link_meet" value="<?php echo $link_meet; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="tutor_id" class="col-sm-3 col-form-label">Tutor</label>
                    <div class="col-sm-6">
                        <select class="form-control" name="tutor_id" id="tutor_id">
                            <?php foreach ($tutors as $tutor): ?>
                                <option value="<?php echo $tutor['tutor_id']; ?>" <?php if ($tutor['tutor_id'] == $tutor_id) echo 'selected'; ?>><?php echo $tutor['tutor_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a class="btn btn-outline-primary" href="listOnlineSession.php" role="button">Cancel</a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
