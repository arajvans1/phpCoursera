<html>
    <head>
        <title> Select query Demo </title> 
        <link type="text/css" rel="stylesheet" href="base.css">
    </head>
    <body>
        <nav>
            <ul>
                <li><a href="database.php" class="back">&lArr; Database Doc</a></li>
                <li><a href="insert01.php" class="forward"> Insert querry 01 &rArr;</a></li>
            </ul>
        </nav>
        <pre class = "highlite" > Uses php.pdo file </pre>
        <?php
        require_once "pdo.php"; 
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


