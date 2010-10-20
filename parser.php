<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Parser Example</title>
		<!-- 1. Add these JavaScript inclusions in the head of your page -->
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
		<script type="text/javascript" src="/js/highcharts.js"></script>
		
		<!-- 1a) Optional: the exporting module -->
		<script type="text/javascript" src="/js/modules/exporting.js"></script>
		
		
		<!-- 2. Add the JavaScript to initialize the chart on document ready -->
				<script type="text/javascript">
		
			var chart;
			$(document).ready(function() {
				chart = new Highcharts.Chart({
					chart: {
						renderTo: 'container',
						zoomType: 'x'
					},
				        title: {
						text: 'Stream Gauge Height'
					},
				        subtitle: {
						text: 'Click and drag in the plot area to zoom in'
					},
					xAxis: {
						type: 'datetime',
						maxZoom: 1 * 24 * 3600000, // fourteen days
						title: {
							text: null
						}
					},
					yAxis: {
						title: {
							text: 'Water Level (feet)'
						},
						min: 0.6,
						startOnTick: true,
						showFirstLabel: false
					},
					tooltip: {
						formatter: function() {
							return ''+
								Highcharts.dateFormat('%A %B %e %Y', this.x) + ':'+
								' Water Level = '+ Highcharts.numberFormat(this.y, 2) +' feet';
						}
					},
					legend: {
						enabled: false
					},
					plotOptions: {
						area: {
							fillColor: {
								linearGradient: [0, 0, 0, 300],
								stops: [
									[0, '#4572A7'],
									[1, 'rgba(2,0,0,0)']
								]
							},
							lineWidth: 1,
							marker: {
								enabled: false,
								states: {
									hover: {
										enabled: true,
										radius: 5
									}
								}
							},
							shadow: false,
							states: {
								hover: {
									lineWidth: 1						
								}
							}
						}
					},
				
					series: [{
						type: 'area',
						name: 'Water Level',
						data: [
						
						
						<?php
						$filename = "testData.txt";
						$fd = fopen ($filename, "r");
						$contents = fread ($fd,filesize ($filename));
						fclose ($fd);
						$delimiter = "	";
						$splitcontents = explode($delimiter, $contents);
						$counter = 0;
						$arraycount = 0;
						$format = 'Y-m-d H:i';
						$hour = array();
						$minute = array();
						$day = array();
						$month = array();
						$year = array();
						$time = array();
						$elevation = array();
						foreach($splitcontents as $val)
						{
							
							if($counter == 2)
							{				
								$time[$arraycount] = $val;
								$datetime = date_parse_from_format($format, $time[$arraycount]);
								$year[$arraycount] = $datetime[year];
								$month[$arraycount] = $datetime[month];
								$day[$arraycount] = $datetime[day];
								$hour[$arraycount] = $datetime[hour];
								$minute[$arraycount] = $datetime[minute];
								echo "[Date.UTC(".$year[$arraycount].",". $month[$arraycount].",".$day[$arraycount].",".$hour[$arraycount].",".$minute[$arraycount]."),";
							}
							if($counter == 4)
							{
								$counter = -1;
								$elevation[$arraycount] = $val;
								$arraycount = $arraycount + 1;
								echo " ". $val."],";
							}
							$counter = $counter + 1;
						}
						?>
						]
					}]
				});
				
				
			});
				
		</script>
	</head>
	<body>
			
		<!-- 3. Add the container -->
		<div id="container" style="width: 800px; height: 400px; margin: 0 auto"></div>

	</body>
</html>
