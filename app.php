<html>
<head>
        <title> Login Demo </title> 
        <link type="text/css" rel="stylesheet" href="base.css">
    </head>
    <body>
        <nav>
            <ul>
                <li><a href="app.php" class="back">&lArr; Home </a></li>
                <li><a href="TBD.php" class="forward"> TBD &rArr;</a></li>
            </ul>
        </nav>
        <?php 
            session_start();
            if (!isset($_SESSION['account'])) {
            echo '<a href=login.php> Login </a>';
            return;
            } else {
                echo $_SESSION['message'];
            }
        ?>

        Cool App 

        <a href=logout.php> logout </a>




