<?php
$token = "tp_".md5(uniqid("tp_")).uniqid(); 
echo $token;
echo "<br>";
echo strlen($token);