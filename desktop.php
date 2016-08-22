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
if ($_SESSION['start'] + (2*60*60) < time()) {
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
<!--href='desktop_marathon.css'-->
<style>

#sidebar {
    background: white;
    background: #F5F5F5;
}

div {
    color: white;
}

</style>
</head>
<script src='js/updateAll.js' type='text/javascript'></script>
<body onload="updatePage(); setInterval('updatePage()',1000)">

<div id='pageWrapper'>
<div id='topBanner'>
    <div id='mainInfo'>
        <a href="profile.php">
            <div id='MarathonName'>
    
                <!-- <img src="https://upload.wikimedia.org/wikipedia/en/thumb/c/c2/Bank_of_America_Chicago_Marathon_Logo.svg/1280px-Bank_of_America_Chicago_Marathon_Logo.svg.png" height="160px"></img> -->
                <!--<img src="/randomStuff/logo.png" height="160px"></img>-->
            </div>
        </a>
        <div id='NUlogo'></div>
        <a href="http://www.mccormick.northwestern.edu/industrial/" target = "_blank" STYLE="text-decoration: none">
        </div>
        </a>
    <!--<div id='alertStatus'>
        GREEN
    </div>-->
    <!--
    <a href="http://www.weather.com/weather/map/interactive/l/Chicago+IL+USIL0225:1:US" target = "_blank">
        <div id='weather' class='weather'>
        <script src='js/weather.js' type='text/javascript'></script>
    </div>
    </a>
  -->
  
    <div id='timingDiv'>
        <div id='timeTitle'>Clock Time</div>
        <div id='timeTitle'>Race Time</div>
        <div id='clock'>&nbsp</div>
        <div id='elapsedTime'>&nbsp</div>
    </div>
</div>

<script src='js/alerts.js' type='text/javascript'></script>

<div id='alertbar'>
    <marquee><div id='alertText'>&nbsp</div></marquee>
</div>

<div id='map'>
   
</div>

<script src='js/generateMaps.js' type='text/javascript'></script>
<script src='js/GeneralInfo.js' type='text/javascript'></script>

<div id='InfoBox'>
        <div id='RunnersOnCourse' class='infoTxt'>&nbsp</div>
        <div id='RunnersFinished' class='infoTxt'>&nbsp</div>
        <div id='HospitalTransports' class='infoTxt'>&nbsp</div>
        <div id='PatientsSeen' class='infoTxt'>&nbsp</div>
</div>

<div id='Compass'>
    
</div>

   
<div id='sidebar' class='sidebar'>
    <div id='medical' class='medical'>
        <script src='js/medicalTents_desktop.js' type='text/javascript'></script>
        <!--<script src='js/graphAidStations_desktop.js' type='text/javascript'></script>-->
    </div>
    <div class='SideBarSpace'>
        <!-- nothing goes here, just space that goes between each of the graphs -->
    </div>
    
    <div class = 'all-legend'>
    
    <div class='legend-tracking'>
    <div class='legend' style='left:0%; top:0%'>
    <div class='legend-scale'>
    <div class='legend-title'>Runner Tracking</div>
    <ul class='legend-labels'>
        <li><span style='background:#3A99DE; border-radius:30px; width:35px; height:20px; text-align:center'>LWM</span>Lead Wheelchair Male</li>
        <li><span style='background:#3A99DE; border-radius:30px; width:35px; height:20px; text-align:center'>LWF</span>Lead Wheelchair Female</li>
        <li><span style='background:#3A99DE; border-radius:30px; width:35px; height:20px; text-align:center'>FW</span>Final Wheelchair</li>
        <li><span style='background:#3A99DE; border-radius:30px; width:35px; height:20px; text-align:center'>LM</span>Lead Male</li>
        <li><span style='background:#3A99DE; border-radius:30px; width:35px; height:20px; text-align:center'>LF</span>Lead Female</li>
        <li><span style='background:#3A99DE; border-radius:30px; width:35px; height:20px; text-align:center'>T</span>Last Runner</li>
        
    </ul>
    </div>
    </div>
    </div>
    <div class='legend-tracking'>
    <div class='legend' style='left: 55%; top: 0%'>
    <div class='legend-scale'>
    <div class='legend-title'>Density Graph</div>
        <ul class='legend-labels'>
        <li><span style='background:#008CFF; border-radius:30px; width:35px; height:20px; text-align: center;'></span>Now</li>
        <li><span style='background:#F01616; border-radius:30px; width:35px; height:20px; text-align: center;'></span>In 30 minutes</li>
        </ul>
    </div>
    </div>
    </div>
    
    
    <div class='legend'>
    <div class='legend-scale'>
    <div class='density-wrapper'>
    <div class='legend-title'>Runner Density</div>
    <ul class='legend-labels'>
        <li><span style='background:#0BB50B;'></span>0 - 2000</li>
        <li><span style='background:#FFDC00;'></span>2000 - 4000</li>
        <li><span style='background:#FFA500;'></span>4000 - 6000</li>
        <li><span style='background:#FF0000;'></span>6000+</li>
    <!-- <li><span style='background:#00E5FF;'></span>Medical Tent capacity</li> -->
    </ul>
    </div>
    <div class='aid-wrapper'>
    <div class='legend-title'>Bed Occupancy</div>
    <ul class='aid-legend'>
        <li><span style='background:#0BB50B;'></span>&lt;50% full</li>
        <li><span style='background:#FFDC00;'></span>50% - 90%</li>
        <li><span style='background:#FF0000;'></span>>90%</li>
        <li><span style='background:#878787;'></span>Closed</li>
    </ul>
    </div>
    </div>
    </div>
    
    
    </div>
    
    <div id = "densityplotWrap" >
        <script src='js/densityLine.js' type='text/javascript'></script>
    </div>


</div> <!--ends sidebar-->



<!-- here is the tooltip that goes on the info bars -->
<div id="tooltip" class="hidden">
    <p><span id="tooltipHeader">Aid Station</span></p>
    <p><span id="value">100</span></p>
</div>

</div>
</body>
</html>