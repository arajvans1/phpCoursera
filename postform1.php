<html>
    <head>
        <title> get Form demo!! </title> 
        <link type="text/css" rel="stylesheet" href="base.css">
    </head>
    <body>
        <nav>
            <ul>
                <li><a href="getform1.php" class="back">&lArr; Get Form</a></li>
                <li><a href="database.php" class="forward">DB Documentation &rArr;</a></li>
            </ul>
        </nav>
        <h1>Demo Form Post Method</h1>
        <form method = "post" action="postform1.php">
            <p><label>Input Guess</label>
            <?php $oldValue = isset($_POST["guess"]) ? $_POST['guess'] : '' ; ?>
            <input type="text" name="guess" size="20" id="guess" value = "<?php echo $oldValue ?>"/></p>
            <p>Classes taken:<br/>
                <input type="checkbox" name="class1" value="si502" checked>
                    SI502 - Networked Tech<br>
                <input type="checkbox" name="class2" value="si539">
                    SI539 - App Engine<br>
                <input type="checkbox" name="class3" >
                    SI543 - Java<br>
            </p>
            <p><label for="inp06">Which soda:
                <select name="soda" id="inp06">
                    <option value="0">-- Please Select --</option>
                    <option value="1">Coke</option>
                    <option value="2">Pepsi</option>
                    <option value="3">Mountain Dew</option>
                    <option value="4">Orange Juice</option>
                    <option value="5">Lemonade</option>
                </select>
   </p>
            <input type="submit"/>
        </form>
        <pre>
            <?php 
                print_r($_POST);
                function calCost($item){
                    if ($item == 0) 
                        echo "Pay Nothing";
                    elseif ($item == 1)
                        echo '<h2> Pay 1$ </h2>';
                    else
                        echo "<h2> Pay 2$ </h2>";
                }

                echo calCost($_POST["soda"]);

            ?> 
        </pre>
    </body>
</html>