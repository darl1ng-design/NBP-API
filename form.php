<?php
require "option-object.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
     <header>
        <nav>
            <a href="index.php">table page</a>
        </nav>
    </header>
   <form action="form-auth.php" method="post"> 
        <input type="number" name="amount" placeholder="Insert amount">
            <label for="src-crncy">Source currency</label>
                <select name="src-crncy" placeholder="source-currency">
                    <option value="" disabled selected>Select currency</option>
                        <?php
                        //creating source option tag and inserting fetched data from db into it
                            $src = new option();
                            $src_option = $src->getCurrencyInfo($conn);
                        ?>
                </select>
            <label for="trgt-crncy">Target currency</label>
                <select name="trgt-crncy" placeholder="target-currency">
                    <option value="" disabled selected>Select currency</option>
                        <?php
                        //creating target option tag and inserting fetched data from db into it
                            $trgt = new option();
                            $trgt_option = $trgt->getCurrencyInfo($conn);
                        ?>
                </select>
        <input type="submit">
   </form>
</body>
</html>
