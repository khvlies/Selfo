<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="images/icon.png"/>
  <title>Premium User</title>
  <link rel="stylesheet" href="css/style3.css">
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <?php include('nav-P.php'); ?>
  <main>
    <div class="container my-5">
    <h2>List of Online Session</h2>
        <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ONLINE SESSION ID</th>
                    <th>COURSE CODE</th>
                    <th>LINK MEETING</th>
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
                    die("Connection failed: " . $connection->connect_error);
                }

                // Read all rows from the database table
                $sql = "SELECT * FROM online_session";
                $result = $connection->query($sql);

                if (!$result){
                    die("Invalid query: " . $connection->error);
                }

                // Read data of each row
                while($row = $result->fetch_assoc()){
                    echo "<tr>
                    <td>" . htmlspecialchars($row['online_id'], ENT_QUOTES, 'UTF-8') . "</td>
                    <td>" . htmlspecialchars($row['course_code'], ENT_QUOTES, 'UTF-8') . "</td>
                    <td><a href=\"" . htmlspecialchars($row['link_meet'], ENT_QUOTES, 'UTF-8') . "\">Join Session</a></td>
                    </tr>";
                }

                $connection->close();
                ?>
            </tbody>
        </table>
    </div>
  </main>
</body>
</html>