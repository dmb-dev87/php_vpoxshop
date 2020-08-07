<?php
$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
$txt = json_encode($_POST);
fwrite($myfile, $txt);
fclose($myfile);
?>