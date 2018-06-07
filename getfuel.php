<?PHP

function getfuel($response){



//print_r(array_values($response));


$key =  array_column($response, 'fuel_expires');



$size = count($key);



$i = 0;
$storesdates = implode(" ",$key);
//echo (trim($storesdates, " "));
echo  nl2br ("\n");
echo  nl2br ("\n");


//print_r($storedates);


foreach ($key as $size) {
  // code...



  $display = strtotime($key[$i]);
  //echo $display;

  $unixtime = $display;
  echo $time = date("d/m/y h:i:s A T",$unixtime);
  echo  nl2br ("\n");
  $i++;

    $timeID= array("date"=>$time);



}
return $timeID;
}
