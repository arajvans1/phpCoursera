<?php
    require_once "pdo.php";
    session_start();
    if (! isset($_SESSION["autosUserId"])){
        die("Please login");
    }

    if (isset($_POST['delete'])) {
        $sql = "Delete from autos where auto_id = :auto_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(':auto_id' => htmlentities($_POST['auto_id'])));
        header('Location:autos.php');
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
        <h4>Please confirm deletion of <?php echo(htmlentities($_GET['auto_id'])) ?> </h4>
        <form method="post" style="display:inline-block">
                <input type="hidden" name="auto_id" value = "<?php echo($_GET['auto_id']) ?>" size="20" >
                <input type="submit" name= "delete" value="Delete"> 
        </form>
        <a href=autos.php>Cancel</a> 
    </div>
    </body>
</html>
        




