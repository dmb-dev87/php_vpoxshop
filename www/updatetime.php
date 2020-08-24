<?php 
date_default_timezone_set('UTC');
$date = date('d/m/Y h:i:s a');
print_r(json_encode($date)); 
?>