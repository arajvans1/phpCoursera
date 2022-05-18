<?php
    session_start();
    require_once "pdopostgres.php"; 
    if(!empty($_POST["userID"]) && !empty($_POST["pwd"])){
        $sql = "SELECT * from users where name = :zip";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(':zip' => $_POST['userID']));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($_POST['pwd'] == $row['password']) {
            unset($_SESSION['account']); /* logout cuurent user */
            $_SESSION['account'] = $_POST['userID']; 
            $message = "Login Successful";
            $_SESSION['message'] = $message;
            header('Location: app.php');
            return; 
        } 
        else {
            $message = "Incorrect Password";
            $_SESSION['message'] = $message;
            header('Location: login.php');
            return;
        }
    }
    
?>
<html>
    <head>
        <title> Login Demo </title> 
        <link type="text/css" rel="stylesheet" href="base.css">
    </head>
    <body>
        <nav>
            <ul>
                <li><a href="postredirectget.php" class="back">&lArr; POST/REDIRECT/GET </a></li>
                <li><a href="TBD.php" class="forward"> TBD &rArr;</a></li>
            </ul>
        </nav>
        <?php 
            /*require_once "pdo.php"; */
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                unset($_SESSION['message']);

            };
        ?>
            <form method="post">
                <p>User ID:<input type="text" name="userID" value = "" size="40" ></p>
                <p>Password:<input type="password" name="pwd" value = ""></p>
                <p><input type="submit" value="LogIn"></p>
            </form>
            <pre class = "highlite">
                Login demo:
            </pre>
    </body>
</html>