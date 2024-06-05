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
    <header>
        <img src="images/selfo.jpg" alt="Company Logo" style="width: 70px; height: auto;">
        <nav>
            <a href=" /SLMS2/adminPage.php">Home</a>
            <a href=" /SLMS2/listPremiumUser.php">Premium User</a>
            <a href=" /SLMS2/listBasicUser.php">Basic User</a>
            <a href=" /SLMS2/listStudyMaterial.php">Study Material</a>
            <a href=" /SLMS2/listPastYear.php">Past Year</a>
            <a href=" /SLMS2/listTutor.php">Tutor</a>
        </nav>
    </header>
    <main>
    <div class="container my-5">
        <h2>List of Past Year</h2>
        <a class="btn btn-secondary" href="/SLMS2/addPastYear.php" role="button">Add Past Year Paper</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>PAPER ID</th>
                    <th>COURSE CODE</th>
                    <th>PAST YEAR PAPER</th>
                    <th>ANSWER PAPER</th>
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
                    <td>$row[paper_id]</td>
                    <td>$row[course_code]</td>
                    <td>$row[paper]</td>
                    <td>$row[answer]</td>
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
    </main>
</body>
</html>