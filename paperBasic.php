<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "selfodb";

//create connection
$connection = new mysqli($servername, $username, $password, $database);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Study Material</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #097F94;
    }
    .table-container {
      background-color: #fff;
      margin: 100px auto;
      width: 80%;
      padding: 20px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .table {
      width: 100%;
      border-collapse: collapse;
      background-color: #fff;
      text-align: center;
    }
    .table th, .table td {
      border: 1px solid #ddd;
      padding: 8px;
    }
    .table th {
      padding-top: 12px;
      padding-bottom: 12px;
      background-color: #fff;
      color: black;
    }
    .row {
      text-align: center;
    }
    ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
      overflow: hidden;
      background-color: #fff;
      position: fixed;
      top: 0;
      width: 100%;
      box-shadow: 0 4px 2px -2px gray;
      display: flex;
      align-items: center;
    }
    li {
      float: left;
    }
    .logo img {
      width: 70px;
      height: auto;
    }
    .logo {
      flex: 1;
      text-align: left;
      padding-left: 20px;
    }
    li a {
      display: block;
      color: black;
      text-align: center;
      padding: 25px;
      margin: 0 10px;
      text-decoration: none;
      font-size: 24px;
    }
    li a:hover:not(.active) {
      background-color: #097F94;
      color: white;
    }
    .active {
      background-color: #097F94;
      color: white;
    }
  </style>
</head>
<body>
  <ul>
    <li class="logo"><img src="selfo.png" alt="Company Logo"></li>
    <li><a href="basicHome.php" class="home-link">Home</a></li>
	  <li><a href="studyMaterialBasic.php" class="material-link">Study Material</a></li>
    <li><a class="active" href="paperBasic.php">Past Year</a></li>
  </ul>

  <div style="padding: 80px 20px;">
    <div class="row">
      <div class="table-container">
        <table class="table">
          <thead>
            <tr>
              <th>PAPER ID</th>
              <th>COURSE CODE</th>
              <th>PAST YEAR PAPER</th>
              <th>ADMIN ID</th>
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
            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }

            // Read all rows from database table
            $sql = "SELECT * FROM past_year_paper";
            $result = $connection->query($sql);

            if (!$result) {
                die("Invalid query: " . $connection->error);
            }

            // Read data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                <td>" . htmlspecialchars($row['paper_id'], ENT_QUOTES, 'UTF-8') . "</td>
                <td>" . htmlspecialchars($row['course_code'], ENT_QUOTES, 'UTF-8') . "</td>
                <td><a href='" . htmlspecialchars($row['content_LinkHref'], ENT_QUOTES, 'UTF-8') . "' target='_blank'>Download</a></td>
                <td>" . htmlspecialchars($row['admin_id'], ENT_QUOTES, 'UTF-8') . "</td>
                <td>
                    <a class='btn btn-primary btn-sm' href='updatePastYear.php?paper_id=" . htmlspecialchars($row['paper_id'], ENT_QUOTES, 'UTF-8') . "'>Update</a>
                    <a class='btn btn-danger btn-sm' href='deletePastYear.php?paper_id=" . htmlspecialchars($row['paper_id'], ENT_QUOTES, 'UTF-8') . "'>Delete</a>
                </td>
                </tr>";
            }

            $connection->close();
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>