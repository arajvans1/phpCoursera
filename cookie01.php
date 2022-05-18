<?php
  session_start();
  if (!isset($_SESSION['account'])) {
      header('Location: login.php');
      return;
  } 
  $cookieValue ='';
  if (!isset($_COOKIE['zap'])){
      setcookie('zap','1', time()+3600);
    } else {
      $cookieValue = $_COOKIE['zap'];

}
  ?>

<html>
    <head>
        <title> Cookie Documentation!! </title> 
        <link type="text/css" rel="stylesheet" href="base.css">
    </head>
    <body>
        <nav>
            <ul>
                <li><a href="deleteinsert.php" class="back">&lArr; Delete Insert</a></li>
                <li><a href="session01.php" class="forward"> Session &rArr;</a></li>
            </ul>
        </nav>
        <h1>Site uses cookies</h1>
        <pre> 
            value in cookie is  <?php echo $cookieValue ?> 
            <a href = "cookie01.php"> Click Me</a> or Refresh the Page 

            cookie is stored in browser storage 
            
            if (!isset($_COOKIE['zap'])){
            setcookie('zap','1', time()+3600);
            } else {
            $cookieValue = $_COOKIE['zap'];

        </pre>

    </body>
</html>
