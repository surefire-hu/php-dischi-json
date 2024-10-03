<?php
header('Content-Type: application/json');

$jsonFile = 'dischiServer.json';
$jsonData = file_get_contents($jsonFile);
echo $jsonData;
?>
