var minuteInterval = 2;

function plotSegment(segmentNumber, PolylineStyling, runners) {
    var polyline = d3.csv('data/milemarkers/milemarkers/mile' + (segmentNumber + 1) + '.csv', function(error, data) {
        var i = 0
        if (error) return console.warn(error);
        //now try to create a mapping of it
        coords = data.map(function(d, i) {
            ////(i);
            return [parseFloat(d.Latitude), parseFloat(d.Longitude)];
        });
        // debugger;
        polyline = L.polyline(coords, PolylineStyling)
            .bindPopup('Runners:' + runners)
            .addTo(pathsLayer);
            //.addTo(map);
        return polyline;
    });
    ////("The next line is the polyline");
    ////(polyline);
    return polyline;
}


function generateLines() {
    
    pathsLayer.clearLayers();
    returnArray = [];
    
    var runnerData = d3.csv('data/Densities.csv', function(error, data) {

        var minute = getMinute();
        minute = minute;
        var data = data[parseInt(minute/2)];
        //(data);

        var data = $.map(data, function(value, index) {
            return [+value];
        });


        if (error) return console.warn(error);
        // //(data);

        //debugger;
        for (var i = 0; i < 26; i++) {

            var runners = +data[i+2];
            //set properties of that segment i
            var segmentStyle = {
                number: i + 1,
                color: 'green',
                weight: '5',
                opacity: 1
            }
            switch (Math.floor(runners / 2000)) {
                case 0:
                    break;
                case 1:
                    segmentStyle.color = 'yellow';
                    break;
                case 2:
                    segmentStyle.color = 'orange';
                    segmentStyle.weight = '7';
                    break;
                case 3:
                    segmentStyle.color = 'red';
                    segmentStyle.weight = '8';
                default:
                    segmentStyle.color = 'red';
                    segmentStyle.weight = '10';
            }
            
            //(segmentStyle);
            
            //remove the old one
            if (started==1){
                //layerGroup.removeLayer(map);
                map.removeLayer(polylineArr[i]);
                started=1;
            }
            started=1;
            //now add a new one and store it
            polylineArr[i]=plotSegment(i, segmentStyle, runners);
        }
        

    });
    // debugger;
    //return returnArray;

}


