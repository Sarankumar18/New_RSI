<?php
require 'dbconfig.php';
require 'insert.php';
require 'rsi.php';
$json = file_get_contents('https://api.wazirx.com/sapi/v1/tickers/24hr');
 $data = json_decode($json);
// $data = var_dump($obj);
 $sel_Currency = [];
  for($i = 0;$i < sizeof($data);$i++){
        if($data[$i]->quoteAsset == "inr"){
            array_push($sel_Currency,$data[$i]);
        }
  }

  //echo $sel_Currency[0]->at;
  if(sizeof($sel_Currency) > 20)
  {
    insert($conn,$sel_Currency);
    echo"Inserted";
    cal_rsi($conn,$sel_Currency);
  }
  
?>