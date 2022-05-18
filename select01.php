<html>
    <head>
        <title> Select query Demo </title> 
        <link type="text/css" rel="stylesheet" href="base.css">
    </head>
    <body>
        <nav>
            <ul>
                <li><a href="database.php" class="back">&lArr; Database Doc</a></li>
                <li><a href="select02.php" class="forward"> select querry 02 &rArr;</a></li>
            </ul>
        </nav>
        <?php
        $pdo = new PDO('mysql:host=localhost;port=8889;dbname=misc', 'arajvans', 'arajvans');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        $stmt = $pdo->query("select * from users");
        echo '<pre class = "highlite"> select * from users; </pre>';
        echo "<pre> \n";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            print_r($row);
            echo "\n";
        }
        echo "</pre>"; 
        ?>
    </body>
<html>


