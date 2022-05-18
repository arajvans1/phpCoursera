<html>
    <head>
        <title> get demo!! </title> 
        <link type="text/css" rel="stylesheet" href="base.css">
    </head>

    <body>
        <nav>
            <ul>
                <li><a href="page1.php" class="back">&lArr; page1.php</a></li>
                <li><a href="function1.php" class="forward">Functions &rArr;</a></li>
            </ul>
        </nav>
        <pre>
            Displaying GET Array
            <?php echo $_GET["x"] , "\n";
                  print_r($_GET);
                  echo "\n";
                  var_dump($_GET);
            ?>
        </pre>
    </body>
</html>
