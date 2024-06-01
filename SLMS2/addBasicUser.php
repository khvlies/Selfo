<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "educationdb";

//create connection
$connection = new mysqli($servername, $username, $password, $database);

$basic_id ="";
$basic_password ="";
$basic_name ="";
$basic_phone="";
$basic_email ="";
$study_id ="";
$paper_id ="";
$admin_id ="";

$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'POST'){
    $basic_id =$_POST["basic_id"];
    $basic_password =$_POST["basic_password"];
    $basic_name =$_POST["basic_name"];
    $basic_phone =$_POST["basic_phone"];
    $basic_email =$_POST["basic_email"];
    $study_id =$_POST["study_id"];
    $paper_id =$_POST["paper_id"];
    $admin_id =$_POST["admin_id"];

    do {
        if ( empty($basic_id) || empty($basic_password) || empty($basic_name) || empty($basic_phone) || empty($basic_email) || empty($study_id) || empty($paper_id) || empty($admin_id)) {
            $errorMessage = "All the fields are required";
            break;
        }

        //add new user to database
        $sql = "INSERT INTO basic_user (basic_id, basic_password, basic_name, basic_phone, basic_email, study_id, paper_id, admin_id) " . 
                "VALUES ('$basic_id', '$basic_password', '$basic_name', '$basic_phone', '$basic_email', '$study_id', '$paper_id', '$admin_id')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $basic_id ="";
        $basic_password ="";
        $basic_name ="";
        $basic_phone ="";
        $basic_email ="";
        $study_id ="";
        $paper_id ="";
        $admin_id ="";

        $successMessage = "basic user added correctly";

        header("location: /SLMS2/listBasicUser.php");
        exit;

    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basic User</title>
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
                    <input type="text" class="form-control" name="basic_id" value="<?php echo $basic_id; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="basic_password" value="<?php echo $basic_password; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="basic_name" value="<?php echo $basic_name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Phone Number</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="basic_phone" value="<?php echo $basic_phone; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="basic_email" value="<?php echo $basic_email; ?>">
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
                <label class="col-sm-3 col-form-label">Admin ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="admin_id" value="<?php echo $admin_id; ?>">
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
                    <a class="btn btn-outline-primary" href="/SLMS2/listBasicUser.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
    </main>
</body>
</html>