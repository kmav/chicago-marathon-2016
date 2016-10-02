<!DOCTYPE html>
<html>
    <head>
        <title>General Info </title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.6/d3.min.js" charset="utf-8"></script>
        <link rel='stylesheet' type='text/css' href='css/styling.css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel='stylesheet' type='text/css' href='css/menu.css'>
        <script src="js/googleAnalytics.js"></script>

    </head>
    <body>
        <?php include('php/header.php'); ?>
        <?php include 'db/connect.php'; ?>
        
        <?php
        $AidStations = array();
        
        
        foreach($_POST as $var){
            echo $var;
            echo "\n - ";
        }
        
        //get previous data to see if we should put it
        $sql = "SELECT *
                    FROM GeneralInformation
                    WHERE GeneralInformation.id = (
                    SELECT MAX( id )
                    FROM GeneralInformation ) ;";
        $result = $db->query($sql);
        
        if ($result->num_rows>0){
            //output data of each row as a variable in php
            while ($row = $result -> fetch_assoc()){
                
                if (((int)$_POST['AlertStatus'])==55){
                    $alertStatus=$row['AlertStatus'];
                }
                else{
                    $alertStatus = (int)$_POST['AlertStatus']; 
                }
                
                if (((int)$_POST['runnersOC'])==$row['RunnersOnCourse']){
                        $runnersOc = $row['RunnersOnCourse'];
                    }
                    else{
                        $runnersOc = (int)$_POST['runnersOC']; 
                }
                
                
                if (((int)$_POST['finished'])==$row['FinishedRunners']){
                        $finished = $row['FinishedRunners'];
                    }
                    else{
                        $finished = (int)$_POST['finished']; 
                }
                
                 if (((int)$_POST['transports'])==$row['HospitalTransports'])
                 {
                        $transports = $row['HospitalTransports'];
                    }
                    else{
                        $transports= (int)$_POST['transports']; 
                }
                
                
                if (((int)$_POST['pSeen'])==$row['PatientsSeen']){
                        $pSeen = $row['PatientsSeen'];
                    }
                    else{
                        $pSeen = (int)$_POST['pSeen']; 
                }
                
                
                if ((floatval($_POST['latLM'])==0)){
                        $latLM = $row['LeadMaleLat'];
                    }
                    else{
                        $latLM = floatval($_POST['latLM']); 
                }
                
                
                if ((floatval($_POST['longLM'])==0)){
                        $longLM = $row['LeadMaleLong'];
                    }
                    else{
                        $longLM = floatval($_POST['longLM']); 
                }
                
                
                if ((floatval($_POST['latLF'])==0)){
                        $latLF = $row['LeadFemaleLat'];
                    }
                    else{
                        $latLF = floatval($_POST['latLF']); 
                }
                
                if ((floatval($_POST['longLF'])==0)){
                        $longLF = $row['LeadFemaleLong'];
                    }
                    else{
                        $longLF = floatval($_POST['longLF']); 
                }

                if ((floatval($_POST['latLMW'])==0)){
                        $latLMW = $row['LeadWheelchairMaleLat'];
                    }
                    else{
                        $latLMW = floatval($_POST['latLMW']); 
                }
                
                
                if ((floatval($_POST['longLMW'])==0)){
                        $longLMW = $row['LeadWheelchairMaleLong'];
                    }
                    else{
                        $longLMW = floatval($_POST['longLMW']); 
                }
                
                if ((floatval($_POST['latLFW'])==0)){
                        $latLFW = $row['LeadWheelchairFemaleLat'];
                    }
                    else{
                        $latLFW = floatval($_POST['latLFW']); 
                }
                
                
                if ((floatval($_POST['longLFW'])==0)){
                        $longLFW = $row['LeadWheelchairFemaleLong'];
                    }
                    else{
                        $longLFW = floatval($_POST['longLFW']); 
                }

                if ((floatval($_POST['latFW'])==0)){
                        $latFW = $row['FinalWheelchairLat'];
                    }
                    else{
                        $latFW = floatval($_POST['latFW']); 
                }
                
                
                if (floatval($_POST['longFW'])==0){
                        $longFW = $row['FinalWheelchairLong'];
                    }
                    else{
                        $longFW = floatval($_POST['longFW']); 
                }
                
                if (floatval($_POST['latT'])==0){
                    $latT = $row['TurtleLat'];
                }
                else{
                    $latT = floatval($_POST['latT']); 
                }
                
                
                if (floatval($_POST['longT'])==0){
                    $longT = $row['TurtleLong'];
                }
                else{
                    $longT = floatval($_POST['longT']); 
                }
                
                //echo $_POST['alert'];
                 if (($_POST['alert'])=="0"){
                    $alert = $row['Alert'];
                }
                else{
                    $alert = $_POST['alert']; 
                }

               // weather
               echo "<br>";
                echo $_POST['temperature'];
                echo "<br>";
                 if (($_POST['temperature'])==$row['temperature']){
                    $temperature = $row['temperature'];
                }
                else{
                    $temperature = $_POST['temperature']; 
                }
                
                
                //echo $_POST['alert'];
                 if (($_POST['windSpeed'])==$row['windSpeed']){
                    $windSpeed = $row['windSpeed'];
                }
                else{
                    $windSpeed = $_POST['windSpeed']; 
                }
                
                
                //echo $_POST['alert'];
                 if (($_POST['windDirection'])==$row['windDirection']){
                    $windDirection = $row['windDirection'];
                }
                else{
                    $windDirection = $_POST['windDirection']; 
                }
                
                
                //echo $_POST['alert'];
                 if (($_POST['humidity'])==$row['humidity']){
                    $humidity = $row['humidity'];
                }
                else{
                    $humidity = $_POST['humidity']; 
                }
                
                //echo $_POST['alert'];
                 if (($_POST['emergencyCheck'])){
                    $emergencyCheck = 1;
                }
                else{
                    $emergencyCheck = 0; 
                }
                
                if (floatval($_POST['latAl'])==0){
                    $latAl = $row['AlertLat'];
                }
                else{
                    $latAl = floatval($_POST['latAl']); 
                }
                
                if (floatval($_POST['longAl'])==0){
                    $longAl = $row['AlertLong'];
                }
                else{
                    $longAl = floatval($_POST['longAl']); 
                }
            }
        }
        else {
            echo "0 results";
        }
        
        
        $sql = "INSERT INTO GeneralInformation (time, AlertStatus, temperature, windSpeed, windDirection, 
            humidity,RunnersOnCourse, FinishedRunners, HospitalTransports,
            PatientsSeen, LeadMaleLat, LeadMaleLong, LeadFemaleLat, LeadFemaleLong, LeadWheelchairMaleLat,
            LeadWheelchairMaleLong, LeadWheelchairFemaleLat, LeadWheelchairFemaleLong,
            FinalWheelchairLat,FinalWheelchairLong, TurtleLat, TurtleLong, Alert,emergencyCheck, AlertLat, AlertLong)
            VALUES (
                NOW(),
                ".$alertStatus.",
                ".$temperature.",
                ".$windSpeed.",
                \"".$windDirection."\",
                ".$humidity.",
                ".$runnersOc.",
                ".$finished.",
                ".$transports.",
                ".$pSeen.",
                ".$latLM.",
                ".$longLM.",
                ".$latLF.",
                ".$longLF.",
                ".$latLMW.",
                ".$longLMW.",
                ".$latLFW.",
                ".$longLFW.",
                ".$latFW.",
                ".$longFW.",
                ".$latT.",
                ".$longT.",
                \"".$alert."\" ,
                ".$emergencyCheck.",
                ".$latAl.",
                ".$longAl."
                );";
                
                    
        if ($db->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
        $db->close();
        
        $myfile = fopen("data/gen_info.csv","w") or die("Error opening file");
        
        $txt = "AlertStatus,temperature,windSpeed,windDirection,humidity,";
        $txt = $txt."runnersOnCourse,runnersFinished,hospitalTransports,patientsSeen,";
        $txt = $txt."LeadMaleRunnerLat,LeadMaleRunnerLong,LeadFemaleRunnerLat,LeadFemaleRunnerLong,";
        $txt = $txt."LeadWheelchairMaleLat,LeadWheelchairMaleLong,LeadWheelchairFemaleLat,LeadWheelchairFemaleLong,";
        $txt = $txt."FinalWheelchairLat,FinalWheelchairLong,";
        $txt = $txt."TurtleLat,TurtleLong,Alert,emergencyCheck,AlertLat,AlertLong\n";
        
        $txt = $txt.$alertStatus.",";
        $txt = $txt.$temperature.",";
        $txt = $txt.$windSpeed.",";
        $txt = $txt."\"".$windDirection."\",";
        $txt = $txt.$humidity.",";
        $txt = $txt.$runnersOc.",";
        $txt = $txt.$finished.",";
        $txt = $txt.$transports.",";
        $txt = $txt.$pSeen.",";
        $txt = $txt.$latLM.",";
        $txt = $txt.$longLM.",";
        $txt = $txt.$latLF.",";
        $txt = $txt.$longLF.",";
        $txt = $txt.$latLMW.",";
        $txt = $txt.$longLMW.",";
        $txt = $txt.$latLFW.",";
        $txt = $txt.$longLFW.",";
        $txt = $txt.$latFW.",";
        $txt = $txt.$longFW.",";
        $txt = $txt.$latT.",";
        $txt = $txt.$longT.",";
        $txt = $txt."\"".$alert."\",";
        $txt = $txt.$emergencyCheck.",";
        $txt = $txt.$latAl.",";
        $txt = $txt.$longAl;
        
        echo $txt;
        
        fwrite($myfile,$txt);
        fclose($myfile);

        
        ?> 
        
    <br><br><br><br>
    <a href='input_geninfo.php' >Go back to form</a>
    </body>
</html>