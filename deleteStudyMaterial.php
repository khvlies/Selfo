<?php
// Enable error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$servername = "localhost";
$username = "root";
$password = "";
$database = "selfodb";

// Database connection
$conn = new mysqli($servername, $username, $password, $database);
$study_id = "";
$errorMessage = "";

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if 'study_id' is set
        if (!empty($_POST['study_id'])) {
            $id = $_POST['study_id']; // ID to delete (VARCHAR)
        } else {
            throw new Exception("Error: 'study_id' not set.");
        }

        // Retrieve the file path from the database
        $stmt = $conn->prepare("SELECT file_path FROM study_material WHERE study_id = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($file_path);
            $stmt->fetch();

            // Delete the file from the file system
            if (file_exists($file_path)) {
                unlink($file_path);
            } else {
                throw new Exception("File not found.");
            }

            $stmt->close();

            // Prepare a delete statement for the record
            $stmt = $conn->prepare("DELETE FROM study_material WHERE study_id = ?");
            $stmt->bind_param("s", $id);

            // Execute the statement
            $stmt->execute();

            // Check if any row was deleted
            if ($stmt->affected_rows > 0) {
                // Record deleted successfully, redirect to listStudyMaterial.php
                header("Location: listStudyMaterial.php");
                exit;
            } else {
                $errorMessage = "No record found with the specified ID.";
            }
        } else {
            $errorMessage = "No record found with the specified ID.";
        }

        // Close the statement and connection
        $stmt->close();
    }
    $conn->close();
} catch (mysqli_sql_exception $e) {
    $errorMessage = "Database error: " . $e->getMessage();
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
    <title>Study Material</title>
    <script src ="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this record?");
        }
    </script>
</head>
<body>
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            color: #333;
        }

        main {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #097F94;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-buttons {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 14px;
            border: none;
            border-radius: 25px;
            text-decoration: none;
            cursor: pointer;
            text-align: center;
        }

        .btn-primary {
            background-color: red;
            color: white;
        }

        .btn-primary:hover {
            background-color: #cc0000;
        }

        .btn-outline-primary {
            background-color: #f0f0f0;
            color: #333;
            border: 1px solid #ccc;
        }

        .btn-outline-primary:hover {
            background-color: #e0e0e0;
        }
    </style>
    <div class="container my-5">
        <h2>Delete Study Material</h2>

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

        <form method="post" onsubmit="return confirmDelete()">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" style="margin: 10px">ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="study_id" value="<?php echo $study_id; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Delete</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="listStudyMaterial.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>