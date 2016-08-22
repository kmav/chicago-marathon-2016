<?php 
session_start(); // Starting Session
include('session.php');
if ($mobile==true)
{
    //header("location: getMobile.php");
}
if ($level_session>1){
    header("location: index.php");
}
if(!isset($_SESSION['login_user'])){
    header("location: index.php");
}
//check if it's been active for 1 hour, otherwise close it
if ($_SESSION['start'] + (7*60*60) < time()) {
     header("location: php/logout.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset=utf-8 />
<title>Bank of America Chicago Marathon</title>
<?php include('php/getTreatments.php'); ?>

<meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.6/d3.min.js" charset="utf-8"></script>
    <script src="js/dimple.js"></script>
    
<script src='https://api.tiles.mapbox.com/mapbox.js/v2.2.1/mapbox.js'></script>
<link href='https://api.tiles.mapbox.com/mapbox.js/v2.2.1/mapbox.css' rel='stylesheet' />
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<link rel="stylesheet" href="css/leaflet.awesome-markers.css">

<script src="js/leaflet.awesome-markers.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.simpleWeather/3.0.2/jquery.simpleWeather.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<script src="js/googleAnalytics.js"></script>


<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Lato">

<link rel='stylesheet' href='css/desktop_marathon.css'>


<script src='js/updateAll.js' type='text/javascript'></script>

<!--href='desktop_marathon.css'-->
<style>


</style>
</head>
<body>

<h1> Admin Dashboard </h1>


    <div id = "densityplotWrap" >
    </div>
    
    
</body>


<!DOCTYPE html>
<meta charset="utf-8">
<style>

.ticks {
  font: 10px sans-serif;
}

.track,
.track-inset,
.track-overlay {
  stroke-linecap: round;
}

.track {
  stroke: #000;
  stroke-opacity: 0.3;
  stroke-width: 10px;
}

.track-inset {
  stroke: #ddd;
  stroke-width: 8px;
}

.track-overlay {
  pointer-events: stroke;
  stroke-width: 50px;
  cursor: crosshair;
}

.handle {
  fill: #fff;
  stroke: #000;
  stroke-opacity: 0.5;
  stroke-width: 1.25px;
}

#densityplotWrap {
    top: 20%;
    left: 5%;
    bottom: 0%;
}

</style>

<div id="slider">
</div>

<p>
  <label for="nHeight" 
         style="display: inline-block; width: 240px; text-align: right">
         time = <span id="nHeight-value"></span> minutes
  </label>
  <input type="range" min="0" max="500" id="nHeight">
</p>


<script>

var width = 600;
var height = 300;
 
var holder = d3.select("body")
      .append("svg")
      .attr("width", width)    
      .attr("height", height); 


// read a change in the height input
d3.select("#nHeight").on("input", function() {
    d3.selectAll("svg").remove();
  make(+this.value);
});


// update the values
make(getMinute());

// Update the height attributes
function updateHeight(nHeight) {

  // adjust the text on the range slider
  d3.select("#nHeight-value").text(nHeight);
  d3.select("#nHeight").property("value", nHeight);

  // update the rectangle height
  holder.selectAll("rect") 
    .attr("y", 150-(nHeight/2)) 
    .attr("height", nHeight); 
}

  
 function make(time){
     
 d3.select("#nHeight-value").text(time);
  d3.select("#nHeight").property("value", time);
  
  
function draw(data){
  
  "use strict";
  
  var minute = time;
  
  minute = minute - minute%minuteInterval;
   (minute);
  
  var margin = 15;
  var width = $("#densityplotWrap").width()-margin;
  var height= $("#densityplotWrap").height()-margin;

  var svg = d3.select("#densityplotWrap")
    .append("svg")
      .attr("width",width+margin)
      .attr("height",height+1*margin)
    .append("g")
      .attr("class","densityChart");
      
    // dimple.js chart code
    
    
    var now = String(minute);
    var later = String(minute+30);
    var datum = dimple.filterData(data,"Minute",[now,later])
    var myChart = new dimple.chart(svg,datum);
    var x = myChart.addCategoryAxis("x","Mile");
    x.addOrderRule("Mile");
    var y = myChart.addMeasureAxis("y","Runners");
    var line = myChart.addSeries("Minute",dimple.plot.line);
        myChart.draw();
        
    svg.append("text")
      .attr("x",(width/2)+margin)
      .attr("y",margin)
      .attr("text-anchor","middle")
      .text("Runners per mile");
    
};

var minuteInterval = 2;
d3.csv("data/RunnerData.csv",draw);
    
    
 }
</script>
</html>