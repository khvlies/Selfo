<?php
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
    
    $course_code = $_POST["course_code"];
    $link_meet = $_POST["link_meet"];
    $tutor_id = $_POST["tutor_id"];

    do {
        if ( empty($course_code) || empty($link_meet) || empty($tutor_id)) {
            $errorMessage = "All the fields are required";
            break;
        }

        // Add new user to database
        $sql = "INSERT INTO online_session ( course_code, link_meet, tutor_id) VALUES ( '$course_code', '$link_meet', '$tutor_id')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $course_code = "";
        $link_meet = "";
        $tutor_id = "";

        $successMessage = "Online Session added correctly";

        header("location: /SLMS2/listOnlineSession.php");
        exit;

    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/icon.png"/>
    <title>Online Session</title>
    <link rel="stylesheet" href="css/style2.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
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
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Course Code</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="course_code" value="<?php echo $course_code; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Content</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="link_meet" value="<?php echo $link_meet; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Tutor ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="tutor_id" value="<?php echo $tutor_id; ?>">
                </div>
            </div>

            <?php
            if (!empty($successMessage)) {
                echo "
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                </div>
                 "; 
            }
            ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/SLMS2/listOnlineSession.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
    </main>
</body>
</html>
