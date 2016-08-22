<html> 
<head> 
<script src="https://d3js.org/d3.v2.js"></script> 
</head> 
<body> 
<?php

include 'php/extractJson.php';

print XmlToJson::Parse("https://gateway.landairsea.com/tmmgw/tmmgw.asmx/Poll?cmd={%22usr%22:%22cemevent%22,%22pwd%22:%22raceday%22,%22posidx%22:%22[MaxPosIdx]%22}");

?>
</body> 
</html> 
