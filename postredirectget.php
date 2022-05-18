<?php
    session_start();
    if(isset($_POST['insert']) && isset($_POST['name'])){
        $_SESSION['insert'] = 'insert';
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['password'] = $_POST['password'];
        header('Location: postredirectget.php');
        return;
    } elseif (isset($_POST['delete'])){
        $_SESSION['delete'] = 'delete';
        $_SESSION['user_id'] = $_POST['user_id'];
        header('Location: postredirectget.php');
        return;
    }
?>

<html>
    <head>
        <title> Delete Insert Demo </title> 
        <link type="text/css" rel="stylesheet" href="base.css">
    </head>
    <body>
    <body>
        <nav>
            <ul>
                <li><a href="redirect.php" class="back">&lArr; Redirect </a></li>
                <li><a href="login.php" class="forward"> Login &rArr;</a></li>
            </ul>
        </nav>
        <br>
        <?php 
            /*require_once "pdo.php"; */
            require_once "pdopostgres.php";
            $nameOldValue = "";
            $emailOldValue = "";
            $passwordOldValue = "";
            if ( isset($_SESSION['delete']) && isset($_SESSION['user_id'])) {
                $sql = "DELETE from users where user_id = :zip";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array(':zip' => $_SESSION['user_id']));
                unset($_SESSION['delete']);
            } elseif (isset($_SESSION['insert']) && isset($_SESSION['name']) && isset($_SESSION['email']) 
            && isset($_SESSION['password'])) {
                $nameOldValue = $_SESSION['name'];
                $emailOldValue = $_SESSION['email'];
                $passwordOldValue = $_SESSION['password'];
                $sql = "INSERT INTO users (name, email, password) 
                        VALUES (:name, :email, :password)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array(
                    ':name' => $nameOldValue,
                    ':email' => $emailOldValue,
                    ':password' => $passwordOldValue));
                unset($_SESSION['insert']);
                }

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
        <h1>Add A New User</h1>
            <form method="post">
                <p>Name:<input type="text" name="name" size="40" value = <?php echo "$nameOldValue" ?> ></p>
                <p>Email:<input type="text" name="email" value = <?php echo "$emailOldValue" ?> ></p>
                <p>Password:<input type="password" name="password" value = <?php echo "$passwordOldValue" ?> ></p>
                <p><input type="submit" value="Add New" name = "insert"></p>
            </form>
            <pre class = "highlite">
                Pattern is POST REDIRECT GET
                This avoids resubmiing the form after post is done.
                We should not send html as part of post request. 
                HTML should come as part of get request. 
                When a post request is made , we start a session and check if we have $_POST VALUES
                in it . if values are presnet we save them in to $_SESSION. We redirect i.e. do a GET
                request. on GET request we use $_SESSION to retrive the values we stored in it first time.
                Now we use the values to do the processing.

                Example:
                if(isset($_POST['insert'])){
                    $_SESSION['insert'] = 'insert';
                    $_SESSION['name'] = $_POST['name'];
                    $_SESSION['email'] = $_POST['name'];
                    $_SESSION['password'] = $_POST['password'];
                    header('Location: postredirectget.php');
                    return;
                } elseif (isset($_POST['delete'])){
                    $_SESSION['delete'] = 'delete';
                    $_SESSION['user_id'] = $_POST['user_id'];
                    header('Location: postredirectget.php');
                    return;
                }

                if ( isset($_SESSION['delete']) && isset($_SESSION['user_id'])) {
                $sql = "DELETE from users where user_id = :zip";
                .............
                unset($_SESSION['delete']);
                .............
                } elseif (isset($_SESSION['insert']) && isset($_SESSION['name']) && isset($_SESSION['email']) 
                && isset($_SESSION['password'])) {
                    $nameOldValue = $_SESSION['name'];
                    $emailOldValue = $_SESSION['email'];
                    $passwordOldValue = $_SESSION['password'];
                    $sql = "INSERT INTO users (name, email, password) 
                            VALUES (:name, :email, :password)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(array(
                        ':name' => $nameOldValue,
                        ':email' => $emailOldValue,
                        ':password' => $passwordOldValue));
                    unset($_SESSION['insert']);
                    }

                    <h2> Issue: Inserting Blank fields; value of isset($_POST['name']) is TRUE </h2>
            </pre>
    </body>
</html>