<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Main Page</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }
    .menu {
      background-color: #097F94;
      padding: 20px 0;
      text-align: center;
    }
    .menu a {
      text-decoration: none;
      color: #fff;
      padding: 0 30px;
    }
    .menu a:hover {
      background-color: #ddd;
      color: #333;
    }
	ul {
	  list-style-type: none;
	  margin: 0;
	  padding: 0;
	  overflow: hidden;
	  background-color: #fff;
      position:fixed;
      top: 0%;
      width: 100%;
	}

	li {
	  float: left;
	}

	li a {
	  display: block;
	  color: black;
	  text-align: center;
	  padding: 40px 50px;
	  text-decoration: none;
	}
	/* Change the link color to #097F94 (blue) on hover */
	li a:hover:not(.active){
	  background-color: #097F94;
	  color: white;
	}
  .active{
    background-color: #097F94;
    color:white;
  }
	.logo {
		text-align: center;
		margin: 20px;
  }
    .profile {
      float: right;
      display: flex;
      align-items: center;
      padding-right: 20px;
    }
    .profile img {
      width: 70px;
      height: auto;
      margin: 20px;
      border-radius: 50%;
      margin-right: 10px;
    }
    .profile a {
      color: black;
      padding: 0;
    }
    .profile a:hover {
      background-color: transparent;
      color: #097F94;
    }
    /* Create three equal columns that float next to each other */
    .column {
        float: left;
        width: 33.33%;
    }

    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }

    /* Responsive layout - makes the three columns stack on top of each other instead of next to each other on smaller screens (600px wide or less) */
    @media screen and (max-width: 600px) {
        .column {
        width: 100%;
        }
    }
    .box-content {
      background-color: #ffff;
      margin-block: 150px;
      padding: 25px;
      border-radius: 25px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      max-width: 300px;
      width: 80%;
      text-align: center;
      margin-left: auto;
      margin-right: auto;
    }
  </style>
</head>
<body>
  <ul>
    <li class="logo"><img src="images/selfo.jpg" alt="Company Logo" style="width: 70px; height: auto;"></li>
    <li><a class="active" href="#">Home</a></li>
    <li><a href="#">About</a></li>
    <li><a href="#">Study Material</a></li>
    <li><a href="#">Past Year</a></li>
    <li><a href="#">Tutor</a></li>
    <li class="profile">
      <img src="images/profile.png" alt="Profile Icon"/>
      <a href="#profile">Username</a>
    </li>
  </ul>
    <div style="padding:20px;margin-top:30px;background-color:#097F94;height:1500px;">
        <div class="row">
            <div class="column">
              <div id="Study Material" class="box-content">
                <img src="images/studymaterial.png" alt="Book Icon" style="width: 300px; height: auto;">
                <h2>Study Material</h2>
              </div>
            </div>
            
            <div class="column">
              <div id="Past Year" class="box-content">
                <img src="images/pastyear.png" alt="Question Icon" style="width: 300px; height: auto;">
                <h2>Past Year</h2>
              </div>
            </div>
            
            <div class="column">
              <div id="Tutor" class="box-content">
                <img src="images/tutor.png" alt="Chatbox Icon" style="width: 300px; height: auto;">
                <h2>Tutor</h2>
              </div>
            </div>
        </div>
    </div>
</body>
</html>
