<?php
    require_once "pdo.php";
    session_start();
    if (! isset($_SESSION["autosUserID"])){
        die("Please login");
    }
    $userID = $_SESSION['autosUserID'];
    $choices = array('rock','paper','scissor');
    if (isset($_GET['play'])) {
        $humanChoice = $_GET['humanChoice'];
        $computerChoice = $choices[rand(0,2)];
        if ($humanChoice == "rock" && $computerChoice == "rock"){
            $message = "Human:" . $humanChoice . " Computer=" . $computerChoice . " Result= Tie"; 
            
        } elseif ($humanChoice == "rock" && $computerChoice == "paper") {
            $message = "You=" . $humanChoice . " Computer=" . $computerChoice . " Result= You Loose"; 
        } elseif ($humanChoice == "rock" && $computerChoice == "scissor") {
            $message = "You=" . $humanChoice . " Computer=" . $computerChoice . " Result= You Win"; 
        } elseif ($humanChoice == "paper" && $computerChoice == "rock") {
            $message = "You=" . $humanChoice . " Computer=" . $computerChoice . " Result= You Win"; 
        } elseif ($humanChoice == "paper" && $computerChoice == "paper") {
            $message = "You=" . $humanChoice . " Computer=" . $computerChoice . " Result= Tie"; 
        } elseif ($humanChoice == "paper" && $computerChoice == "scissor") {
            $message = "You=" . $humanChoice . " Computer=" . $computerChoice . " Result= You Loose"; 
        } elseif ($humanChoice == "scissor" && $computerChoice == "rock") {
            $message = "You=" . $humanChoice . " Computer=" . $computerChoice . " Result= You Loose"; 
        } elseif ($humanChoice == "scissor" && $computerChoice == "paper") {
            $message = "You=" . $humanChoice . " Computer=" . $computerChoice . " Result= You Win"; 
        } elseif ($humanChoice == "scissor" && $computerChoice == "scissor") {
            $message = "You=" . $humanChoice . " Computer=" . $computerChoice . " Result= Tie"; 
        } 


    } elseif (isset($_GET['logout'])){
        header('Location: logout.php');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Rock Paper Scissor</title>
    </head>
    <body>
        <h1>Rock Paper Scissor </h1>
        Welcome <?php echo($userID) ?>

        <form method="get">
            <select name="humanChoice" id="game">
                <option value="rock">Rock</option>
                <option value="paper">Paper</option>
                <option value="scissor">Scissor</option>
            </select>
            <input type="submit" name= "play" value="Play">
            <input type="submit" name= "logout" value="Logout">
            <section style="padding:.5em;background-color:rgb(233, 228, 223);width:25em;margin-top:1em;font-weight:bold"> 
                <?php 
                    if (! isset($message)) {
                        echo "Please select a strategy and press Play";
                    } else
                      echo($message);
                ?>
            </section>
        
        </form>
        
    </body>
</html>


