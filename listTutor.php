<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/icon.png"/>
    <title>Tutor</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include('nav-A.php'); ?>
    <main>
    <div class="container my-5">
        <h2>List of Tutor</h2>
        <a class="btn btn-secondary" href="addTutor.php" role="button">New Tutor</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>TUTOR NAME</th>
                    <th>TUTOR PASSWORD</th>
                    <th>TUTOR PHONE</th>
                    <th>TUTOR EMAIL</th>
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
                $sql = "SELECT * FROM tutor";
                $result = $connection->query($sql);

                if (!$result){
                    die("Invalid query: ". $connection->error);
                }

                //read data of each row
                while($row = $result->fetch_assoc()){
                    echo "<tr>
                    <td>$row[tutor_id]</td>
                    <td>$row[tutor_name]</td>
                    <td>$row[tutor_password]</th>
                    <td>$row[tutor_phone]</td>
                    <td>$row[tutor_email]</td>
                    <td>
                        <a class='btn btn-primary btn-sm' href='updateTutor.php?tutor_id=$row[tutor_id]'>Update</a>
                        <a class='btn btn-danger btn-sm' href='deleteTutor.php?tutor_id=$row[tutor_id]'>Delete</a>
                    </td>
                </tr>
                ";
                }
                ?>
            </tbody>
        </table>
    </div>
    </main>
</body>
</html>