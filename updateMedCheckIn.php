<?php 
include('php/isMobile.php');

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Input Medical </title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.6/d3.min.js" charset="utf-8"></script>
        <script src="js/googleAnalytics.js"></script>

        <link rel='stylesheet' type='text/css' href='css/styling.css'>
             <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel='stylesheet' type='text/css' href='css/menu.css'>
    </head>
    <body>
        <?php include('php/header.php'); ?>
            <a href='medicalCheckIn.php' >Go back to form</a>
<br><br>
        <?php include 'db/connect.php'; ?>
        
        <?php
        $MedCheckIn = array();

        $sql = "SELECT * FROM MedCheckIn";
        $result = $db->query($sql);
        
        if ($result->num_rows>0){
            //output data of each row as a variable in php
            while ($row = $result -> fetch_assoc()){
                
                $tempArray = array(
                    "Key"=>$row['Location'],
                    "Type"=>$row['StationType'],
                    "TimeUpdate"=>((string)$row['timeUpdate']),
                    "Location"=>$row['Location'],
                    "Display"=>$row['Display'],
                    "ATC"=>$row['ATC'],
                    "Attending"=>$row['Attending'],
                    "Res_Fellow"=>$row['Res_Fellow'],
                    "EMT"=>$row['EMT'],
                    "Massage"=>$row['Massage'],
                    "PA"=>$row['PA'],
                    "PT"=>$row['PT'],
                    "RN_NP"=>$row['RN_NP'],
                    "Med_Records"=>$row['Med_Records'],
                    "DPM"=>$row['DPM'],
                    "ATC_Recruit"=>$row['ATC_Recruit'],
                    "Attending_Recruit"=>$row['Attending_Recruit'],
                    "Res_Fellow_Recruit"=>$row['Res_Fellow_Recruit'],
                    "EMT_Recruit"=>$row['EMT_Recruit'],
                    "Massage_Recruit"=>$row['Massage_Recruit'],
                    "PA_Recruit"=>$row['PA_Recruit'],
                    "PT_Recruit"=>$row['PT_Recruit'],
                    "RN_NP_Recruit"=>$row['RN_NP_Recruit'],
                    "Med_Records_Recruit"=>$row['Med_Records_Recruit'],
                    "DPM_Recruit"=>$row['DPM_Recruit'],
                    "Stress"=>$row['Stress']
                    );
                //echo $tempArray["Location"];
                //echo "<br>";
                array_push($MedCheckIn,$tempArray);
            }
        }
        else {
            echo "0 results";
        }


        //get the values passed to me from the form medicalCheckIn.php
        $counter = 1;
        
        $names = array('Display', 'ATC', 'Attending', 'Res_Fellow', 'EMT', 'Massage', 'PA', 'PT', 'RN_NP', 'DPM', 'Med_Records', 'Stress');

        foreach($MedCheckIn as &$station){
            //now check and/or change as needed
            
                //echo "<br>$$$$".$counter."$$$$$<br>";
                //echo $_POST["AS_Current".$counter];
                //echo $_POST["AS_Cumulative".$counter];
                for ($x = 0; $x < count($names); $x++ ){
                    $station[$names[$x]] = (int)$_POST[$names[$x].$counter];
                    //echo $names[$x].$counter;
                    //echo $_POST[$names[$x].$counter];
                    //echo $names[$x];
                    //echo $station[$names[$x]];
                }
                // echo $str;
                // echo "%%%%%";
                // echo $_POST[$str];
                // if ($_POST[$str]>0){
                //     $station["CumulativePatients"] =  (int)$_POST["AS_Cumulative".$counter];
                // }
                
                //add status updates!!! (from buttons or something like that)
                /*
                $str = "AS_status".$counter;
                $station["Status"] = (int)$_POST[$str];
                */
                $str = "Display".$counter;      
                //echo "<br>";
                //echo $str;
                $station["Display"] = $_POST[$str];
                if ($station["Display"]==true){
                    $station["Display"]=1;
                }
                else{
                    $station["Display"]=0;
                }
                
                //echo $station["Display"];
                //echo "<br>";


            
            //and update in the database
            //UPDATE table_name
            //SET column1=value, column2=value2,...
            //  WHERE some_column=some_value 
            
            //'ATC', 'Attending', 'Res_Fellow', 'EMT', 'Massage', 'PA', 'PT', 'RN_NP', 'DPM', 'Med_Records'

            $sql = "UPDATE MedCheckIn
                SET timeUpdate=NOW(), Display=".$station["Display"].",ATC=".$station["ATC"] .", Attending=".$station["Attending"] .", Res_Fellow=".$station["Res_Fellow"]."
                ,EMT=".$station["EMT"].",Massage=".$station["Massage"].",PA=".$station["PA"].",PT=".$station["PT"]."
                ,RN_NP=".$station["RN_NP"].",DPM=".$station["DPM"].",Med_Records=".$station["Med_Records"].",Stress=".$station["Stress"]." 
                WHERE Location=".$station["Key"].";";
            echo $sql;
            echo $station["Location"];
            echo "<br>";
            if ($db->query($sql) === TRUE) {
                echo "Record ".$station["id"] ."updated successfully";
            } else {
                echo "Error updating record: ".$station["id"]." -- ERROR: ". $db->error;
            }
            $counter++;
        }

        //now write to file
        /* format: 
        $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
        $txt = "John Doe\n";
        fwrite($myfile, $txt);
        $txt = "Jane Doe\n";
        fwrite($myfile, $txt);
        fclose($myfile);
        */
        
        
        //$txt = "Location,StationType,timeUpdate,ATC,Attending,Res_Fellow,EMT,Massage,PA,PT,RN_NP,DPM,Med_Records,Display,ATC_Recruit,Attending_Recruit,Res_Fellow_Recruit,EMT_Recruit,Massage_Recruit,PA_Recruit,PT_Recruit,RN_NP_Recruit,DPM_Recruit,Med_Records_Recruit,Stress\n";
        $profesh = array('ATC', 'Attending', 'Res_Fellow', 'EMT', 'Massage', 'PA', 'PT', 'RN_NP', 'DPM', 'Med_Records');

        $txt = "professional,day,hour,value,display\n";
        $myfile = fopen("data/MedCheckInTest.csv","w") or die("unable to open file!");
        fwrite($myfile,$txt);
        $counter=1;

        foreach($MedCheckIn as $station){
            //ERROR -> for some reason, the last key and location gets changed back to 19 instead of 20
            //fixed it with a counter, but should check on this!
            //echo $station["Key"];
            //echo $counter;
            //write a new line
            $txt = "";
            for ($x = 0; $x < count($profesh); $x++ ){
                    // $txt = $counter."\t";
                    // $txt = $txt.$x."\t";
                    $txt = "";
                    $txt = $txt.$profesh[$x].",";
                    $txt = $txt.$x.",";
                    $txt = $txt.$counter.",";
                    
                    $recruit = $station[$profesh[$x]."_Recruit"];
                    $type = $station[$profesh[$x]];
                    
                    if ($recruit == 0){
                        $recruitPercentage = 1;
                    }
                    else{
                        $recruitPercentage = $type / $recruit;
                    }
                    
                    // $recruitPercentage = $station[$type]/$station[$recruit];
                    
                    // echo $recruit;
                    // echo $station[$recruit];
                    // echo $type;
                    // echo $station[$type];
                    
                    // echo $percentage;
                    
                    $txt = $txt.$recruitPercentage.",";
                    $txt = $txt.$station['Display']."\n";
                    
                    
                    fwrite($myfile,$txt);
            }
            
            $stressPercentage = 1;
            
            if($station["Stress"]==1){
                $stressPercentage = 1;
            }
            elseif($station["Stress"] <= 3){
                $stressPercentage = 0.75;
            }
            else{
                $stressPercentage = 0;
            }
            
            
            $x = 10;
            $txt = "";
            $txt = $txt."Stress,";
            $txt = $txt.$x.",";
            $txt = $txt.$counter.",";
            $txt = $txt.$stressPercentage.",";

            $txt = $txt.$station['Display']."\n";
            

            fwrite($myfile,$txt);
            // if ($counter<28){
            //      $txt = $station["Type"].",";
            //     if ($counter>=21){
            //         if ($counter==28){
            //             $txt = $txt; 
            //         }
            //         else {
            //             $txt = $txt .$station["Location"].",";
            //         }
            //     }
            //     else {
            //         $txt = $txt .$counter.",";
            //     }
                
            //     for ($x = 0; $x < count($names); $x++ ){
            //         $txt = $txt .$station[$names[$x]].",";
            //     }
                
            //     $txt = $txt ."\n";

                $counter++;   
            
        }
        
        
        
        
        fclose($myfile);
        
        
        /*
        
        $sql = "INSERT INTO `MedCheckInEvent` ( `AS1_comment`, `AS1_current`, `AS1_cumulative`, `AS1_status`,
        `AS2_comment`, `AS2_current`, `AS2_cumulative`, `AS2_status`, `AS3_comment`, `AS3_current`, `AS3_cumulative`, `AS3_status`,
        `AS4_comment`, `AS4_current`, `AS4_cumulative`, `AS4_status`, `AS5_comment`, `AS5_current`, `AS5_cumulative`, `AS5_status`,
        `AS6_comment`, `AS6_current`, `AS6_cumulative`, `AS6_status`, `AS7_comment`, `AS7_current`, `AS7_cumulative`, `AS7_status`,
        `AS8_comment`, `AS8_current`, `AS8_cumulative`, `AS8_status`, `AS9_comment`, `AS9_current`, `AS9_cumulative`, `AS9_status`,
        `AS10_comment`, `AS10_current`, `AS10_cumulative`, `AS10_status`, `AS11_comment`, `AS11_current`, `AS11_cumulative`, `AS11_status`,
        `AS12_comment`, `AS12_current`, `AS12_cumulative`, `AS12_status`, `AS13_comment`, `AS13_current`, `AS13_cumulative`, `AS13_status`,
        `AS14_comment`, `AS14_current`, `AS14_cumulative`, `AS14_status`, `AS15_comment`, `AS15_current`, `AS15_cumulative`, `AS15_status`,
        `AS16_comment`, `AS16_current`, `AS16_cumulative`, `AS16_status`, `AS17_comment`, `AS17_current`, `AS17_cumulative`, `AS17_status`,
        `AS18_comment`, `AS18_current`, `AS18_cumulative`, `AS18_status`, `AS19_comment`, `AS19_current`, `AS19_cumulative`, `AS19_status`,
        `AS20_comment`, `AS20_current`, `AS20_cumulative`, `AS20_status`,
        `Balbo_comment`, `Balbo_current`, `Balbo_cumulative`, `Balbo_status`,
        `Indiana_comment`, `Indiana_current`, `Indiana_cumulative`, `Indiana_status`,
        `Ambulance_comment`, `Ambulance_current`, `Ambulance_cumulative`, `Ambulance_status`,
        `Podiatry_comment`, `Podiatry_current`, `Podiatry_cumulative`, `Podiatry_status`,
        `Jackson_comment`, `Jackson_current`, `Jackson_cumulative`, `Jackson_status`,
        `Laflin_comment`, `Laflin_current`, `Laflin_cumulative`, `Laflin_status`,
        Balbo_ICU_comment,Balbo_ICU_current,Balbo_ICU_cumulative,Balbo_ICU_status,
        Balbo_UC_comment,Balbo_UC_current,Balbo_UC_cumulative,Balbo_UC_status,
        timeUpdate) VALUES ( ";

        foreach($MedCheckIn as $station){
            echo $station['Location']."-".$station['Comments']."-".$station['CurrentPatients']."-".$station['CumulativePatients']."-".$station['Status']."<br>";
            $sql = $sql."\"".$station["Comments"]."\",".$station["CurrentPatients"].",".$station['CumulativePatients'].",".$station['Status'].",";
        }
        echo $sql;
        $sql = $sql."NOW() );";
        $_SESSION['data_success']=false;
        if ($db->query($sql) === TRUE) {
            $_SESSION['data_success']=true;
            echo " \n \n \n Data logged successfully";
        } else {
            echo "Error updating record: ".$station["id"]." -- ERROR: ". $db->error;
            echo "\n".$sql;
        }
        
        */
        
       ?>
        
        
    <br><br><br><br>
    </body>
</html>