function plotAS(update){
  
  // //Plot markers for the aid stations
  var aidLoc = [];
  var aidColor = [];
  d3.csv("data/AidStations.csv", function(d) {
        // Add a LatLng object to each item in the dataset
        aidLoc = d;
        return {
            Type: d.Type,
            Latitude: +d.Latitude,
            Longitude: +d.Longitude,
            Location: d.Location,
            RaceKM: +d.RaceKM,
            Status: d.Status,
            CurrentPatients: +d.CurrentPatients,
            Beds: +d.Beds
        };
    },
    function(error, rows) {
        ////(rows);
        
        
        AidStationsGEOJSON = []
        
        for (var i = 0; i < 20; i++) {
            //debugger;
            var percent = 100 * (+rows[i].CurrentPatients / +rows[i].Beds);
            ////(+rows[i].CurrentPatients);
            ////(+rows[i].Beds);
            if ((+rows[i].Status) == 2) {
                AidStationsGEOJSON.push({
                    type: 'Feature',
                    geometry: {
                        type: 'Point',
                        // coordinates here are in longitude, latitude order because
                        // x, y is the standard for GeoJSON and many formats
                        coordinates: [
                            rows[i].Longitude, rows[i].Latitude
                        ]
                    },
                    properties: {
                        'title': 'Closed',
                        'marker-size': size,
                        'marker-color': '#878787',
                        'marker-symbol': rows[i].Location
                    }
                });
                //closed marker

                //('added gray marker at ' + i);
                ////(rows[i].Location);
            }

            else if (percent < 50) {
                AidStationsGEOJSON.push({
                    // this feature is in the GeoJSON format: see geojson.org
                    // for the full specification
                    type: 'Feature',
                    geometry: {
                        type: 'Point',
                        // coordinates here are in longitude, latitude order because
                        // x, y is the standard for GeoJSON and many formats
                        coordinates: [
                            rows[i].Longitude, rows[i].Latitude
                        ]
                    },
                    properties: {
                        'title': 'Aid Station ' + rows[i].Location +'<br>Current Patients: ' + rows[i].CurrentPatients,
                        'marker-size': size,
                        'marker-color': '#009933',
                        'marker-symbol': rows[i].Location
                    }
                });
                //create green marker

                //('added green marker at ' + i)
                ////(rows[i].Location);
                ////(rows[i].Location.substr(0,2));
            }
            //debugger;
            else if (percent < 90) {
                AidStationsGEOJSON.push({
                    type: 'Feature',
                    geometry: {
                        type: 'Point',
                        // coordinates here are in longitude, latitude order because
                        // x, y is the standard for GeoJSON and many formats
                        coordinates: [
                            rows[i].Longitude, rows[i].Latitude
                        ]
                    },
                    properties: {
                        'title': 'Aid Station ' + rows[i].Location +'<br>Current Patients: ' + rows[i].CurrentPatients,
                        'marker-size': size,
                        'marker-color': '#FFDC00',
                        'marker-symbol': rows[i].Location
                    }
                });
                //create yellow marker

                //('added yellow marker at ' + i)

                /*/create yellow marker
                var marker = new L.marker([rows[i].Latitude,rows[i].Longitude],
                    {icon: yellowMarker})
                .addTo(map); 
                ////('added yellow marker at '+i)
                */
            }
            else {
                AidStationsGEOJSON.push({
                    type: 'Feature',
                    geometry: {
                        type: 'Point',
                        // coordinates here are in longitude, latitude order because
                        // x, y is the standard for GeoJSON and many formats
                        coordinates: [
                            rows[i].Longitude, rows[i].Latitude
                        ]
                    },
                    properties: {
                        'title': 'Aid Station ' + rows[i].Location +'<br>Current Patients: ' + rows[i].CurrentPatients,
                        'marker-size': 'large',
                        'marker-color': '#ff0000',
                        'marker-symbol': rows[i].Location
                    }
                });
                //create red marker

                //('added red marker at ' + i)
            }
            
            ASFL.clearLayers();
            //clear
            //ASFL.setGeoJSON({});
            //set new geojson data
            ASFL.setGeoJSON(AidStationsGEOJSON);
            //ASFL.clearLayers();
            //debugger;
        };

        //if (update==0){
          //only add medical tent if it's the first time
          //add medical tent markers (only show Balbo, not both Balbo/Pod) 
          for(var i=21; i<26; i++){ 
              ////(rows[i].Longitude);
              if (size=="medium"){
                var class_size = "fa-2x";
              }
              else{
                var class_size = "fa-3x";
              }
              L.marker([rows[i].Latitude, rows[i].Longitude], {
                icon: L.divIcon({
                  // specify a class name that we can refer to in styles, as we
                  // do above.
                  className: 'fa-icon',
                  // html here defines what goes in the div created for each marker
                  html: '<i class="fa fa-plus-square '+class_size+'" style = "color:red"></i>',
  
                  // and the marker width and height
                  iconSize: [60, 60]
                })
              }).addTo(ASFL);
          };
    });
}

