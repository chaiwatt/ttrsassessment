// ;
getRadarChartData().then(data => {
  var pillar1 = data.filter(x => x.pillar_id == 1).reduce((a, b) => +a + +b.percent, 0)/(data.length/4); 
  var pillar2 = data.filter(x => x.pillar_id == 2).reduce((a, b) => +a + +b.percent, 0)/(data.length/4); 
  var pillar3 = data.filter(x => x.pillar_id == 3).reduce((a, b) => +a + +b.percent, 0)/(data.length/4); 
  var pillar4 = data.filter(x => x.pillar_id == 4).reduce((a, b) => +a + +b.percent, 0)/(data.length/4);

  var avgpillar = (pillar1 + pillar2 + pillar3 + pillar4)/4;
  var avrgrade = checkPillarGrade(avgpillar)
  console.log("--> " + avgpillar);
  LeftTopChart();
}).catch(error => {})

function getRadarChartData() {
  return new Promise((resolve, reject) => {
      $.ajax({
          url: `${route.url}/api/report/chart/gettopleftchartdata`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          success: function(data) {
          resolve(data)
          },
          error: function(error) {
          reject(error)
          },
      })
  })
}

function LeftTopChart(){
  var data = {
      datasets: [
      {
          data: [ 
          82.02,
          100-82.02
          ],
          backgroundColor: [
          "#4688ce",
          "#bbbbbb"
          ],
          borderWidth:0,
          borderColor:'#fff',
          hoverBorderWidth:1,
          hoverBorderColor:'#fff'
      }]
  }
  
  var promisedDeliveryChart = new Chart(document.getElementById('myChart'), {
      type: 'doughnut',
      data: data,
      options: {
          responsive: true,
      legend: {
          display: false
      },
      cutoutPercentage: 80,
      }
  });
  
  Chart.pluginService.register({
      beforeDraw: function(chart) {
      var width = chart.chart.width,
          height = chart.chart.height,
          ctx = chart.chart.ctx;
  
      ctx.restore();
      var fontSize = (height / 114).toFixed(2);
      ctx.font = fontSize + "em sans-serif ";
      ctx.textBaseline = "middle";
  
      var text = "82.02 AA" ,
          textX = Math.round((width - ctx.measureText(text).width) / 2),
          textY = height / 2;
  
      ctx.fillText(text, textX, textY);
      ctx.save();
      }
  });

}

function checkPillarGrade(_percent){
  var percent = parseInt(_percent);
  if(percent >= 87){
      return 'AAA';
  }else if(percent >= 80 && percent < 87){
      return 'AA';
  }else if(percent >= 74 && percent < 80){
      return 'A';
  }else if(percent >= 70 && percent < 74){
      return 'BBB';
  }else if(percent >= 64 && percent < 70){
      return 'BB';
  }else if(percent >= 56 && percent < 64){
      return 'B';
  }else if(percent >= 54 && percent < 56){
      return 'CCC';
  }else if(percent >= 51 && percent < 54){
      return 'CC';
  }else if(percent >= 48 && percent < 51){
      return 'C';
  }else if(percent >= 25 && percent < 48){
      return 'D';
  }else if(percent >= 0 && percent < 25){
      return 'E';
  }
}
