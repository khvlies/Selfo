<?php
// Enable error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$servername = "localhost";
$username = "root";
$password = "";
$database = "selfodb";

// Database connection
$conn = new mysqli($servername, $username, $password, $database);

$errorMessage = "";

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if 'addN_id' is set
        if (isset($_POST['addN_id'])) {
            $id = $_POST['addN_id']; // ID to delete (VARCHAR)
        } else {
            throw new Exception("Error: 'addN_id' not set.");
        }

        // Prepare a delete statement
        $stmt = $conn->prepare("DELETE FROM additional_notes WHERE addN_id = ?");
        $stmt->bind_param("s", $id); // "s" indicates the parameter is a string

        // Execute the statement
        $stmt->execute();

        // Check if any row was deleted
        if ($stmt->affected_rows > 0) {
            // Record deleted successfully, redirect to listAdditionalNotes.php
            header("Location: listAdditionalNotes.php");
            exit;
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
    <title>Additional Notes</title>
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
        <h2>Delete Additional Notes</h2>

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
                    <input type="text" class="form-control" name="addN_id" value="">
                </div>
            </div>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Delete</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="listAdditionalNotes.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>