function runnerTracking(){
      //plot runner tracking on map
      var runLoc = [];
      d3.csv("data/gen_info.csv", function(d) {
          // Add a LatLng object to each item in the dataset
          runLoc = d;
          return {
              latLWM: +d.LeadWheelchairMaleLat,
              longLWM: +d.LeadWheelchairMaleLong,
              latLWF: +d.LeadWheelchairFemaleLat,
              longLWF: +d.LeadWheelchairFemaleLong,
              FWLat: +d.FinalWheelchairLat,
              FWLong: +d.FinalWheelchairLong,
              LMRLat: +d.LeadMaleRunnerLat,
              LMRLong: +d.LeadMaleRunnerLong,
              LFRLat: +d.LeadFemaleRunnerLat,
              LFRLong: +d.LeadFemaleRunnerLong,
              TurtleLat: +d.TurtleLat,
              TurtleLong: +d.TurtleLong,
              pace310Lat: +d.pace310Lat,
              pace310Long: +d.pace310Long,
              pace410Lat: +d.pace410Lat,
              pace410Long: +d.pace410Long,
              pace510Lat: +d.pace510Lat,
              pace510Long: +d.pace510Long
          };
      
      }, function(error, rows) {
      
        ////(rows);
        //(rows);
        //debugger;
        geojson[0]=
        {
        "type": "Feature",
        "geometry": {
          "type": "Point",
          "coordinates": [rows[0].longLWM,rows[0].latLWM]
        },
        "properties": {
          "icon": {
            "className": "my-icon icon-dc", // class name to style
            "html": "LWM", // add content inside the marker
            "iconSize": null // size of icon, use null to set the size in CSS
          }
        }
        };
        geojson[1]=
        {
        "type": "Feature",
        "geometry": {
          "type": "Point",
          "coordinates": [rows[0].longLWF,rows[0].latLWF]
        },
        "properties": {
          "icon": {
            "className": "my-icon icon-sf", // class name to style
            "html": "LWF", // add content inside the marker
            "iconSize": null // size of icon, use null to set the size in CSS
          }
        }
        };
        geojson[2]=
        {
        "type": "Feature",
        "geometry": {
          "type": "Point",
          "coordinates": [rows[0].FWLong,rows[0].FWLat]
        },
        "properties": {
          "icon": {
            "className": "my-icon icon-sf", // class name to style
            "html": "FW", // add content inside the marker
            "iconSize": null // size of icon, use null to set the size in CSS
          }
        }
        };
        geojson[3]=
        {
        "type": "Feature",
        "geometry": {
          "type": "Point",
          "coordinates": [rows[0].LMRLong,rows[0].LMRLat]
        },
        "properties": {
          "icon": {
            "className": "my-icon icon-sf", // class name to style
            "html": "LM", // add content inside the marker
            "iconSize": null // size of icon, use null to set the size in CSS
            
          }
        }
        };
        geojson[4]=
        {
        "type": "Feature",
        "geometry": {
          "type": "Point",
          "coordinates": [rows[0].LFRLong,rows[0].LFRLat]
        },
        "properties": {
          "icon": {
            "className": "my-icon icon-dc", // class name to style
            "html": "LF", // add content inside the marker
            "iconSize": null // size of icon, use null to set the size in CSS
          }
        }
        };
        geojson[5]=
        {
        "type": "Feature",
        "geometry": {
          "type": "Point",
          "coordinates": [rows[0].TurtleLong,rows[0].TurtleLat]
        },
        "properties": {
          "icon": {
            "className": "my-icon icon-dc", // class name to style
            "html": "T", // add content inside the marker
            "iconSize": null // size of icon, use null to set the size in CSS
          }
        }
        };
        geojson[6]=
        {
        "type": "Feature",
        "geometry": {
          "type": "Point",
          "coordinates": [rows[0].pace310Long,rows[0].pace310Lat]
        },
        "properties": {
          "icon": {
            "className": "my-icon icon-dc", // class name to style
            "html": "3:10", // add content inside the marker
            "iconSize": null // size of icon, use null to set the size in CSS
          }
        }
        };
        geojson[7]=
        {
        "type": "Feature",
        "geometry": {
          "type": "Point",
          "coordinates": [rows[0].pace410Long,rows[0].pace410Lat]
        },
        "properties": {
          "icon": {
            "className": "my-icon icon-dc", // class name to style
            "html": "4:10", // add content inside the marker
            "iconSize": null // size of icon, use null to set the size in CSS
          }
        }
        };
         geojson[8]=
        {
        "type": "Feature",
        "geometry": {
          "type": "Point",
          "coordinates": [rows[0].pace510Long,rows[0].pace510Lat]
        },
        "properties": {
          "icon": {
            "className": "my-icon icon-dc", // class name to style
            "html": "5:10", // add content inside the marker
            "iconSize": null // size of icon, use null to set the size in CSS
          }
        }
        };
        
        trackingLayer.clearLayers();
        trackingLayer.setGeoJSON([]);
        trackingLayer.setGeoJSON(geojson);
        
      });
      
    ////('here is the geojson');
    ////(geojson);
    trackingLayer.on('layeradd', function(e) {
      var marker = e.layer,
          feature = marker.feature;
      marker.setIcon(L.divIcon(feature.properties.icon));
    });
};

L.mapbox.accessToken = 'pk.eyJ1IjoiYnBleW5ldHRpIiwiYSI6IjNjMjQ0NTM4MTE0MmM0ODkwYTA0Mjg0NGYyZGM4MzM5In0.K96jFRdiKaEPadA1IxKoQw';

//if index or normal: 
if ((window.location.pathname=="/command.php")||(window.location.pathname=="/")){
  var map = L.mapbox.map('map', 'bpeynetti.ed1c07fe')
      .setView([41.8955, -87.648], 14);
  var size = "large";
}
else {
  //if desktop or desktop2:
  var map = L.mapbox.map('map', 'bpeynetti.ed1c07fe')
      .setView([41.8955, -87.648], 12);
  var size = "medium";
}

