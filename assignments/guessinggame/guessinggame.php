<html>
<head>
<title>Guessing Game for Charles Severance</title>
</head>
<body>
<h1>Welcome to my guessing game</h1>
<p>
<?php
  session_start();
  $guess = 0;
  if (isset($_GET['newgame'])){
      $guess = rand(1,100);
      $_SESSION['guess'] = $guess;
  } else {
    if ( ! isset($_GET['guess']) ) { 
        echo("Missing guess parameter");
      } else if ( strlen($_GET['guess']) < 1 ) {
        echo("Your guess is too short");
      } else if ( ! is_numeric($_GET['guess']) ) {
        echo("Your guess is not a number");
      } else if ( $_GET['guess'] < $_SESSION['guess'] ) {
        echo("Your guess is too low");
      } else if ( $_GET['guess'] > $_SESSION['guess'] ) {
        echo("Your guess is too high");
      } else {
        echo("Congratulations - You are right");
      }
  }
  
?>
</p>

<form action="" method="get" class="form-example">

    <label for="start">Start a new Game: </label>
     <input type="submit" value="Yes!" name="newgame">
</form>
<form action="" method="get" class="form-example">

    <label for="name">Enter your Guess: </label>
    <input type="text" name="guess" id="guess" required>
    <div style="margin-top: 2em">
        <input type="submit" value="Enter!">
    </div>
</form>

</body>
</html>