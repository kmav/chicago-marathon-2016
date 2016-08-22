<?php 
session_start(); // Starting Session
if(!isset($_SESSION['login_user'])){
    header("location: index.php");
}
?>
<!DOCTYPE html>
<html>
<meta charset="utf-8"/>
<head>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <title>Input General Info </title>
    <style>
        .inputBox {
            text-align: center;
            width: 100%;
            height: 30px;
            margin: auto;
            border-radius: 10px;
            background: linear-gradient(rgb(135,206,235),rgb(173,216,230), white);
            
        }
        .wrapper {
            position: relative;
            width: 100%;
            height: 100%;
            margin: auto;
            float: left;
        }
        
        .genInfoBox {
            border: 2px; 
            text-align: center;
            width: 200px;
            height: 50px;
            padding: 10px;
            background: linear-gradient(rgb(135,206,235),rgb(173,216,230), white);
            border-radius: 10px;
            float: left;
            margin: 10px;
        }
        
        .trackingBox {
            border: 2px ;
            text-align: center;
            width: 200px;
            height: 130px;
            padding: 10px;
            background: linear-gradient(rgb(135,206,235),rgb(173,216,230), white);
            border-radius: 10px;
            float: left;
            margin: 10px;
        }
        
        .AlertBox {
            border: 2px;
            text-align: center;
            width: 600px;
            height: 50px;
            padding: 10px;
            background: linear-gradient(rgb(135,206,235),rgb(173,216,230), white);
            border-radius: 10px;
            float: left;
            margin: 10px;
        }
        
        .emergBox {
            border: 2px;
            text-align: center;
            width: 200px;
            height: 150px;
            padding: 10px;
            background: linear-gradient(rgb(249,100,100),rgb(249,100,100), white);
            border-radius: 10px;
            float: left;
            margin: 10px;
        }
        
        .Titles {
            font-size: 120%;
  	        font-family: "Helvetica Neue", Geneva, sans-serif;
        }
        
        .Labels {
            font-size: 100%;
  	        font-family: "Helvetica Neue", Geneva, sans-serif;
        }
        
        div{
            text-align: center;
            word-wrap: normal;
        }
        .inbox{
            margin: 6px;
            margin-bottom: 4px;
            margin-top: 4px;
            padding: 4px;
            padding-left: 6px;
            padding-right: 6px;
            border: 1px solid black;
            border-radius: 4px;
            background: #132FAD;
            color: white;
            font-size: 1.5em;
        }
        .blue{
            background: #132FAD;
            color: white;
            font-size: 1.5em;
        }
        .orange{
            
        }
        .inrow{
            height: 120px;
        }
        .inTxt{
            width:50%;
            margin-bottom: 8px;
            margin-top: 8px;
            color: black;
            text-align: center;
        }
        .alertbar{
            height: 120px;
        }
    </style>
    <script src="js/googleAnalytics.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.6/d3.min.js" charset="utf-8"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>

