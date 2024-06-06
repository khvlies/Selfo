<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/icon.png"/>
    <title>Study Material</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
   <header>
        <img src="images/selfo.jpg" alt="Company Logo" style="width: 70px; height: auto;">
        <nav>
			<a href=" basicMainPage.php">Home</a>
			<a href=" listSM.php">Study Material</a>
			<a href=" listPY.php">Past Year</a>
        </nav>
    </header>
    <main>
    <div class="container my-5">
        <h2>List of Study Material</h2>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>STUDY MATERIAL ID</th>
                    <th>COURSE CODE</th>
                    <th>CONTENT</th>
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