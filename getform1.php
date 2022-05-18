<html>
<head>
<title> get Form demo!! </title> 
<link type="text/css" rel="stylesheet" href="base.css">
</head>
<body>
        <nav>
            <ul>
                <li><a href="get-01.php" class="back">&lArr; get-01.php</a></li>
                <li><a href="postform1.php" class="forward">Post Form &rArr;</a></li>
            </ul>
        </nav>
<p>Guessing game...</p>
<form method="get">
   <p><label>Input Guess</label>
   <input type="text" name="guess" size="20" id="guess" /></p>
   <input type="submit"/>
</form>

<pre>
<?php 
  print_r($_GET);
  ?> 
</pre>
</body>
</html>