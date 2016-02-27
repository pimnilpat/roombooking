google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'x');
        data.addColumn('number', 'dtac');
        data.addColumn('number', 'ais');
        data.addColumn('number', 'true');
        data.addRows([
          ['Enquiry', 0, 0, 0],
          ['Request', 0, 0, 0],
          ['Complaint', 0, 0, 0],
          ['Suggestion', 0, 0, 0],
          ['Follow Up', 0, 0, 0],
          ['Admire', 0, 0, 0]
        ]);

        var options = {
          title: '',
		  
		   colors: ['#74b6e2', '#669900', '#ed1f24'], /*FOR GRAPH COLORS   #ff6600  */
		   
		   height:'400',
                   
                   width:'950',
		   
		   hAxis: {title: 'Type of charts',  titleTextStyle: {color: '#5c5c5c'}},
		   
		   legendTextStyle: {color:'#5c5c5c'}, /*FOR RIGHT TEXT*/
		  
		   chartArea: {left:60,top:30,width:"85%",height:"300"},                   
                   
		   
		   tooltip: {textStyle: {color: '#5c5c5c', fontSize:'15'}, showColorCode: true}, /*TOOL TIP OPTIONS*/
		   
		   titleTextStyle: {color: '#5c5c5c', fontName:'arial', fontSize:'15'}, /*FOR TITLE COLOR , FONT AND FONT SIZE*/
		   
		   
		   legendTextStyle: {color:'#5c5c5c'} /*FOR RIGHT TEXT*/
		   

        };

        var chart = new google.visualization.ColumnChart(document.getElementById('bars-chart'));
        chart.draw(data, options);
      }
