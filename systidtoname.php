<?php

//https://esi.evetech.net/latest/universe/ids/?datasource=tranquility&language=en-us
//getId("jita");


function getId($name){

$data = $name ;

$url = "https://esi.evetech.net/v2/search/?categories=solar_system&strict=true&search=".$data;

$file = file_get_contents($url);




$array = explode(',',$file);
$size = sizeof($array);
$size-- ;
$array[0] = str_replace('[','',$array[0]);
$array[$size] = str_replace(']','', $array[$size] );
$array[$size] = str_replace('{','', $array[$size] );
$array[$size] = str_replace('}','', $array[$size] );
$array[$size] = str_replace('"solar_system":','',$array[$size]);

$returnstring = implode(",",$array);

return ($returnstring);

}
?>