//properties of the map
map.touchZoom.disable();
map.doubleClickZoom.disable();
// map.scrollWheelZoom.disable();

//create 3 layers minumum
var trackingLayer = L.mapbox.featureLayer().addTo(map);
var pathsLayer = L.mapbox.featureLayer().addTo(map);
var ASLayer = L.mapbox.featureLayer().addTo(map);

//create placeholder for the pacers as geojson
var geojson = [
  {
    "type": "Feature",
    "geometry": {
      "type": "Point",
      "coordinates": [-77.031952,38.913184]
    },
    "properties": {
      "icon": {
        "className": "my-icon icon-dc", // class name to style
        "html": "&#9733;", // add content inside the marker
        "iconSize": null // size of icon, use null to set the size in CSS
      }
    }
  },
  {
    "type": "Feature",
    "geometry": {
      "type": "Point",
      "coordinates": [-77.031952,38.913184]
    },
    "properties": {
      "icon": {
        "className": "my-icon icon-dc", // class name to style
        "html": "&#9733;", // add content inside the marker
        "iconSize": null // size of icon, use null to set the size in CSS
      }
    }
  },
  {
    "type": "Feature",
    "geometry": {
      "type": "Point",
      "coordinates": [-77.031952,38.913184]
    },
    "properties": {
      "icon": {
        "className": "my-icon icon-dc", // class name to style
        "html": "&#9733;", // add content inside the marker
        "iconSize": null // size of icon, use null to set the size in CSS
      }
    }
  },
  {
    "type": "Feature",
    "geometry": {
      "type": "Point",
      "coordinates": [-77.031952,38.913184]
    },
    "properties": {
      "icon": {
        "className": "my-icon icon-dc", // class name to style
        "html": "&#9733;", // add content inside the marker
        "iconSize": null // size of icon, use null to set the size in CSS
      }
    }
  },
  {
    "type": "Feature",
    "geometry": {
      "type": "Point",
      "coordinates": [-77.031952,38.913184]
    },
    "properties": {
      "icon": {
        "className": "my-icon icon-dc", // class name to style
        "html": "&#9733;", // add content inside the marker
        "iconSize": null // size of icon, use null to set the size in CSS
      }
    }
  },
  {
    "type": "Feature",
    "geometry": {
      "type": "Point",
      "coordinates": [-77.031952,38.913184]
    },
    "properties": {
      "icon": {
        "className": "my-icon icon-dc", // class name to style
        "html": "&#9733;", // add content inside the marker
        "iconSize": null // size of icon, use null to set the size in CSS
      }
    }
  },
  {
    "type": "Feature",
    "geometry": {
      "type": "Point",
      "coordinates": [-77.031952,38.913184]
    },
    "properties": {
      "icon": {
        "className": "my-icon icon-dc", // class name to style
        "html": "&#9733;", // add content inside the marker
        "iconSize": null // size of icon, use null to set the size in CSS
      }
    }
  },
  {
    "type": "Feature",
    "geometry": {
      "type": "Point",
      "coordinates": [-77.031952,38.913184]
    },
    "properties": {
      "icon": {
        "className": "my-icon icon-dc", // class name to style
        "html": "&#9733;", // add content inside the marker
        "iconSize": null // size of icon, use null to set the size in CSS
      }
    }
  },
  {
    "type": "Feature",
    "geometry": {
      "type": "Point",
      "coordinates": [-77.031952,38.913184]
    },
    "properties": {
      "icon": {
        "className": "my-icon icon-dc", // class name to style
        "html": "&#9733;", // add content inside the marker
        "iconSize": null // size of icon, use null to set the size in CSS
      }
    }
  },
  {
    "type": "Feature",
    "geometry": {
      "type": "Point",
      "coordinates": [-77.031952,38.913184]
    },
    "properties": {
      "icon": {
        "className": "my-icon icon-dc", // class name to style
        "html": "&#9733;", // add content inside the marker
        "iconSize": null // size of icon, use null to set the size in CSS
      }
    }
  },
];

var coords = [];
var polyline;
var started=0;

//var layerGroup = L.LayerGroup([]);

var polylineArr = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
var coordsArr = [];
//now try to create slices of 2 by 2
var PolylineStyling = generateLines();


ASFL = L.mapbox.featureLayer().addTo(map);

//plot aid station markers
runnerTracking();
plotAS(0);