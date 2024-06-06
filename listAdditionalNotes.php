<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/icon.png"/>
    <title>Additional Notes</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <img src="images/selfo.jpg" alt="Company Logo" style="width: 70px; height: auto;">
        <nav>
			<a href=" /SLMS2/tutor_page.php">Home</a>
			<a href=" /SLMS2/listAdditionalNotes.php">Additional Notes</a>
			<a href=" /SLMS2/listOnlineSession.php">Online Session</a>
			<a href=" /SLMS2/listPU.php">Premium User</a>
        </nav>
    </header>
    <main>
    <div class="container my-5">
        <h2>List of Additional Notes</h2>
        <a class="btn btn-secondary" href="/SLMS2/addAdditionalNotes.php" role="button">Add Additional Notes</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ADDITIONAL NOTES ID</th>
                    <th>COURSE CODE</th>
                    <th>CONTENT</th>
                    <th>TUTOR ID</th>
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
                $sql = "SELECT * FROM additional_notes";
                $result = $connection->query($sql);

                if (!$result){
                    die("Invalid query: ". $connection->error);
                }

                //read data of each row
                while($row = $result->fetch_assoc()){
                    echo "<tr>
                    <td>$row[addN_id]</td>
                    <td>$row[course_code]</th>
                    <td>$row[pdf_link]</th>
                    <td>$row[tutor_id]</td>
                    <td>
                        <a class='btn btn-primary btn-sm' href='/SLMS2/updateAdditionalNotes.php?addN_id=$row[addN_id]'>Update</a>
                        <a class='btn btn-danger btn-sm' href='/SLMS2/deleteAdditionalNotes.php?addN_id=$row[addN_id]'>Delete</a>
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