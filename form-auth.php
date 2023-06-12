<?php
require "conn.php";
    class currencyConvert{
        public function convert($amount, $source_code, $target_code, $conn, bool $mode){
         $message = '';

        //checking for empty form values; 
        if(empty($amount) || empty($source_code) || empty($target_code)){
            $message = 'cant insert empty values';
            echo $message;
            exit;
        }
        //fetching mid column data from db with code column values selected in form 
            $select = "SELECT mid from kursy where code LIKE '".$source_code."' || code LIKE '".$target_code."';";
            $select_res = $conn->query($select);
        //pushing the query results into an array
            $list = [];
        while($row = $select_res->fetch_assoc()){
            array_push($list, $row['mid']);
        }
        //$src_val is initial value to convert
        $src_val = ($amount*$list[0]);
        //$trgt_val is converted value
        $trgt_val = ($src_val*$list[1]); 
            
        //checking for the same currency value
        if($source_code == $target_code){
            $message = 'cant convert the same currency';
            echo $message;
            exit; 
        }
        //inserted amount values cannot be less or equal to zero
        elseif($amount <= 0){
            $message = 'amount cannot be smaller than 0';
            echo $message; 
            exit;
        }
        //inserting the source, target currencies, initial value to convert and the converted value info to database
        elseif($mode == true){
            $insert = "INSERT INTO przewalutowania (source_val, target_val, value_to_convert, converted_value) values ('".$source_code."', '".$target_code."', '".$src_val."', '".$trgt_val."');";
            $insert_result = $conn->query($insert);
        }    
    }

    //function to output the latest records containing previously inserted data to przewalutowania table
    public function output($conn){
        $select = "SELECT * from przewalutowania ORDER BY id DESC";
        $select_rslt = $conn->query($select);
    while($row = $select_rslt->fetch_assoc()){
            print_r($row); echo $row['source_val'] . ' ' .  $row['target_val'] . ' ' . $row['value_to_convert'] . ' ' . $row['converted_value'] . "</br>";         
        }   
    }
}
    //form data
    $amount = $_POST['amount'];
    $source = $_POST['src-crncy'];
    $target =  $_POST['trgt-crncy'];
    $abc = new currencyConvert();
        //converting values
        // *IMPORTANT* --> change the false value to true in order for method to work then press f5
    $do = $abc->convert($amount, $source, $target, $conn, true);
        //outputing the latest records containing previously inserted data to przewalutowania table
    $abc->output($conn);

?>
