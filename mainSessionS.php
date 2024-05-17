<?php
    session_start();
    if(isset($_SESSION['username']) && $_SESSION['username'] != "Administrator"){
    ?>
    <html>
    <body>
    <?php echo $_SESSION['username']; ?> [<a href="logout.php">Logout</a>] <br>
    <a href="mainpageNew.html">Main Page</a>
    </body>
    </html>
    <?php
    } else {
    header("Location: loginpage.html");
}