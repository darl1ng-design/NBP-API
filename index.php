<?php
require "create-table.php";
require "exchange.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="text-align:center; display:flex; justify-content:center ;flex-direction:column">
    <header>
        <nav>
            <a href="form.php">form page</a>
        </nav>
    </header>
<?php
//generating new table containing the currency data fetched from nbp api
$table = new table();
$print = $table->generateTable($conn);
?> 
</body>
</html>
