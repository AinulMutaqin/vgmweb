<?php

require_once "lib/nusoap.php";
$client = new
nusoap_client("http://10.10.31.36/opus_vgmapps/index.php"); //PROD
$error = $client->getError(); if ($error) {
echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
return;
}

$modul="send_Weight";

//$terminal_id="TO3";
$terminal_id="PJG";
//$terminal_id="PLG";
//$terminal_id="PNK";

$cont_no="KUTI0001112";
$truck_id="10015";
$weight = "20000";
$inout= 'I';
$in_data="<root>
<terminal_id>$terminal_id</terminal_id>
<no_container>$cont_no</no_container>
<truck_id>$truck_id</truck_id>
<weight>$weight</weight>
<inout>$inout</inout>
</root>";
$result = $client->call($modul, array("in_data" => "$in_data"));
if ($client->fault) { echo "<h2>Fault</h2><pre>"; print_r($result); echo "</pre>";
} else {
$error = $client->getError(); if ($error) {
echo "<h2>Error 2</h2><pre>" . $error . "</pre>";
} else {
echo $result;
} 
}
?>