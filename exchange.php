<?php
require "conn.php";

//setting data format to json
    class exchange{
    //fetching api data
        public function fetchdata(string $url){
            $curl_session = curl_init();
            curl_setopt($curl_session, CURLOPT_URL, $url);
            curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, true);
            $json = curl_exec($curl_session);
            curl_close($curl_session);
            return $json;
    }
    
    //decoding json to array 
        public function jsondecode(string $jsonval){
            $arr = json_decode($jsonval, true);
            return $arr;
    }
    
    //inserting the specific api values to db
    /*additional mode argument has been added to prevent program from 
    spamming data to db*/
        public function returnresult(array $arr, bool $mode, $conn){
            $msg = '';
            $list = [];
            $x = $arr[0]['rates'];
        for($i=0; $i<count($x); $i++){
            $currency = $x[$i]["currency"];
            $code = $x[$i]["code"];
            $mid = $x[$i]["mid"];
            array_push($list, [$currency, $code, $mid]);
        if($mode == true){
            $insert = "INSERT INTO kursy (currency, code, mid) values ('".$currency."', '".$code."', '".$mid."')";
            $queryres = $conn->query($insert);
            $msg = 'records has been added';
            echo $msg;
            }
        }
        return $list;    
    }
}

    //data from table A in nbp api
        $tableA = new exchange();
        $urlA = $tableA->fetchdata('http://api.nbp.pl/api/exchangerates/tables/A/');
        $jsonvalueA = $tableA->jsondecode($urlA);
    //*IMPORTANT* --> change the false value to true in order for returnresult method of the tableA object to work then press f5
    /* *************NOTE************
       --> DATA FETCHED FROM API ALREADY EXISTS IN DATABASE 
       --> THERE IS NO NEED TO CHANGE THE FALSE VALUE TO TRUE
    */
        $arrayvalueA = $tableA->returnresult($jsonvalueA, false, $conn);

    //data from table B in nbp api
        $tableB = new exchange(); 
        $urlB = $tableB->fetchdata('http://api.nbp.pl/api/exchangerates/tables/B/');
        $jsonvalueB = $tableB->jsondecode($urlB);
    //*IMPORTANT* --> change the false value to true in order for returnresult method of the tableB object to work then press f5
    /* *************NOTE**********
       --> DATA FETCHED FROM API ALREADY EXISTS IN DATABASE 
       --> THERE IS NO NEED TO CHANGE THE FALSE VALUE TO TRUE
    */
        $arrayvalueB = $tableB->returnresult($jsonvalueB, false, $conn);
?>