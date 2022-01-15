<?php
$newid;
 function cal_rsi($conn,$sel_Currency){
    //sleep(2);
    $fetch_id = "SELECT id from currency order by id desc limit 1";
    $result =  $conn->query($fetch_id);
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
              $newid =  $row["id"];
            }
        }
        else{
            return 0;
        }
        $pricelist = [];

    for($i = 0; $i < sizeof($sel_Currency);$i++){
        $j = $newid -9;
        $avg_gain = 0;
        $avg_loss = 0;
        $gain = 0;
        $loss = 0;
        $gain_count;
        $loss_count;
        $RS;
        $current_cur = $sel_Currency[$i]->symbol;
        for($j ; $j <= $newid; $j++){
            $select_cur = "SELECT lastprice from currency where id = $j and symbol = '$current_cur'";
            $res_cur = $conn->query($select_cur);
            if (mysqli_num_rows($res_cur) > 0) {
                // output data of each row
                while($row = mysqli_fetch_assoc($res_cur)) {
                  array_push($pricelist,$row['lastprice']); 
                }
            }

        }

        for($k = 0;$k < (sizeof($pricelist) -1);$k++){
            if($pricelist[$k] < $pricelist[$k+1]){
                $gain = $gain + ($pricelist[$k+1] - $pricelist[$k]);
                $gain_count = $gain_count +1;
            }
            elseif($pricelist[$k] > $pricelist[$k+1]){
                $loss = $loss + ($pricelist[$k] - $pricelist[$k+1]);
                $loss_count = $loss_count +1;
            }
            // elseif($pricelist[$k] == $pricelist[$k+1]){

            // }
        }
        $avg_gain = $gain / $gain_count;
        $avg_loss = $loss / $loss_count;
        
        $RS = $avg_gain / $avg_loss;
        $RSI = 100 - (100 / (1 + $RS));
        // echo "gain:" . $avg_gain;
        // echo "\nloss:" . $avg_loss;
        // echo "\nRS:" . $RSI;

    }
    
 }





?>
