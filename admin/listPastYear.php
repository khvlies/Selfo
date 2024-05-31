<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Past Year</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>List of Past Year</h2>
        <a class="btn btn-primary" href="/SLMS2/addPastYear.php" role="button">Add Past Year Paper</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>PAPER ID</th>
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
                $sql = "SELECT * FROM past_year_paper";
                $result = $connection->query($sql);

                if (!$result){
                    die("Invalid query: ". $connection->error);
                }

                //read data of each row
                while($row = $result->fetch_assoc()){
                    echo "<tr>
                    <td>$row[paper_id]</td>
                    <td>$row[course_code]</th>
                    <td>$row[content_LinkHref]</th>
                    <td>$row[admin_id]</td>
                    <td>
                        <a class='btn btn-primary btn-sm' href='/SLMS2/updatePastYear.php?paper_id=$row[paper_id]'>Update</a>
                        <a class='btn btn-danger btn-sm' href='/SLMS2/deletePastYear.php?paper_id=$row[paper_id]'>Delete</a>
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