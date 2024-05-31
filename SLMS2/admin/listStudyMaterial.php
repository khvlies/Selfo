<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Study Material</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>List of Study Material</h2>
        <a class="btn btn-primary" href="/SLMS2/addStudyMaterial.php" role="button">Add Study Material</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>STUDY MATERIAL ID</th>
                    <th>COURSE CODE</th>
                    <th>CONTENT</th>
                    <th>ADMIN ID</th>
                    <th>OPTIONS</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "educationdb";

                //create connection
                $connection = new mysqli($servername, $username, $password, $database);

                //check connection
                if ($connection->connect_error){
                    die("Connection failed: ". $connection->connect_error);
                }

                //read all row from database table
                $sql = "SELECT * FROM study_material";
                $result = $connection->query($sql);

                if (!$result){
                    die("Invalid query: ". $connection->error);
                }

                //read data of each row
                while($row = $result->fetch_assoc()){
                    echo "<tr>
                    <td>$row[study_id]</td>
                    <td>$row[course_code]</th>
                    <td>$row[pdf_link]</th>
                    <td>$row[admin_id]</td>
                    <td>
                        <a class='btn btn-primary btn-sm' href='/SLMS2/updateStudyMaterial.php?study_id=$row[study_id]'>Update</a>
                        <a class='btn btn-danger btn-sm' href='/SLMS2/deleteStudyMaterial.php?study_id=$row[study_id]'>Delete</a>
                    </td>
                </tr>
                ";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>