<?php
    session_start();
    if(!empty($_POST["userID"]) && !empty($_POST["pwd"])) {
        $hashOfpassword = "1a52e17fa899cf40fb04cfc42e6352f1";
        $salt = 'XyZzy12*_';
        $password = $salt . $_POST["pwd"];
        if ($hashOfpassword == hash('md5',$password)) {
            $_SESSION['userID'] = $_POST['userID'];
            header("Location: game.php?name=".urlencode($_POST['userID']));
            return;
        } else {
            $_SESSION['message'] = "Invalid Password";
            header("Location: login.php");
            return;
        }    
    } elseif (!empty($_POST['LogIn'])) {
        $_SESSION['message'] = "Enter Password/UserID";
        header("Location: login.php");
        return;
    }       
?>

<html>
    <head>
        <title> Login Demo </title> 
    </head>
    <body>
        <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                unset($_SESSION['message']);

            };
        ?>
            <form method="post">
                <p>User ID:<input type="text" name="userID" value = "" size="40" ></p>
                <p>Password:<input type="password" name="pwd" value = ""></p>
                <p><input type="submit" name= "LogIn" value="LogIn"></p>
            </form>
        
    </body>
</html>