<html>
    <head>
        <title> Delete Insert Demo </title> 
        <link type="text/css" rel="stylesheet" href="base.css">
    </head>
    <body>
    <body>
        <nav>
            <ul>
                <li><a href="delete01.php" class="back">&lArr; Delete User </a></li>
                <li><a href="cookie01.php" class="forward"> Cookies &rArr;</a></li>
            </ul>
        </nav>
        <br>
        <?php 
            /*require_once "pdo.php"; */
            require_once "pdopostgres.php";
            $nameOldValue="";
            $emailOldValue="";
            $passwordOldValue = "";
            if ( isset($_POST['delete']) && isset($_POST['user_id'])) {
                $sql = "DELETE from users where user_id = :zip";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array(':zip' => $_POST['user_id']));
            } elseif (isset($_POST['insert']) && isset($_POST['name']) && isset($_POST['email']) 
            && isset($_POST['password'])) {
                $nameOldValue = $_POST['name'];
                $emailOldValue = $_POST['email'];
                $passwordOldValue = $_POST['password'];
                $sql = "INSERT INTO users (name, email, password) 
                        VALUES (:name, :email, :password)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array(
                    ':name' => $nameOldValue,
                    ':email' => $emailOldValue,
                    ':password' => $passwordOldValue));}

            echo "<table>";
            $stmt = $pdo->query("select * from users");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                echo "<tr> <td>";
                echo $row['user_id'];
                echo "</td> <td> ";
                echo $row['name'];
                echo "</td> <td>";
                echo $row['email'];
                echo "</td> <td>";
                echo '<form method = "post"> <input type = "hidden" ';
                echo 'name = "user_id" value ="' . $row['user_id'] . '">' . "\n" ;
                echo '<input type = "submit" value = "Del" name = "delete">';
                echo "\n</form>\n";
                echo '</td>';
                echo "</tr>\n";
            }
            
        ?>
        <p class = "highlite">Add A New User</p>
            <form method="post">
                <p>Name:<input type="text" name="name" size="40" value = <?php echo "$nameOldValue" ?> ></p>
                <p>Email:<input type="text" name="email" value = <?php echo "$emailOldValue" ?> ></p>
                <p>Password:<input type="password" name="password" value = <?php echo "$passwordOldValue" ?> ></p>
                <p><input type="submit" value="Add New" name = "insert"></p>
            </form>
        
    </body>
</html>