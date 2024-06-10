<?php
// Enable error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$servername = "localhost";
$username = "root";
$password = "";
$database = "selfodb";

// Database connection
$conn = new mysqli($servername, $username, $password, $database);

$tutor_id ="";
$tutor_password ="";
$tutor_name ="";
$tutor_phone ="";
$tutor_email ="";

$errorMessage = "";
$successMessage = "";

try {
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if (!isset($_GET["tutor_id"])) {
            header("location: listTutor.php");
            exit;
        }

        $tutor_id = $_GET["tutor_id"];

        $sql = "SELECT * FROM tutor WHERE tutor_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $tutor_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if (!$row) {
            header("location: listTutor.php");
            exit;
        }

        $tutor_password = $row["tutor_password"];
        $tutor_name = $row["tutor_name"];
        $tutor_phone = $row["tutor_phone"];
        $tutor_email = $row["tutor_email"];
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve and sanitize user input
        $tutor_id = $_POST['tutor_id'];
        $tutor_password = $_POST['tutor_password'];
        $tutor_name = $_POST['tutor_name'];
        $tutor_phone = $_POST['tutor_phone'];
        $tutor_email = $_POST['tutor_email'];


        // Prepare an update statement
        $sql = "UPDATE tutor SET tutor_password = ?, tutor_name = ?, tutor_phone = ?, tutor_email = ?  WHERE tutor_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $tutor_password, $tutor_name, $tutor_phone, $tutor_email, $tutor_id);

        // Execute the statement
        $stmt->execute();

        // Check if any row was updated
        if ($stmt->affected_rows > 0) {
            $successMessage = "Record updated successfully.";
            // Redirect to listTutor.php after successful update
            header("Location: listTutor.php");
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
        <h2>Update Tutor</h2>

        <?php
        if (!empty($errorMessage)) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }

        if (!empty($successMessage)) {
            echo "
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>$successMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>

        <form method="post">
            <div class="form-group">
                <label for="tutor_id" >ID</label>
                <input type="text" name="tutor_id" value="<?php echo $tutor_id; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="tutor_password">Password</label>
                <input type="text" name="tutor_password" value="<?php echo $tutor_password; ?>">
            </div>
            <div class="form-group">
                <label for="tutor_name">Name</label>
                <input type="text" name="tutor_name" value="<?php echo $tutor_name; ?>">
            </div>
            <div class="form-group">
                <label for="tutor_phone">Phone Number</label>
                <input type="text" name="tutor_phone" value="<?php echo $tutor_phone; ?>">
            </div>
            <div class="form-group">
                <label for="tutor_email">Email</label>
                <input type="text" name="tutor_email" value="<?php echo $tutor_email; ?>">
            </div>
            <div class="form-buttons">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a class="btn btn-outline-primary" href="listTutor.php" role="button">Cancel</a>
            </div>
        </form>
    </div>
    </main>
</body>
</html>