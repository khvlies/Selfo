<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/icon.png"/>
    <title>Basic User</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <img src="images/selfo.jpg" alt="Company Logo" style="width: 70px; height: auto;">
        <nav>
            <a href=" adminPage.php">Home</a>
            <a href=" listPremiumUser.php">Premium User</a>
            <a href=" listBasicUser.php">Basic User</a>
            <a href=" listStudyMaterial.php">Study Material</a>
            <a href=" listPastYear.php">Past Year</a>
            <a href=" listTutor.php">Tutor</a>
        </nav>
    </header>
    <main>
    <div class="container my-5">
        <h2>List of Basic User</h2>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>BASIC USER NAME</th>
                    <th>BASIC USER PHONE</th>
                    <th>BASIC USER EMAIL</th>
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
                $sql = "SELECT * FROM basic_user";
                $result = $connection->query($sql);

                if (!$result){
                    die("Invalid query: ". $connection->error);
                }

                //read data of each row
                while($row = $result->fetch_assoc()){
                    echo "<tr>
                    <td>$row[basic_id]</td>
                    <td>$row[basic_name]</td>
                    <td>$row[basic_phone]</td>
                    <td>$row[basic_email]</td>
                    <td>
                        <a class='btn btn-danger btn-sm' href='deleteBasicUser.php?basic_id=$row[basic_id]'>Delete</a>
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