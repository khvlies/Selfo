<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premium User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>List of Premium User</h2>
        <a class="btn btn-primary" href="addPremiumUser.php" role="button">New User</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>PREMIUM USER ID</th>
                    <th>PREMIUM USER PASSWORD</th>
                    <th>PREMIUM USER NAME</th>
                    <th>PREMIUM USER PHONE</th>
                    <th>PREMIUM USER EMAIL</th>
                    <th>ADMIN ID</th>
                    <th>STUDY MATERIAL ID</th>
                    <th>PAST YEAR PAPER ID</th>
                    <th>TUTOR ID</th>
                    <th>OPTIONS</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "educationdb2";

                //create connection
                $connection = new mysqli($servername, $username, $password, $database);

                //check connection
                if ($connection->connect_error){
                    die("Connection failed: ". $connection->connect_error);
                }

                //read all row from database table
                $sql = "SELECT * FROM premium_user";
                $result = $connection->query($sql);

                if (!$result){
                    die("Invalid query: ". $connection->error);
                }

                //read data of each row
                while($row = $result->fetch_assoc()){
                    echo "<tr>
                    <td>$row[premium_id]</td>
                    <td>$row[premium_password]</th>
                    <td>$row[premium_name]</td>
                    <td>$row[premium_phone]</td>
                    <td>$row[premium_email]</td>
                    <td>$row[admin_id]</td>
                    <td>$row[study_id]</td>
                    <td>$row[paper_id]</td>
                    <td>$row[tutor_id]</td>
                    <td>
                        <a class='btn btn-primary btn-sm' href='updatePremiumUser.php?premium_id=$row[premium_id]'>Update</a>
                        <a class='btn btn-danger btn-sm' href='deletePremiumUser.php?premium_id=$row[premium_id]'>Delete</a>
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