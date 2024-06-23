<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/icon.png"/>
    <title>Additional Notes</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<?php include('nav-P.php'); ?>
    <main>
    <div class="container my-5">
        <h2>List of Additional Notes</h2>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>CONTENT</th>
                    <th>UPLOAD DATE</th>
                    <th>UPLOADED BY</th>
                    <th>OPTIONS</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "selfodb";

                // Create connection
                $connection = new mysqli($servername, $username, $password, $database);

                // Check connection
                if ($connection->connect_error) {
                    die("Connection failed: " . $connection->connect_error);
                }

                // Read all rows from database table
                $sql = "SELECT additional_notes.addN_id, additional_notes.file_name, additional_notes.upload_date, tutor.tutor_name
                        FROM additional_notes
                        JOIN tutor ON additional_notes.tutor_id = tutor.tutor_id";
                $result = $connection->query($sql);

                if (!$result) {
                    die("Invalid query: " . $connection->error);
                }

                // Read data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['addN_id']}</td>
                        <td>{$row['file_name']}</td>
                        <td>{$row['upload_date']}</td>
                        <td>{$row['tutor_name']}</td>
                        <td>
                            <a class='btn btn-primary btn-sm' href='downloadAN.php?file_id={$row['addN_id']}'>Download</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    </main>
</body>
</html>
