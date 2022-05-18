<?php
    $message = "";
    session_start();
    if (!isset($_SESSION['pizza'])){
        $_SESSION['pizza'] = 0;
        $message = "session is empty";
    } elseif ($_SESSION['pizza'] < 3){
        $_SESSION['pizza'] = $_SESSION['pizza'] + 1;
        $message = "value of pizza is " . $_SESSION['pizza'];
    } else {
        session_destroy();
        session_start();
        $message = "session destroyed and recreated";
    }
?>



<html>
    <head>
        <title> Session Documentation!! </title> 
        <link type="text/css" rel="stylesheet" href="base.css">
    </head>
    <body>
        <nav>
            <ul>
                <li><a href="cookie01.php" class="back">&lArr; Cookie</a></li>
                <li><a href="redirect.php" class="forward"> Redirect &rArr;</a></li>
            </ul>
        </nav>
        <h1>Session Demo</h1>
        <pre> 
            <h2><?php echo $message?> </h2>
            Session id is  <?php echo session_id(); ?> 
            Printing session <?php print_r($_SESSION); ?>
            <a href = "session01.php"> Click Me</a> or Refresh the Page 
        </pre>

        <pre> <h3> 
           session_start(); -- This command starts the session; it creates a session cookie;
           creates the storage on the server side; associates the cookie value with the session 
           storage; loads the storage in to $_SESSION global variable which an associative array
           every time page is requested session cookie is sent and php loads the storage . Now we
           can change storage and it will be saved automatically.

           session_start();
            if (!isset($_SESSION['pizza'])){
                $_SESSION['pizza'] = 0;
                $message = "session is empty";
            } elseif ($_SESSION['pizza'] < 3){
                $_SESSION['pizza'] = $_SESSION['pizza'] + 1;
                $message = "value of pizza is " . $_SESSION['pizza'];
            } else {
                session_destroy();
                session_start();
                $message = "session destroyed and recreated";
            }
        </h3></pre>
    </body>
</html>