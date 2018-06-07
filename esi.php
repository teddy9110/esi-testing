

<?php




include "systidtoname.php";

$startID ="";
 $finishID = "";
 $startname ="";
 $finishname="";

$startname = $_GET["start"];
//echo $startname;
$finishname= $_GET["finish"];
//echo $finishname;

$startID = getId($startname);

$finishID = getId($finishname);

$url = "https://esi.evetech.net/latest/route/".$startID."/".$finishID."/"."?avoid=&datasource=tranquility&flag=shortest";



//Use file_get_contents to GET the URL in question.
$file = file_get_contents($url);
 $contents = str_replace('[', '', $file);

$array = explode(',',$file);
$size = sizeof($array);
$size-- ;
$array[0] = str_replace('[','',$array[0]);
$array[$size] = str_replace(']','', $array[$size] );

//var_dump($array);

foreach ($array as $data){
	 $i=0;
	$file = file_get_contents('https://esi.evetech.net/latest/universe/systems/'.$data.'/?datasource=tranquility&language=en-us');

	$contents = str_replace('"', '', $file);
    $array = explode(',',$file);


	$array[1] = str_replace('"name":','',$array[1]);
    $array[1] =str_replace('"','',$array[1]);
      $array[1] =str_replace('"','',$array[1]);
    echo ($array[1]);

		$i++;
		}



/*

$headers = array("Authorization: Bearer ".$token);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);



*/
