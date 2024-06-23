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
            <h2>List of Online Sessions</h2>
            <a class="btn btn-secondary" href="addOnlineSession.php" role="button">Add Online Session</a>
            <br>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>COURSE CODE</th>
                        <th>CONTENT</th>
                        <th>UPLOAD DATE</th>
                        <th>TUTOR</th>
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
                    if ($connection->connect_error){
                        die("Connection failed: ". $connection->connect_error);
                    }

                    // Read all rows from the database table
                    $sql = "SELECT os.online_id, os.course_code, os.link_meet, os.upload_date, t.tutor_name 
                            FROM online_session os
                            JOIN tutor t ON os.tutor_id = t.tutor_id";
                    $result = $connection->query($sql);

                    if (!$result){
                        die("Invalid query: ". $connection->error);
                    }

                    // Read data of each row
                    while($row = $result->fetch_assoc()){
                        echo "<tr>
                        <td>{$row['online_id']}</td>
                        <td>{$row['course_code']}</td>
                        <td>{$row['link_meet']}</td>
                        <td>{$row['upload_date']}</td>
                        <td>{$row['tutor_name']}</td>
                        <td>
                            <a class='btn btn-primary btn-sm' href='updateOnlineSession.php?online_id={$row['online_id']}'>Update</a>
                            <a class='btn btn-danger btn-sm' href='deleteOnlineSession.php?online_id={$row['online_id']}'>Delete</a>
                            <a class='btn btn-primary btn-sm' target='_blank' href=\"" . htmlspecialchars($row['link_meet'], ENT_QUOTES, 'UTF-8') . "\">Join Session</a>
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