<body>
    
    <form action="updateGenInfo.php" method="POST" id='inputForm'>
        
        <div class='container'>
            <div class="row inrow">
                <div class='col-sm-10 inbox alertbar'>
                    <div class='inputbox'>
                        <div class='row' id='AlertText'>Alert Status</div>
                        <div class='row' id='AlertInput'>
                            <select id="AlertStatus1" name="AlertStatus" form='inputForm'>
                                <option name='AlertStatus' value='55'>No Change</option>
                                <option name='AlertStatus' value=1>Yellow
                                <option name='AlertStatus' value=2>Red
                                <option name='AlertStatus' value=3>BLACK (be careful)
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row inrow">
                <div class="col-sm-2 inbox">
                    <div class='row'>Temperature</div>
                    <div class='row'>
                        <input class='inTxt' type='number' name='temperature' value=0> &deg F
                    </div>
                </div>
                <div class="col-sm-2 inbox">
                    <div class='row'>Wind Speed</div>
                    <div class='row'>
                        <input class='inTxt' type='number' name='windSpeed' value=0> mph
                    </div>
                </div>
                <div class="col-sm-2 inbox">
                    <div class='row'>Wind Direction</div>
                    <div class='row'>
                        <select name="windDirection">
                            <option value="0">0</option>
                            <option value="N">N</option>
                            <option value="E">E</option>
                            <option value="S">S</option>
                            <option value="W">W</option>
                            <option value="SW">SW</option>
                            <option value="SE">SE</option>
                            <option value="NW">NW</option>
                            <option value="NE">NE</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-2 inbox">
                    <div class='row'>Humidity</div>
                    <div class='row'>
                        <input class='inTxt' type='number' name='temperature' value=0> %
                    </div>
                </div>
            </div>
            <div class='row inrow'>
                <div class='col-sm-2 inbox'>
                    <div class='row'>Runners On Course</div>
                    <div class='row'>
                        <input class='inTxt' type='number' name='temperature' value=0> 
                    </div>
                </div>
                <div class='col-sm-2 inbox'>
                    <div class='row'>Runners Finished</div>
                    <div class='row'>
                        <input class='inTxt' type='number' name='temperature' value=0> 
                    </div>
                </div>
                <div class='col-sm-2 inbox'>
                    <div class='row'>Hospital Transports</div>
                    <div class='row'>
                        <input class='inTxt' type='number' name='temperature' value=0> 
                    </div>
                </div>
                <div class='col-sm-2 inbox'>
                    <div class='row'>Patients Seen</div>
                    <div class='row'>
                        <input class='inTxt' type='number' name='temperature' value=0> 
                    </div>
                </div>
            </div>
            
            <div class='row inrow'>
                <div class='col-sm-3 inbox'>
                    <div class='row'>Lead Male</div>
                    <div class='row'>
                        <input class='inTxt' type='number' name='temperature' value=0> 
                        <input class='inTxt' type='number' name='temperature' value=0> 
                    </div>
                </div>
                <div class='col-sm-3 inbox'>
                    <div class='row'>Lead Female</div>
                    <div class='row'>
                        <input class='inTxt' type='number' name='temperature' value=0> 
                        <input class='inTxt' type='number' name='temperature' value=0> 
                    </div>
                </div>
                <div class='col-sm-3 inbox'>
                    <div class='row'>Lead Male Wheelchair</div>
                    <div class='row'>
                        <input class='inTxt' type='number' name='temperature' value=0> 
                        <input class='inTxt' type='number' name='temperature' value=0> 
                    </div>
                </div>
                <div class='col-sm-3 inbox'>
                    <div class='row'>Lead Female Wheelchair</div>
                    <div class='row'>
                        <input class='inTxt' type='number' name='temperature' value=0> 
                        <input class='inTxt' type='number' name='temperature' value=0> 
                    </div>
                </div>
                <div class='col-sm-3 inbox'>
                    <div class='row'>Final Wheelchair</div>
                    <div class='row'>
                        <input class='inTxt' type='number' name='temperature' value=0> 
                        <input class='inTxt' type='number' name='temperature' value=0> 
                    </div>
                </div>
                <div class='col-sm-3 inbox'>
                    <div class='row'>Turtle</div>
                    <div class='row'>
                        <input class='inTxt' type='number' name='temperature' value=0> 
                        <input class='inTxt' type='number' name='temperature' value=0> 
                    </div>
                </div>
                
            </div>
            <div class='row inrow'>
                <div class='col-sm-6 inbox orange'>
                    <div class='row'>Emergency Alerts</div>
                    <div class="row">
                        <input type="checkbox" id="emerg" name="emergencyCheck">Check if an emergency.
                    </div>
                    <div class='row'>
                        Lat: <input class='inTxt' type="number" name="latAl" id="latAl" value=0> 
                    </div>
                    <div class='row'>
                        Long: <input class='inTxt' type="number" name="lonAL" id="lonAL" value=0>
                    </div>
                </div>
            </div>
            
            
        </div>
        
