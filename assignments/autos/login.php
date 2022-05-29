<?php
    session_start();
    if(!empty($_POST["autosUserID"]) && !empty($_POST["autosPwd"])) {
        $hashOfpassword = "1a52e17fa899cf40fb04cfc42e6352f1";
        $salt = 'XyZzy12*_';
        $password = $salt . $_POST["autosPwd"];
        if ($hashOfpassword == hash('md5',$password)) {
            $_SESSION['autosUserID'] = $_POST['autosUserID'];
            header("Location: autos.php?name=".urlencode($_POST['autosUserID']));
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
        <title> Login Autos </title> 
    </head>
    <body>
        <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                unset($_SESSION['message']);

            };
        ?>
            <form method="post">
                <p>User ID:<input type="text" name="autosUserID" value = "" size="40" ></p>
                <p>Password:<input type="password" name="autosPwd" value = ""></p>
                <p><input type="submit" name= "LogIn" value="LogIn"></p>
            </form>
        
    </body>
</html>