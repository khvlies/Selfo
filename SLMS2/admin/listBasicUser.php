<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basic User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>List of Basic User</h2>
        <a class="btn btn-primary" href="/SLMS2/addBasicUser.php" role="button">New User</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>BASIC USER ID</th>
                    <th>BASIC USER PASSWORD</th>
                    <th>BASIC USER NAME</th>
                    <th>BASIC USER PHONE</th>
                    <th>BASIC USER EMAIL</th>
                    <th>STUDY MATERIAL ID</th>
                    <th>PAST YEAR PAPER ID</th>
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
                $sql = "SELECT * FROM basic_user";
                $result = $connection->query($sql);

                if (!$result){
                    die("Invalid query: ". $connection->error);
                }

                //read data of each row
                while($row = $result->fetch_assoc()){
                    echo "<tr>
                    <td>$row[basic_id]</td>
                    <td>$row[basic_password]</th>
                    <td>$row[basic_name]</td>
                    <td>$row[basic_phone]</td>
                    <td>$row[basic_email]</td>
                    <td>$row[study_id]</td>
                    <td>$row[paper_id]</td>
                    <td>$row[admin_id]</td>
                    <td>
                        <a class='btn btn-primary btn-sm' href='/SLMS2/updateBasicUser.php?basic_id=$row[basic_id]'>Update</a>
                        <a class='btn btn-danger btn-sm' href='/SLMS2/deleteBasicUser.php?basic_id=$row[basic_id]'>Delete</a>
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