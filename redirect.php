<?php
    if (isset($_POST['where'])) {
        if ($_POST['where'] == '1') {
            header('Location: https://www.wa4e.com/');
        } elseif ($_POST['where'] == '2') {
            header('Location: https://www.pg4e.com/');
        } elseif ($_POST['where'] == '3'){
            header('Location: https://www.dr-chuck.com/');
        }
    }
?>



<html>
    <head>
        <title> Redirect Documentation!! </title> 
        <link type="text/css" rel="stylesheet" href="base.css">
    </head>
    <body>
        <nav>
            <ul>
                <li><a href="session01.php" class="back">&lArr; Session</a></li>
                <li><a href="postredirectget.php" class="forward"> POST/REDIRECT/GET &rArr;</a></li>
            </ul>
        </nav>
        <h1>Redirect Demo</h1>
            <form method="post"> 
                <p>Where to go? (1-3)
                <input type = "text" name = "where" length=5></p>
                <pre> 
                1. https://www.wa4e.com/ 
                2. https://www.pg4e.com/' 
                3. https://www.dr-chuck.com/ 

                <input type = "submit">
                </pre>
                


            </form>
        

        <pre class = highlite> <h3> 
           header('Location: https://www.wa4e.com/'); -- This command redirects to stated url.
           Browser will see a 302 response and a instruction from server to go to a different
           location.
           IMP: header() should be issues before any output is written


           if (isset($_POST['where']) {
                if ($_POST['where'] == '1') {
                    header('Location: https://www.wa4e.com/');
                } elseif ($_POST['where'] == '2') {
                    header('Location: https://www.pg4e.com/');
                } elseif ($_POST['where'] == '3'){
                    header('Location: https://www.dr-chuck.com/');
                }
            }
        </h3></pre>
    </body>
</html>