<!--
        <div class="wrapper">
            
            
        <div class='genInfoBox' id='AlertBox'>
            <div class="Titles" >Alert Status</div>
            <select id="AlertStatus" name='AlertStatus' onchange="myFunction()" form='inputForm'>
              <option name='AlertStatus' value=55>No Change
              <option name='AlertStatus' value=0>Green
              <option name='AlertStatus' value=1>Yellow
              <option name='AlertStatus' value=2>Red
              <option name='AlertStatus' value=3>BLACK (be careful)
            </select>
        </div>    
    
        <script type='text/javascript'>
            
            function myFunction(){
                alert("Are you sure?");
            }
            
            
        </script>
        
        <div class="genInfoBox">
        <div class="Titles">Temperature</div>
        <input type="number" name="temperature" value=0> &deg F
        </div>
        
        <div class="genInfoBox">
        <div class="Titles">Wind Speed</div>
        <input type="number" name="windSpeed" value=0> mph
        </div>
        
        <div class="genInfoBox">
        <div class="Titles">Wind Direction</div>
        <select name="windDirection">
        <option value="0">0</option>
        <option value="N">N</option>
        <option value="E">E</option>
        <option value="S">S</option>
        <option value="W">W</option>
        <option value="SW">SW</option>
        <option value="SE">SE</option>
        <option value="NW">NW</option>
        <option value="NE">NE</option>
        </select>
       
        </div>
        
        <div class="genInfoBox">
        <div class="Titles">Humidity</div>
        <input type="number" name="humidity" value=0>
        </div>
        
        </div>
        
        <div class="wrapper">
            
        <div class="genInfoBox">
        <div class="Titles"># Runners On Course</div>
        <input type="number" name="runnersOC" value=0>
        </div>
        

        
        <div class="genInfoBox">
        <div class="Titles"># Finished Runners</div>
        <input type="number" name="finished" value=0>
        </div>
        

        
        <div class="genInfoBox">
        <div class="Titles"># Hospital Transports</div>
        <input type="number" name="transports" value=0>
        </div>
        

        
        <div class="genInfoBox">
        <div class="Titles"># Patients Seen</div>
        <input type="number" name="pSeen" value=0>
        </div>
        
    
        
        </div>
        
        <div class="wrapper">
            
        <div class="trackingBox">
        <div class="Titles">Lead Male</div>
        <div class="Labels">Lat:</div>
        <input type="text" name="latLM" value=0>
        <div class="Labels">Long:</div>
        <input type="text" name="longLM" value=0>
        </div>
        
 
        
        <div class="trackingBox">
        <div class="Titles">Lead Female</div>
        <div class="Labels">Lat:</div>
        <input type="text" name="latLF" value=0>
        <div class="Labels">Long:</div>
        <input type="text" name="longLF" value=0>
        </div>
        
        
        <div class="trackingBox">
        <div class="Titles">Lead Male Wheelchair</div>
        <div class="Labels">Lat:</div>
        <input type="text" name="latLMW" value=0>
        <div class="Labels">Long:</div>
        <input type="text" name="longLMW" value=0>
        </div>
        

        
        <div class="trackingBox">
        <div class="Titles">Lead Female Wheelchair</div>
        <div class="Labels">Lat:</div>
        <input type="text" name="latLFW" value=0>
        <div class="Labels">Long:</div>
        <input type="text" name="longLFW" value=0>
        </div>
        
        
        
        <div class="trackingBox">
        <div class="Titles">Final Wheelchair</div>
        <div class="Labels">Lat:</div>
        <input type="text" name="latFW" value=0>
        <div class="Labels">Long:</div>
        <input type="text" name="longFW" value=0>
        </div>
        
        
        
        <div class="trackingBox">
        <div class="Titles">Turtle</div>
        <div class="Labels">Lat:</div>
        <input type="text" name="latT" value=0>
        <div class="Labels">Long:</div>
        <input type="text" name="longT" value=0>
        </div>
        
        </div>
        
        
        <div class="wrapper">
            
        <div class="AlertBox">
        <div class="Titles">Alerts</div>
        <input id='alert_saved' type="text" name="alert" size=70 value=0>
        </div>
        
        <div class="emergBox">
        <div class="Titles"> Emergency Alerts</div>
        <input type="checkbox" id="emerg" name="emergencyCheck">Check if an emergency.
        <div class="Labels">Lat:</div>
        <input type="text" name="latAl" id="latAl" value=0>
        <div class="Labels">Long:</div>
        <input type="text" name="longAl" id="lonAl" value=0>
        </div>
        </div>
   
        <input type="submit" value="Submit Data">
-->
    </form>
    
    <script type="text/javascript">//getting default alert values
    function getAlerts(data)
    {
         var check = +data[0].emergencyCheck; 
         var AlertLat = data[0].AlertLat; 
         var AlertLong = data[0].AlertLong;
        var message=data[0].Alert;
         (message+"alert");
        document.getElementById('alert_saved').value=message;
        //get the true/false of the check for the emergency
        if (check==1){
            $("#emerg").prop('checked',true);
        }
        else{
            //set checked=false
            $("#emerg").prop('checked',false); 
        }
        
        //now put lat/long values in the fields
        document.getElementById("latAl").value = AlertLat;
        document.getElementById("lonAl").value = AlertLong;
        

        
    }
    d3.csv('data/gen_info.csv',getAlerts);    
    </script>
    
</body>

</html>