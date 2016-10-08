function filterAS_CheckIn(obj){
	//return false;
	return (+obj.display==1);
};

function getLocation(obj){
  return +obj.hour;
};

function filterHour(data){
  var hours = [];
  
  for (var i=0; i < data.length; i++){
    if (hours.indexOf(data[i].hour) == -1 ){
      hours.push(data[i].hour);
    }
  }
  
  return hours;
}



function drawMedCheckIn(data){
var margin = { top: 25, right: 0, bottom: 0, left:100 },
          width = document.getElementById('chart').offsetWidth - margin.left - margin.right,
          height = document.getElementById('chart').offsetHeight,
          gridSize = Math.floor(height / 6 ),
          legendElementWidth = gridSize*2,
          buckets = 2,
          colors = ['white','green','yellow','#ff6600', '#cc3300', 'red'], // alternatively colorbrewer.YlGnBu[9]
          professional= ['Stress'],
          aidStation = ["1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20"]
          //datasets = ["../data/MedCheckInTest.csv"];
          
      var hours = filterHour(data);
      var gridSize1 = Math.floor(width / 6);

          //datasets = data.filterAS_CheckIn("../data/MedCheckInTest.csv");
          //aidStation = data.filter(getLocation)
      var profesh = ['Stress'];

      var svg = d3.select("#chart").append("svg")
          .attr("width", width + margin.right + margin.left)
          .attr("height", height)
          .append("g")
          .attr("transform", "translate(" + margin.left + "," + margin.top + ")");
          
          
          var cards = svg.selectAll(".hour")
              .data(data);

          cards.append("title");

          cards.enter().append("rect")
              .attr("x", function(d, i) { return ((d.aidStation -1) % 5) * gridSize1; })
              .attr("y", function(d) { 
                console.log(d.zone);
                return (d.zone) * gridSize; 
              })
              .attr("rx", 4)
              .attr("ry", 4)
              .attr("class", "hour bordered")
              .attr("width", gridSize1)
              .attr("height", gridSize)
              .style("fill", function(d) {return colors[parseInt(d.stress)]; });

          cards.transition().duration(1000)
              .style("fill", function(d) { return colors[parseInt(d.stress)]; });

          cards.select("title").text(function(d) { return d.stress; });
          
          cards.exit().remove();


          var legend = svg.selectAll(".legend")
              .data([0,1,2,3,4,5]);

          legend.enter().append("g")
              .attr("class", "legend");

          legend.append("rect")
            .attr("x", function(d, i) { return gridSize1 * (i-1) ; })
            .attr("y", height-90)
            .attr("width", gridSize1)
            .attr("height", gridSize / 2)
            .style("fill", function(d, i) { return colors[i]; });

          legend.append("text")
            .attr("x", function(d, i) { return gridSize1 * (i-1) + (gridSize1/2); })
            .attr("y", height-70)
            .text(function(d,i) { return i; })
            .attr("height", gridSize / 2)
            .attr("class", "axis-worktime")
            .style("text-anchor", "middle")
            .style("font-size" , "9")
  


          //   svg.append("text")
          //   .attr("class", "mono")
          //   .text(function() { return "Percentage Checked In"; })
          //   .attr("x", function() { return legendElementWidth * 0 + 35; })
          //   .attr("y", height + gridSize - 120 );
            


          legend.exit().remove();
          
        var zones = ['Zone A', 'Zone B', 'Zone C', 'Zone D'];

        var dayLabels = svg.selectAll(".dayLabel")
          .data(zones)
          .enter().append("text")
            .text(function (d,i) { return d; })
            .attr("x", 0)
            .attr("y", function (d, i) { 
              return (i) * gridSize - 0; 
              
            })
            .style("text-anchor", "end")
            .attr("transform", "translate(-6," + gridSize / 1.5 + ")")
            .attr("class", function (d, i) { return ((true) ? "dayLabel mono axis axis-workweek" : "dayLabel mono axis"); });


        var timeLabels = svg.selectAll(".timeLabel")
          .data(data)
          .enter().append("text")
            .text(function(d) {
              return (d.aidStation); 
            })
              .attr("x", function(d, i) { return ((d.aidStation -1) % 5) * gridSize1; })
              .attr("y", function(d) { 
                return (d.zone) * gridSize + (gridSize/1.5); 
              })
            .style("text-anchor", "middle")
            .style("font-size" , "9")
            .attr("transform", "translate(" + gridSize / 2 + ", -6)")
            .attr("class", function(d, i) { return ((true) ? "timeLabel mono axis axis-worktime" : "timeLabel mono axis"); });

    

        
    
};

d3.csv('data/allStress.csv',drawMedCheckIn);