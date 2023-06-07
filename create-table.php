<?php
require "conn.php";
class table{
    public function generateTable($conn){
        //fetching data from mysql table 
        $select = "SELECT currency, code, mid from kursy";
        $selectres = $conn->query($select);
        //creating table to output fetched data 
            echo "<table border='1'>";
                echo "<tr>";
                    echo "<th>currency</th>";
                    echo "<th>code</th>";
                    echo "<th>mid</th>";
                echo "</tr>";
    while($row = $selectres->fetch_assoc()){  
                echo "<tr>";
                    echo "<td>".$row['currency']."</td>";
                    echo "<td>".$row['code']."</td>";
                    echo "<td>".$row['mid']."</td>";
                echo "</tr>";
        } 
        echo "</table>";
}          
}

?>