<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "educationdb";

//create connection
$connection = new mysqli($servername, $username, $password, $database);

$premium_id ="";
$premium_password ="";
$premium_name ="";
$premium_phone="";
$premium_email ="";
$admin_id ="";
$study_id ="";
$paper_id ="";
$tutor_id ="";

$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'POST'){
    $premium_id =$_POST["premium_id"];
    $premium_password =$_POST["premium_password"];
    $premium_name =$_POST["premium_name"];
    $premium_phone =$_POST["premium_phone"];
    $premium_email =$_POST["premium_email"];
    $admin_id =$_POST["admin_id"];
    $study_id =$_POST["study_id"];
    $paper_id =$_POST["paper_id"];
    $tutor_id =$_POST["tutor_id"];

    do {
        if ( empty($premium_id) || empty($premium_password) || empty($premium_name) || empty($premium_phone) || empty($premium_email) || empty($admin_id) || empty($study_id) || empty($paper_id) || empty($tutor_id)) {
            $errorMessage = "All the fields are required";
            break;
        }

        //add new user to database
        $sql = "INSERT INTO premium_user (premium_id, premium_password, premium_name, premium_phone, premium_email, admin_id, study_id, paper_id, tutor_id) " . 
                "VALUES ('$premium_id', '$premium_password', '$premium_name', '$premium_phone', '$premium_email', '$admin_id', '$study_id', '$paper_id', '$tutor_id')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $premium_id ="";
        $premium_password ="";
        $premium_name ="";
        $premium_phone="";
        $premium_email ="";
        $admin_id ="";
        $study_id ="";
        $paper_id ="";
        $tutor_id ="";

        $successMessage = "premium user added correctly";

        header("location: /SLMS2/listPremiumUser.php");
        exit;

    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premium User</title>
    <link rel="stylesheet" href="css/style2.css">
    <script src ="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <main>
    <div class="container my-5">
        <h2>New User</h2>

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
                    <input type="text" class="form-control" name="premium_id" value="<?php echo $premium_id; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="premium_password" value="<?php echo $premium_password; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="premium_name" value="<?php echo $premium_name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Phone Number</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="premium_phone" value="<?php echo $premium_phone; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="premium_email" value="<?php echo $premium_email; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Admin ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="admin_id" value="<?php echo $admin_id; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Study Material ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="study_id" value="<?php echo $study_id; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Past Year Paper ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="paper_id" value="<?php echo $paper_id; ?>">
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
                    <a class="btn btn-outline-primary" href="/SLMS2/listPremiumUser.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
    </main>
</body>
</html>