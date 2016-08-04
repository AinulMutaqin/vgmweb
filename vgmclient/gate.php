<?php

require_once "lib/nusoap.php";

$client = new

nusoap_client("http://10.10.31.36/opus_vgmapps/index.php"); //PROD

$error = $client->getError(); if ($error) {

echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";

return;

}

$modul="get_GateLane";

//$terminal_id="TO3";
$terminal_id="PJG";
//$terminal_id="PLG";
//$terminal_id="PNK";

$in_data="<root>
<terminal_id>$terminal_id</terminal_id>
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