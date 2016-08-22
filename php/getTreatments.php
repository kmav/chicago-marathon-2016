<?php 

//include('../db/connect.php');

//get total sum from the database

$sql = "select sum(CumulativePatients) treatments from AidStations;";

$result = $db->query($sql);
if ($result->num_rows==1){
    $row = $result -> fetch_assoc();
    $treatments =$row['treatments'];
}
echo "<script> var totalTreatments = $treatments; </script>";

?>
