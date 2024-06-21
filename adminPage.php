<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="images/icon.png"/>
  <title>Administrator</title>
  <link rel="stylesheet" href="css/style3.css">
</head>
<body>
  <?php include('nav-A.php'); ?>

  <div class="content">
    <div class="row">
      <div class="column">
        <div id="Study Material" class="box-content">
          <a href="listStudyMaterial.php"><img src="images/studymaterial.png" alt="Book Icon"></a>
          <h2>Study Material</h2>
        </div>
      </div>
      <div class="column">
        <div id="Past Year" class="box-content">
          <a href="listPastYear.php"><img src="images/pastyear.png" alt="Question Icon"></a>
          <h2>Past Year</h2>
        </div>
      </div>
      <div class="column">
        <div id="Tutor" class="box-content">
          <a href="listTutor.php"><img src="images/tutor.png" alt="Chatbox Icon"></a>
          <h2>Tutor</h2>
        </div>
      </div>
      <div class="column">
        <div id="Payment" class="box-content">
          <a href="listPayment.php"><img src="images/payment.jpg" alt="Payment Icon"></a>
          <h2>Payment</h2>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
