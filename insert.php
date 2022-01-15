<?php
function calculateid($conn){
    $fetch_id = "SELECT id from currency order by id desc limit 1";
       $result =  $conn->query($fetch_id);
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
              return $row["id"];
            }
        }
        else{
            return 0;
        }
}
function insert($conn,$sel_Currency){
    if (!$conn->connect_error) {
        $id = calculateid($conn);
        //echo $id;
        $newid = $id +1;
        for($j = 0;$j < sizeof($sel_Currency);$j++){
            $attime = (int)$sel_Currency[$j]->at;
            $symbol = $sel_Currency[$j]->symbol;
            $quotaasset = $sel_Currency[$j]->quoteAsset;
            $baseasset = $sel_Currency[$j]->baseAsset;
            $lastprice = $sel_Currency[$j]->lastPrice;
            $ins_query = "INSERT INTO currency (id, attime,symbol,baseasset,quotaasset,lastprice) VALUES ($newid,$attime,'$symbol','$baseasset','$quotaasset',$lastprice)"  ;
            $conn->query($ins_query);

        }
       
    }

}



?>