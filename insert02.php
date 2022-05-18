<html>
    <head>
        <title> Insert query Demo </title> 
        <link type="text/css" rel="stylesheet" href="base.css">
    </head>
    <body>
    <body>
        <nav>
            <ul>
                <li><a href="insert01.php" class="back">&lArr; Insert Query 01</a></li>
                <li><a href="delete01.php" class="forward"> Delete User V1 &rArr;</a></li>
            </ul>
        </nav>
        <br>
        <?php 
            /*require_once "pdo.php";*/ 
            require_once "pdopostgres.php"; 
            $nameOldValue="";
            $emailOldValue="";
            $passwordOldValue = "";
            if ( isset($_POST['name']) && isset($_POST['email']) 
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
                    ':password' => $passwordOldValue));
}
            $stmt = $pdo->query("select * from users");
            echo "<table>";
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                echo "<tr>";
                echo "<td>" . " " . $row['user_id'] . " </td>" . "<td> " . $row['name'] . " </td> "
                . "<td> " . $row['email'] . " </td> ";
                echo "</tr>";
            }
            
        ?>
        <p class = "highlite">Add A New User</p>
            <form method="post">
                <p>Name:<input type="text" name="name" size="40" value = <?php echo "$nameOldValue" ?> ></p>
                <p>Email:<input type="text" name="email" value = <?php echo "$emailOldValue" ?> ></p>
                <p>Password:<input type="password" name="password" value = <?php echo "$passwordOldValue" ?> ></p>
                <p><input type="submit" value="Add New"/></p>
            </form>
        
    </body>
</html>