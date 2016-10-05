var alertMarker=0;
function displayInfo(data){
     (data);
    
    var started = data[0].runnersStarted;
	var run = data[0].runnersOnCourse;
    var runnersFinished = data[0].runnersFinished;
    var hospitalTransports = data[0].hospitalTransports;
    var patientsSeen = data[0].patientsSeen;
    var Status = data[0].AlertStatus;
    var emergencyCheck = data[0].emergencyCheck;
    var AlertLat = data[0].AlertLat; 
    var AlertLong = data[0].AlertLong; 
    var message = data[0].Alert;
    
    //display runners finished
    d3.select("#RunnersStarted")
    .text("Started: " + started);
    
    d3.select("#RunnersOnCourse")
    .text("On Course: " + run);
    
    d3.select("#RunnersFinished")
    .text("\u2212 Finishers: " + runnersFinished);
    
    d3.select("#HospitalTransports")
    .text("Hospital Transports: " + hospitalTransports);
    
    d3.select("#PatientsSeen")
    .text("Total Treatments: " + totalTreatments);
    
    d3.select("#InMedical")
    .text("In-Treatment: " + inMedical);
    
    d3.select("#alertbar")
        .attr("class",function(){
            switch (+emergencyCheck){
                case 0:
                     ("alert bar white");
                    return 'white';
                    break;
                case 1:
                     ("alert bar red");
                    return 'red';
                    break;
            }
        });
        
        
        d3.select("#header")
        .attr("class",function(){
            //(Status);
            console.log(Status);
            switch (+Status){
                case 0:
                    return 'green';
                    break;
                case 1:
                    console.log("yellow alert")
                    return 'yellow';
                    break;
                case 2:
                    return 'red';
                    break;
                case 3:
                    return 'black';
                    break;
            }
        });
        
        d3.select("#MarathonName")
        .attr("class",function(){
            if ((+Status)==1){
                return 'black';
            }
            else{
                return 'white';
            }
        });
    
    d3.select("#NUlogo")
        .attr("class",function(){
            if ((+Status)==1){
                return 'purple';
            }
            else{
                return 'white';
            }
        });
        
    d3.select("#alertText")
        .text(message);
    
         
    var temp = data[0].temperature;
    var windspeed = data[0].windSpeed;
    var winddirec = data[0].windDirection;
    var humidity = data[0].humidity;

    
    //display runners finished
    //  (temp);
    //  (windspeed);
    
    d3.select("#Temp")
    .text(temp + " °F");
    
    d3.select("#WindHumid")
    .text(windspeed + " mph " + winddirec + ", RH: " + humidity + "%");
    
    //  (run);
    //  (runnersFinished);
    
    //adding popup emergency marker on map 
                //  (AlertLat);
                //  (AlertLong);
    /*           L.mapbox.featureLayer({
                    type: 'Feature',
                    geometry: {
                        type: 'Point',
                        // coordinates here are in longitude, latitude order because
                        // x, y is the standard for GeoJSON and many formats
                        coordinates: [
                            AlertLong, AlertLat
                        ]
                    },
                    properties: {
                        'marker-color': '#FF0000',
                        'marker-symbol': 'cross',
                        "icon": {
                            'iconSize': [50,50],
                            'iconAnchor': [25,25]
                        }
                        
                    }
                }).addTo(map); */
if (alertMarker!=0){
map.removeLayer(alertMarker);
}
if(emergencyCheck==1){    
    
alertMarker = L.marker([AlertLat, AlertLong], {
    icon: L.divIcon({
        // specify a class name that we can refer to in styles, as we
        // do above.
        className: 'fa-icon',
        // html here defines what goes in the div created for each marker
        html: '<i class="fa fa-exclamation-triangle fa-5x"  style = "color:red"></i>',
        // and the marker width and height
        iconSize: [60, 60]
    })
});
alertMarker.addTo(map);
    
}
}


d3.csv("data/gen_info.csv",displayInfo);

//may make new general info file with runners on course, runners finished, hospital transports, and patients seen
