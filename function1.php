<html>
    <head>
        <title> get demo!! </title> 
        <link type="text/css" rel="stylesheet" href="base.css">
    </head>

    <body>
        <nav>
            <ul>
                <li><a href="get-01.php" class="back">&lArr; get-01.php</a></li>
                <li><a href="getform1.php" class="forward">Get Form &rArr;</a></li>
            </ul>
        </nav>
        <pre>
            <h1> Displaying Functions </h1>
            <p>
            <?php 
                function doStuff($a) {
                    return $a+100;
                }
                echo 'doStuff(10) -- adds 100 to 10'; 
                echo "\n";
               echo doStuff(10) . " Added 100 to 10"; 
            ?>
            </p>
        </pre>
    </body>
</html>