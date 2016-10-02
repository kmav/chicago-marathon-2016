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
var margin = { top: 50, right: 0, bottom: 0, left:100 },
          width = document.getElementById('chart').offsetWidth - margin.left - margin.right,
          height = document.getElementById('chart').offsetHeight - margin.top - margin.bottom,
          gridSize = Math.floor(height / 16 ),
          legendElementWidth = gridSize*2,
          buckets = 2,
          colors = ['#990000', '#ffff00','#009933' ], // alternatively colorbrewer.YlGnBu[9]
          professional= ['ATC', 'Attending', 'Res_Fellow', 'EMT', 'Massage', 'PA', 'PT', 'RN_NP', 'DPM', 'Med_Records', 'Stress'],
          aidStation = ["1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20"]
          //datasets = ["../data/MedCheckInTest.csv"];
          data = data.filter(filterAS_CheckIn);
          
      var hours = filterHour(data);
      var gridSize1 = Math.floor(width / (hours.length * 1.25));

          //datasets = data.filterAS_CheckIn("../data/MedCheckInTest.csv");
          //aidStation = data.filter(getLocation)
      var profesh = ['ATC', 'Attending', 'Res_Fellow', 'EMT', 'Massage', 'PA', 'PT', 'RN_NP', 'DPM', 'Med_Records', 'Stress'];

      var svg = d3.select("#chart").append("svg")
          .attr("width", width + margin.right + margin.left)
          .attr("height", height)
          .append("g")
          .attr("transform", "translate(" + margin.left + "," + margin.top + ")");
          
          var colorScale = d3.scale.quantile()
              .domain([0, buckets - 1, d3.max(data, function (d) { return d.value; })])
              .range(colors);

          var cards = svg.selectAll(".hour")
              .data(data, function(d) {return d.day+':'+d.hour;});

          cards.append("title");

          cards.enter().append("rect")
              .attr("x", function(d, i) { return Math.floor(i/11) * gridSize1; })
              .attr("y", function(d) { return (d.day - 1) * gridSize; })
              .attr("rx", 4)
              .attr("ry", 4)
              .attr("class", "hour bordered")
              .attr("width", gridSize1)
              .attr("height", gridSize)
              .style("fill", colors[0]);

          cards.transition().duration(1000)
              .style("fill", function(d) { return colorScale(d.value); });

          cards.select("title").text(function(d) { return d.value; });
          
          cards.exit().remove();

          var legend = svg.selectAll(".legend")
              .data([0].concat(colorScale.quantiles()), function(d) { return d; });

          legend.enter().append("g")
              .attr("class", "legend");

          legend.append("rect")
            .attr("x", function(d, i) { return legendElementWidth * i + 30; })
            .attr("y", height-90)
            .attr("width", legendElementWidth)
            .attr("height", gridSize / 2)
            .style("fill", function(d, i) { return colors[i]; });

/*
          legend.append("text")
            .attr("class", "mono")
            .text(function(d) { return "< " + 66 + "%"; })
            .attr("x", function(d, i) { return legendElementWidth * i + 30; })
            .attr("y", height + gridSize - 40);
            */
            svg.append("text")
            .attr("class", "mono")
            .text(function() { return "Percentage Checked In"; })
            .attr("x", function() { return legendElementWidth * 0 + 35; })
            .attr("y", height + gridSize - 120 );
            
            
          svg.append("text")
            .attr("class", "mono")
            .text(function() { return "< " + 33 + "%"; })
            .attr("x", function() { return legendElementWidth * 0 + 30; })
            .attr("y", height + gridSize - 90);

            
          svg.append("text")
            .attr("class", "mono")
            .text(function() { return "< " + 66 + "%"; })
            .attr("x", function() { return legendElementWidth * 1 + 30; })
            .attr("y", height + gridSize - 90);
            
          svg.append("text")
            .attr("class", "mono")
            .text(function() { return "< " + 100 + "%"; })
            .attr("x", function() { return legendElementWidth * 2 + 30; })
            .attr("y", height + gridSize - 90);    
          

          legend.exit().remove();
          
          
          var dayLabels = svg.selectAll(".dayLabel")
          .data(professional)
          .enter().append("text")
            .text(function (d,i) { return d; })
            .attr("x", 0)
            .attr("y", function (d, i) { return i * gridSize -25; })
            .style("text-anchor", "end")
            .attr("transform", "translate(-6," + gridSize / 1.5 + ")")
            .attr("class", function (d, i) { return ((i >= 0 && i <= 4) ? "dayLabel mono axis axis-workweek" : "dayLabel mono axis"); });


        
        var timeLabels = svg.selectAll(".timeLabel")
          .data(hours)
          .enter().append("text")
            .text(function(d) {
              return (d); 
            })
            .attr("x", function(d, i) { return i * gridSize1 - 5; })
            .attr("y", -25)
            .style("text-anchor", "middle")
            .style("font-size" , "9")
            .attr("transform", "translate(" + gridSize / 2 + ", -6)")
            .attr("class", function(d, i) { return ((i >= 7 && i <= 16) ? "timeLabel mono axis axis-worktime" : "timeLabel mono axis"); });

    
};

d3.csv('data/MedCheckInTest.csv',drawMedCheckIn);