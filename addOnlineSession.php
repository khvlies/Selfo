<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "selfodb";

//create connection
$connection = new mysqli($servername, $username, $password, $database);

$online_id ="";
$course_code ="";
$link_meet ="";

$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'POST'){
    $online_id =$_POST["online_id"];
    $course_code =$_POST["course_code"];
    $link_meet =$_POST["link_meet"];

    do {
        if ( empty($online_id) || empty($course_code)  || empty($link_meet)) {
            $errorMessage = "All the fields are required";
            break;
        }

        // Add new material to database
        $sql = "INSERT INTO online_session (online_id, course_code , link_meet ) VALUES ('$online_id', '$course_code' , '$link_meet')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $online_id ="";
        $course_code ="";
        $link_meet ="";

        $successMessage = "Online session added correctly";

        header("location: listOnlineSession.php");
        exit;

    } while (false);
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/style2.css">
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
                <label class="col-sm-3 col-form-label">ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="online_id" value="<?php echo $online_id; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Course Code</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="course_code" value="<?php echo $course_code; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Link Session</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="link_meet" value="<?php echo $link_meet; ?>">
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
                    <a class="btn btn-outline-primary" href="listOnlineSession.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div> 
    </main>
</body>
</html>