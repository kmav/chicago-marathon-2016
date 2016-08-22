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
<!--href='desktop_marathon.css'-->
<style>


</style>
</head>
<body>

<h1> Medical Check In </h1>


</body>
</html>