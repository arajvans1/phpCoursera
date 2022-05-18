<?php
/*require_once "pdo.php"; */
require_once "pdopostgres.php";
$nameOldValue="";
if ( isset($_POST['name']) && isset($_POST['email']) 
     && isset($_POST['password'])) {
    $nameOldValue = $_POST['name'];
    $emailOldValue = $_POST['email'];
    $passwordOldValue = $_POST['password'];
    $sql = "INSERT INTO users (name, email, password) 
              VALUES (:name, :email, :password)";
    echo("<pre>\n".$sql."\n</pre>\n");
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':name' => $nameOldValue,
        ':email' => $emailOldValue,
        ':password' => $passwordOldValue));
}

?>
<html>
    <head>
        <title> Insert query Demo </title> 
        <link type="text/css" rel="stylesheet" href="base.css">
    </head>
    <body>
        <nav>
            <ul>
                <li><a href="select02.php" class="back">&lArr; Select Querry</a></li>
                <li><a href="insert02.php" class="forward"> Insert querry 02 &rArr;</a></li>
            </ul>
        </nav>
        <p class = "highlite">Add A New User</p>
            <form method="post">
                <p>Name:<input type="text" name="name" size="40" ></p>
                <p>Email:<input type="text" name="email"></p>
                <p>Password:<input type="password" name="password"></p>
                <p><input type="submit" value="Add New"/></p>
            </form>
    </body>
</html>
