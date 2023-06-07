<?php
require "conn.php";
class option{
     //fetching data from database and outputing it as option values in the form
    public function getCurrencyInfo($conn){
        $query = "SELECT code, mid from kursy";
        $query_result = $conn->query($query);
    while($row = $query_result->fetch_assoc()){
        echo "<option value = ".$row['code']."> ".$row['code']. "</option>";
    }
}
}
?>