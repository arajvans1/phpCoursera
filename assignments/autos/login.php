<?php
    session_start();
    if(!empty($_POST["autosUserId"]) && !empty($_POST["autosPwd"])) {
        if (strpos($_POST["autosUserId"],'@') == false) {
            $_SESSION['message'] = "Enter valid email id";
            $_SESSION['autosUserId'] = $_POST['autosUserId'];
            header("Location: login.php");
            return;
        }
        $hashOfpassword = "1a52e17fa899cf40fb04cfc42e6352f1";
        $salt = 'XyZzy12*_';
        $password = $salt . $_POST["autosPwd"];
        if ($hashOfpassword == hash('md5',$password)) {
            error_log("Successful login for " . $_POST['autosUserId']);
            $_SESSION['autosUserID'] = $_POST['autosUserID'];
            header("Location: autos.php?name=".urlencode($_POST['autosUserID']));
            return;
        } else {
            error_log("Invalid Password for " . $_POST['autosUserId']);
            $_SESSION['message'] = "Invalid Password";
            header("Location: login.php");
            return;
        }    
    } elseif (isset($_POST['LogIn'])) {
        $_SESSION['message'] = "Enter Password/UserID";
        header("Location: login.php");
        return;
    }       
?>

<html>
    <head>
        <title> Login Autos </title> 
        <link type="text/css" rel="stylesheet" href="style.css">
    </head>
    <body>
        
        <div class="container">
            <h1>Please log in to the Autos Database </h1>
            <span class="flash"><?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                unset($_SESSION['message']);

            };
        ?> 
        </span>
            <form method="post">
                <span class="label">User ID:</span><input type="text" name="autosUserId" value = "" size="20" > <br>
                <span class="label">Password:</span><input type="password" name="autosPwd" value = ""> <br> 
                <div class="button1"> <input type="submit" name= "LogIn" value="LogIn" > </div>
            </form>
        </div>
    </body>
</html>