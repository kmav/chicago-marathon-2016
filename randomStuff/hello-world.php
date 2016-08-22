<?php
// A simple web site in Cloud9 that runs through Apache
// Press the 'Run' button on the top to start the web server,
// then click the URL that is emitted to the Output tab of the console

echo 'Hello world from Cloud9!';

$myfile = fopen('someFile.txt','w');

$txt = "this is 5 text that will be written to the file";

fwrite($myfile,$txt);

fclose($myfile);
?>
