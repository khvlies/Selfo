<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "selfodb";

//create connection
$connection = new mysqli($servername, $username, $password, $database);

$tutor_id ="";
$tutor_password ="";
$tutor_name ="";
$tutor_phone="";
$tutor_email ="";

$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'POST'){
    $tutor_id =$_POST["tutor_id"];
    $tutor_password =$_POST["tutor_password"];
    $tutor_name =$_POST["tutor_name"];
    $tutor_phone =$_POST["tutor_phone"];
    $tutor_email =$_POST["tutor_email"];
    $admin_id =$_POST["admin_id"];

    do {
        if ( empty($tutor_id) || empty($tutor_password) || empty($tutor_name) || empty($tutor_phone) || empty($tutor_email) ) {
            $errorMessage = "All the fields are required";
            break;
        }

        // Add new tutor to database
        $sql = "INSERT INTO tutor (tutor_id, tutor_password, tutor_name, tutor_phone, tutor_email) VALUES ('$tutor_id', '$tutor_password', '$tutor_name', '$tutor_phone', '$tutor_email')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $tutor_id ="";
        $tutor_password ="";
        $tutor_name ="";
        $tutor_phone="";
        $tutor_email ="";

        $successMessage = "tutor added correctly";

        header("location: listTutor.php");
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
    <title>Tutor</title>
    <link rel="stylesheet" href="css/style2.css">
    <script src ="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <main>
    <div class="container my-5">
        <h2>New Tutor</h2>

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
                    <input type="text" class="form-control" name="tutor_id" value="<?php echo $tutor_id; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="tutor_password" value="<?php echo $tutor_password; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="tutor_name" value="<?php echo $tutor_name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Phone Number</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="tutor_phone" value="<?php echo $tutor_phone; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="tutor_email" value="<?php echo $tutor_email; ?>">
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
                    <a class="btn btn-outline-primary" href="listTutor.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div> 
    </main>
</body>
</html>