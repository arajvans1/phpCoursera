<html>
<head>
<title>MD5 Hash</title>
</head>
<body>
<h1>MD5 cracker</h1>
This application takes an MD5 hash of a four digit pin and check all 10,000 possible four digit PINs to determine the PIN.
<pre>
<?php
    $count = 1;$found="false";
    echo("Debug Output:\n");
    if (isset($_GET['md5hash']) ) { 
        for ($x1 = 1; $x1 <= 9; $x1++) {
            for ($x2 = 1; $x2 <= 9; $x2++) {
                for ($x3 = 1; $x3 <= 9; $x3++) {
                    for ($x4 = 1; $x4 <= 9; $x4++) {
                        $testString = $x1.$x2.$x3.$x4;
                        $generatedHash = hash('md5', $testString);
                        if ($count <= 20) {
                            echo($generatedHash . "\n");
                        }
                        $count = $count + 1;
                        if ($_GET['md5hash'] === $generatedHash) {
                            $found = "true"; 
                            break 4;

                        }
                    }
                }
            } 
          }
      }  
      
    echo("\nTotal Attemts:" . $count);

?>
</pre>
<?php
      if ($found === "false") 
        echo("PIN NOT FOUND"."<br>"."<br>");
      else 
        echo("PIN:".$testString."<br><br>");
?>

<form action="" method="get">
    <label for="start">Enter MD5 Hash: </label>
    <input type="text" name="md5hash" id="hash" required>
    <br><br>
    <div>
         <input type="submit" value="Submit" name="submit">
    </div>
</form>

</form>

</body>
</html>