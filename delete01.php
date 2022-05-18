<html>
    <head>
        <title> Delete Demo </title> 
        <link type="text/css" rel="stylesheet" href="base.css">
    </head>
    <body>
    <body>
        <nav>
            <ul>
                <li><a href="insert02.php" class="back">&lArr; Insert Query 02</a></li>
                <li><a href="deleteinsert.php" class="forward"> Delete & Insert User &rArr;</a></li>
            </ul>
        </nav>
        <br>
        <?php 
            /*require_once "pdo.php"; */
            require_once "pdopostgres.php";
            $formUser_id = "";
            if ( isset($_POST['user_id'])) {
                $formUser_id = $_POST['user_id'];
                $sql = "DELETE from users where user_id = :zip";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array(':zip' => $formUser_id));
            }
            echo "<table>";
            $stmt = $pdo->query("select * from users");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                echo "<tr>";
                echo "<td>" . " " . $row['user_id'] . " </td>" . "<td> " . $row['name'] . " </td> "
                . "<td> " . $row['email'] . " </td> ";
                echo "</tr>";
            }
            
        ?>
        <p class = "highlite">Delete User</p>
            <form method="post">
                <p>User ID:<input type="text" name="user_id" size="40" value = <?php echo "$formUser_id" ?> ></p>
                <p><input type="submit" value="Delete User"/></p>
            </form>
        
    </body>
</html>