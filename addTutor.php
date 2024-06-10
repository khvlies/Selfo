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
    <link rel="stylesheet" href="css/nav-S.css">
</head>
<body>
    <div class="header">
        <div class="logo">
        <a href="<?php echo htmlspecialchars($mainPageURL); ?>"><img src="images/selfo.jpg" alt="Company Logo"></a>
        </div>
    </div>

    <main style="margin-top: 100px">
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
            <div class="form-group">
                <label for="tutor_id">ID</label>
                <input type="text" name="tutor_id" value="<?php echo $tutor_id; ?>">
            </div>
            <div class="form-group">
                <label for="tutor_password" >Password</label>
                <input type="text" name="tutor_password" value="<?php echo $tutor_password; ?>">
            </div>
            <div class="form-group">
                <label for="tutor_name">Name</label>
                <input type="text"  name="tutor_name" value="<?php echo $tutor_name; ?>">
            </div>
            <div class="form-group">
                <label for="tutor_phone">Phone Number</label>
                <input type="text" name="tutor_phone" value="<?php echo $tutor_phone; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="tutor_email">Email</label>
                <input type="text" name="tutor_email" value="<?php echo $tutor_email; ?>">
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

            <div class="form=-buttons">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a class="btn btn-outline-primary" href="listTutor.php" role="button">Cancel</a>
            </div>
        </form>
    </div> 
    </main>
</body>
</html>