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
    <title>List Basic Users</title>
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
      font-size: 0.8em;
    }
    th, td {
      text-align: center;
      vertical-align: middle;
    }
    </style>
</head>
<body>
    <ul>
        <li class="logo"><img src="../images/selfo.jpg" alt="Company Logo"></li>
        <div class="menu-items">
            <a href="adminMainpage.php">Home</a>
            <a href="listStudyMaterial.php">Study Material</a>
            <a href="listPastYear.php">Past Year</a>
            <a href="listBasicUser.php" class="active">Basic User</a>
            <a href="listPremiumUser.php">Premium User</a>
            <a href="listTutor.php">Tutor</a>
        </div>
        <li class="profile">
            <img src="../images/profile.png" alt="Profile Icon"/>
            <a href="profilepage.php"><?php echo htmlspecialchars($admin_name); ?></a>
        </li>
    </ul>
    <div class="container">
        <h2>List of Basic Users</h2>
        <a class="btn btn-primary" href="addBasicUser.php" role="button">Add New User</a>
        <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>BASIC USER ID</th>
                    <th>BASIC USER PASSWORD</th>
                    <th>BASIC USER NAME</th>
                    <th>BASIC USER PHONE</th>
                    <th>BASIC USER EMAIL</th>
                    <th>STUDY MATERIAL ID</th>
                    <th>PAST YEAR PAPER ID</th>
                    <th>ADMIN ID</th>
                    <th>OPTIONS</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "educationdb2";

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
                    <td>$row[basic_password]</th>
                    <td>$row[basic_name]</td>
                    <td>$row[basic_phone]</td>
                    <td>$row[basic_email]</td>
                    <td>$row[study_id]</td>
                    <td>$row[paper_id]</td>
                    <td>$row[admin_id]</td>
                    <td>
                        <a class='btn btn-primary btn-sm' href='updateBasicUser.php?basic_id=$row[basic_id]'>Update</a>
                        <a class='btn btn-danger btn-sm' href='deleteBasicUser.php?basic_id=$row[basic_id]'> Delete </a>
                    </td>
                </tr>
                ";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
