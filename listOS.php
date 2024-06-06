<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/icon.png"/>
    <title>Online Session</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include('nav-T.php'); ?>
    <main>
    <div class="container my-5">
        <h2>List of Online Session</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ONLINE SESSION ID</th>
                    <th>COURSE CODE</th>
                    <th>CONTENT</th>
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
                $sql = "SELECT * FROM online_session";
                $result = $connection->query($sql);

                if (!$result){
                    die("Invalid query: ". $connection->error);
                }

                //read data of each row
                while($row = $result->fetch_assoc()){
                    echo "<tr>
                    <td>$row[online_id]</td>
                    <td>$row[course_code]</th>
                    <td>$row[link_meet]</th>
                    <td>
                        <a class='btn btn-primary btn-sm' href='downloadOS.php?file_id={$row['online_id']}'>Download</a>
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