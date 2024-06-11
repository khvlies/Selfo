<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/icon.png"/>
    <title>Past Year</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<?php include('nav-B.php'); ?>
    <main>
    <div class="container my-5">
        <h2>List of Past Year</h2>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>COURSE CODE</th>
                    <th>CONTENT</th>
                    <th>UPLOAD DATE</th>
                    <th>OPTIONS</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "selfodb";

                //create connection
                $connection = new mysqli($servername, $username, $password, $database);

                //check connection
                if ($connection->connect_error){
                    die("Connection failed: ". $connection->connect_error);
                }

                //read all row from database table
                $sql = "SELECT * FROM past_year_paper";
                $result = $connection->query($sql);

                if (!$result){
                    die("Invalid query: ". $connection->error);
                }

                //read data of each row
                while($row = $result->fetch_assoc()){
                    echo "<tr>
                    <td>{$row['paper_id']}</td>
                    <td>{$row['course_code']}</td>
                    <td>{$row['file_name']}</td>
                    <td>{$row['upload_date']}</td>
                    <td>
                        <a class='btn btn-primary btn-sm' href='downloadPY.php?file_id={$row['paper_id']}'>Download</a>
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