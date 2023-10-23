<?php

$error = $_SESSION['error'];
$_SESSION['error'] = "";

// $error .=  "test_id: ".$_SESSION['test_id']."<br>";

// $error .=  "npregunta: ".$_SESSION['npregunta']."<br>";

// $error .=  "test: <PRE>".print_r(unserialize($_SESSION['test']), true)."</PRE>";

echo $error;
?>
