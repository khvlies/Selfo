<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "selfodb";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

$paper_id = "";
$course_code = "";
$content_LinkHref = "";
$answer_LinkHref = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $paper_id = $_POST["paper_id"];
    $course_code = $_POST["course_code"];
    $content_LinkHref = $_POST["content_LinkHref"];
    $answer_LinkHref = $_POST["answer_LinkHref"];

    do {
        if (empty($paper_id) || empty($course_code) || empty($content_LinkHref) || empty($answer_LinkHref)) {
            $errorMessage = "All the fields are required";
            break;
        }

        // Add new paper to database
        $sql = "INSERT INTO past_year_paper (paper_id, course_code, content_LinkHref, answer_LinkHref) VALUES ('$paper_id', '$course_code', '$content_LinkHref', '$answer_LinkHref')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        // Clear the input fields
        $paper_id = "";
        $course_code = "";
        $content_LinkHref = "";
        $answer_LinkHref = "";

        $successMessage = "Past year paper added correctly";

        // Redirect to listPastYear.php after successful insertion
        header("Location: /SLMS2/listPastYear.php");
        exit;

    } while (false);
}

// Close the connection
$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/icon.png"/>
    <title>Past Year</title>
    <link rel="stylesheet" href="css/style2.css">
    <script src ="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <main>
    <div class="container my-5">
        <h2>New Past Year Paper</h2>

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
                <label class="col-sm-3 col-form-label">ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="paper_id" value="<?php echo $paper_id; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Course Code</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="course_code" value="<?php echo $course_code; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Past Year Paper</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="content_LinkHref" value="<?php echo $content_LinkHref; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Answer Paper</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="answer_LinkHref" value="<?php echo $answer_LinkHref; ?>">
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
                    <a class="btn btn-outline-primary" href="/SLMS2/listPastYear.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
    </main>
</body>
</html>