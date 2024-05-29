<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #097F94;
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      align-items: center;
      height: 100vh;
    }
    .header {
      background-color: #fff;
      padding: 10px 0;
      text-align: center;
      width: 100%;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .header .logo img {
      width: 70px;
      height: auto;
    }
    .row {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-wrap: wrap;
      width: 100%;
      margin-top: 100px;
    }
    .column {
      flex: 1;
      max-width: 450px;
      margin: 10px;
    }
    .box-content {
      background-color: rgba(300,300,300,0.6);
      padding: 25px;
      border-radius: 25px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      text-align: center;
    }
    @media screen and (max-width: 600px) {
      .column {
        max-width: 100%;
      }
    }
    li{
        display: block;
        text-align: left;
        color: white;
    }
  </style>
</head>
<body>
  <div class="header">
    <div class="logo">
      <img src="images/selfo.jpg" alt="Company Logo">
    </div>
  </div>
  <div style="font-size:2.5em; color:white; text-align:center; margin-top:50px;">Choose Your Plan</div>
  <div class="row">
    <div class="column">
      <div class="box-content">
        <h2>Basic</h2>
        <ul>
            <li style="font-size:2em;"> RM0
            <p>
            <li> Features you'll get :
            <li> 500+ Study Material
            <li> Past year question including suggested answer
        </ul>
      </div>
    </div>
    <div class="column">
      <div class="box-content">
        <h2>Premium</h2>
        <ul>
            <li style="font-size:2em;"> RM65/month
            <p>
            <li> Everything in free, plus:
            <li> Additional Notes
            <li> Tutor
        </ul>
      </div>
    </div>
  </div>
</body>
</html>
