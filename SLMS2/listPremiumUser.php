<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premium User</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <div class="logo">SELFO</div>
        <nav>
        <a href=" /SLMS2/listPremiumUser.php">Premium User</a>
            <a href=" /SLMS2/listBasicUser.php">Basic User</a>
            <a href=" /SLMS2/listStudyMaterial.php">Study Material</a>
            <a href=" /SLMS2/listPastYear.php">Past Year</a>
            <a href=" /SLMS2/listTutor.php">Tutor</a>
        </nav>
    </header>
    <main>
    <div class="container my-5">
        <h2>List of Premium User</h2>
        <a class="btn btn-secondary" href="/SLMS2/addPremiumUser.php" role="button">New User</a>
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
                $database = "educationdb";

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
                        <a class='btn btn-primary btn-sm' href='/SLMS2/updatePremiumUser.php?premium_id=$row[premium_id]'>Update</a>
                        <a class='btn btn-danger btn-sm' href='/SLMS2/deletePremiumUser.php?premium_id=$row[premium_id]'>Delete</a>
                    </td>
                </tr>
                ";
                }
                ?>
            </tbody>
        </table>
    </div>
    </main>
    <footer>
        2024 Copyright Reserved
    </footer>
</body>
</html>