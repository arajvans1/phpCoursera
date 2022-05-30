<?php
    require_once "pdo.php";
    session_start();
    if (! isset($_SESSION["autosUserId"])){
        die("Please login");
    }
    if(isset($_POST['add']) && isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage'])){
        if (!(is_numeric($_POST['year']) && is_numeric($_POST['mileage']))){
            $_SESSION['errorMessage'] = "year or mileage not numeric";
            header('location: autos.php');
            return;
        }
        
        $_SESSION['add'] = 'add';
        $_SESSION['make'] = htmlentities($_POST['make']);
        $_SESSION['year'] = htmlentities($_POST['year']);
        $_SESSION['mileage'] = htmlentities($_POST['mileage']);
        header('Location: autos.php');
        return;
    } elseif (isset($_POST['delete'])){
        $_SESSION['delete'] = 'delete';
        $_SESSION['auto_id'] = $_POST['auto_id'];
        header('Location: autos.php');
        return;
    }
?>

<html>
    <head>
        <title> Autos Database </title> 
        <link type="text/css" rel="stylesheet" href="style.css">
    </head>
    <body>
    <div class="container">
        <h2>Welcome <?php echo($_SESSION['autosUserId']); ?> to the Autos Database </h2>
        <span class = "flash"> <?php if(isset($_SESSION['errorMessage'])) echo($_SESSION['errorMessage']);unset($_SESSION['errorMessage']);?></span>
        <?php 
            require_once "pdo.php";
            if (isset($_SESSION['add']) && isset($_SESSION['make']) && isset($_SESSION['year']) 
            && isset($_SESSION['mileage'])) {
                $formMake = $_SESSION['make'];
                $formYear = $_SESSION['year'];
                $formMileage = $_SESSION['mileage'];
                $sql = "INSERT INTO autos (make, year, mileage) 
                        VALUES (:make, :year, :mileage)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array(
                    ':make' => $formMake,
                    ':year' => $formYear,
                    ':mileage' => $formMileage));
                unset($_SESSION['add']);
                } elseif (isset($_SESSION['delete']) && isset($_SESSION['auto_id'])) {
                    $sql = "Delete from autos where auto_id = :auto_id";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(array(':auto_id' => $_SESSION['auto_id']));
                    unset($_SESSION['delete']);
                }

            echo "<table>";
            $stmt = $pdo->query("select * from autos");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                echo "<tr> <td>";
                echo $row['make'];
                echo "</td> <td> ";
                echo $row['year'];
                echo "</td> <td>";
                echo $row['mileage'];
                echo "</td> <td>";
                echo '<form method = "post"> <input type = "hidden" ';
                echo 'name = "auto_id" value ="' . $row['auto_id'] . '">' . "\n" ;
                echo '<input type = "submit" value = "Del" name = "delete">';
                echo "\n</form>\n";
                echo '</td>';
                echo "</tr>\n";
            }
            
        ?>
    <form method="post">
                <span class="label">Make:</span><input type="text" name="make" value = "" size="20" > <br>
                <span class="label">Year:</span><input type="text" name="year" value = ""> <br> 
                <span class="label">Mileage:</span><input type="text" name="mileage" value = ""> <br> 
                <div class="button1"> <input type="submit" name= "add" value="Add" > 
                <input type="submit" name= "logout" value="Logout" > </div>
        </form>
    </div>   
    </body>
</html>
        




