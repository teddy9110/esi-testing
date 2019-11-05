<?PHP

function getprices(){
// Get cURL resource
$curl = curl_init();
// Set some options - we are passing in a useragent too here
Global $fit = "l3mpk" ; 
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'curl "https://evepraisal.com/a/"'.$fit.'".json"',
    
));
// Send the request & save response to $resp
$resp = curl_exec($curl);
// Close request to clear up some resources
curl_close($curl);

print_r($resp["totals"]); 


}


function postToDiscord($message)
{
    $data = array("content" => $message, "username" => "Webhooks");
    $curl = curl_init("https://discordapp.com/api/webhooks/YOUR-WEBHOOK-URL-HERE");
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    return curl_exec($curl);
}

?>


<html>
<body>
<table>
<?php foreach($index as $ship=>$total): ?>

         <tr>
             <td>ship</td>
             <td><?php echo $ship[$index];?></td>
         </tr>
         <tr>
             <td>Desc </td>
             <td><?php echo $name;?></td>
         </tr>
         <tr>
             <td>Price</td>
             <td><?php echo $total;?></td>
         </tr>
         
     </table>


</body>
<html>





