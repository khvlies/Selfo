<?php
session_start();

$admin_name = isset($_SESSION['admin_name']) ? $_SESSION['admin_name'] : 'Admin';
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Past Year</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #097F94;
    }
    .menu {
      background-color: #097F94;
      padding: 50px 0;
      text-align: center;
    }
    .menu a {
      text-decoration: none;
      color: #fff;
      padding: 0 30px;
    }
    .menu a:hover {
      background-color: #ddd;
      color: #fff;
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
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      z-index: 1000;
    }
    .logo img {
      width: 100px;
      height: auto;
      padding: 10px;
      margin-left: 10px;
    }
    .menu-items {
      display: flex;
      justify-content: center;
      flex: 1;
    }
    .menu-items a {
      padding: 20px 30px;
      color: black;
      text-align: center;
      text-decoration: none;
    }
    .menu-items a:hover:not(.active) {
      background-color: #097F94;
      color: white;
    }
    .active {
      background-color: #097F94 !important;
      color: white !important;
    }
    .profile {
      display: flex;
      align-items: center;
      padding-right: 20px;
    }
    .profile img {
      width: 50px;
      height: auto;
      border-radius: 50%;
      margin-right: 10px;
    }
    .profile a {
      color: black;
      text-decoration: none;
    }
    .profile a:hover {
      color: #097F94;
    }
    @media screen and (max-width: 600px) {
      .profile img {
        width: 40px;
      }
      .menu-items a {
        padding: 10px;
      }
    }
    .container {
      margin-top: 130px;
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      max-width: 1200px;
      margin: 130px auto 20px;
    }
    h2 {
      color: #097F94;
      text-align: center;
      margin-bottom: 20px;
    }
    .btn-primary {
      background-color: #097F94;
      border: none;
    }
    .btn-primary:hover {
      background-color: #065f6a;
    }
    table {
      margin-top: 20px;
    }
    th, td {
      text-align: center;
      vertical-align: middle;
      border: 1px solid #097F94;
    }
    </style>
</head>
<body>
    <ul>
        <li class="logo"><img src="../images/selfo.jpg" alt="Company Logo"></li>
        <div class="menu-items">
            <a href="adminMainpage.php">Home</a>
            <a href="listStudyMaterial.php">Study Material</a>
            <a class="active" href="listPastYear.php">Past Year</a>
            <a href="listBasicUser.php">Basic User</a>
            <a href="listPremiumUser.php">Premium User</a>
            <a href="listTutor.php">Tutor</a>
        </div>
        <li class="profile">
            <img src="../images/profile.png" alt="Profile Icon"/>
            <a href="profilepage.php"><?php echo htmlspecialchars($admin_name); ?></a>
        </li>
    </ul>
    <div class="container">
        <h2>List Past Year Papers</h2>
        <a class="btn btn-primary" href="addPastYear.php" role="button">Add Past Year Paper</a>
        <table class="table">
            <thead>
                <tr>
                    <th>PAPER ID</th>
                    <th>COURSE CODE</th>
                    <th>PAST YEAR PAPER</th>
                    <th>ANSWER PAPER</th>
                    <th>ADMIN ID</th>
                    <th>OPTIONS</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "educationdb";

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
                    <td><a href='" . htmlspecialchars($row['answer_LinkHref'], ENT_QUOTES, 'UTF-8') . "' target='_blank'>Download</a></td>
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
</body>
</html>
