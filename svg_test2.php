<?php
// scores will be passed in like this
	$svg_scores = array(
		array(
			'date'=>'2019-01-01',
			't-score'=>65.2,
			'std_err'=>2
		),
		array(
			'date'=>'2019-02-01',
			't-score'=>57.5,
			'std_err'=>1.7
		),
		array(
			'date'=>'2019-03-01',
			't-score' =>43,
			'std_err' => .5
		)
	);
	$num_scores = count($svg_scores);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title></title>
	<meta name="generator" content="BBEdit 12.6" />
	
	<!-- svg is local path, eventually load from http cdn -->
	<script src="cdn/svg.2.7.1.js_dev/svg.js"></script>
	
	<style>
		.offset-1 {
			margin-left: 20px;
		}
	</style>
  

</head>

<body onload='draw_plot()'>

<div class = "offset-1">
	<h1>Pain Interference</h1>
	<div id="drawing">
	<!-- 	the location of the svg drawing -->
	</div>
	
	<!-- note: htmlcolorcodes.com -->
	<script>
		function draw_plot(){
			var draw = SVG('drawing').size(1000,500)
			var plot_area_width = 1000
			var plot_area_height = 400
			var x_axis_label 
			var x_axis_label_text
			var tic
			var tic_height = 10
			var tic_width = 2


			draw.rect(plot_area_width, plot_area_height).attr({
				'fill':'#c8d0e5',
				'fill-opacity': 0.75,
				'stroke': '#7f5e80',
				'stroke-width': '2px'
			})

			var negative_gradient = draw.gradient('linear', function(stop) {
			  	stop.at(0, '#007D00') 
			  	stop.at(.45, '#7DFF00') 
			  	stop.at(.58, '#FFFF00') 
			  	stop.at(.87, '#FF7D00') 
			  	stop.at(1, '#FF0000')
			})

			var positive_gradient = draw.gradient('linear', function(stop) {		
				stop.at(0, '#FF0000')
			  	stop.at(.13, '#FF7D00') 
			  	stop.at(.42, '#FFFF00') 
			  	stop.at(.55, '#7DFF00') 
			  	stop.at(1, '#007D00') 
			})	

			var plot
			var plot_width = 800
			var plot_height = 300
			var plot_x_offset= 150
			var plot_y_offset = 50
	    	var y_origin = 45

			var num_tics = 7

			score_inverse = true
			
			plot = draw.rect(plot_width, plot_height).move(plot_x_offset, plot_y_offset)
			if (score_inverse) {
				plot.fill(negative_gradient)
	   	 		var normal_low = 20
    			var normal_high = 54.75
	   	 		var mild_low = 55.25
	    		var mild_high = 59.75			
	   	 		var mod_low = 60.25
	    		var mod_high = 69.75
	   	 		var severe_low = 70.25
	    		var severe_high = 80

			} else {
				plot.fill(positive_gradient)
	   	 		var normal_high = 80
	   	 		var normal_low = 45.25
    			var mild_high = 44.75			
	   	 		var mild_low = 40.25
	    		var mod_high = 39.75   	 		 
	    		var mod_low = 30.25
	    		var severe_high = 29.75
	   	 		var severe_low = 20
			}


			//normal range marker and text
			var range_normal = draw.polyline([
   	 			[plot_x_offset + plot_width * ((normal_low-20)/60), y_origin],
   	 			[plot_x_offset + plot_width * ((normal_low-20)/60), y_origin-10],
				[plot_x_offset + plot_width * ((normal_low-20)/60), y_origin-10],
				[plot_x_offset + plot_width * ((normal_high-20)/60), y_origin-10],
				[plot_x_offset + plot_width * ((normal_high-20)/60), y_origin]
				])
   	 			.fill('none')
				.stroke({width:2, color:'#000000'})
			var normal_center = (plot_x_offset + plot_width * ((normal_low-20)/60)
				 + plot_x_offset + plot_width * ((normal_high-20)/60)) / 2
			draw.text('Within Normal Range')
					.move( normal_center, y_origin-35 )
					.font({anchor: 'middle', size: 18});

			//mild range marker and text
   	 		var range_mild = draw.polyline([
   	 			[plot_x_offset + plot_width * ((mild_low-20)/60), y_origin],
   	 			[plot_x_offset + plot_width * ((mild_low-20)/60), y_origin-10],
				[plot_x_offset + plot_width * ((mild_low-20)/60), y_origin-10],
				[plot_x_offset + plot_width * ((mild_high-20)/60), y_origin-10],
				[plot_x_offset + plot_width * ((mild_high-20)/60), y_origin]
				])
   	 			.fill('none')
				.stroke({width:2, color:'#000000'})
			var mild_center = (plot_x_offset + plot_width * ((mild_low-20)/60)
				 + plot_x_offset + plot_width * ((mild_high-20)/60)) / 2
			draw.text('Mild')
					.move( mild_center, y_origin-35 )
					.font({anchor: 'middle', size: 18});

			//moderate range marker and text
   	 		var range_mod = draw.polyline([
   	 			[plot_x_offset + plot_width * ((mod_low-20)/60), y_origin],
   	 			[plot_x_offset + plot_width * ((mod_low-20)/60), y_origin-10],
				[plot_x_offset + plot_width * ((mod_low-20)/60), y_origin-10],
				[plot_x_offset + plot_width * ((mod_high-20)/60), y_origin-10],
				[plot_x_offset + plot_width * ((mod_high-20)/60), y_origin]
				])
   	 			.fill('none')
				.stroke({width:2, color:'#000000'})
			var mod_center = (plot_x_offset + plot_width * ((mod_low-20)/60)
				 + plot_x_offset + plot_width * ((mod_high-20)/60)) / 2
			draw.text('Moderate')
					.move( mod_center, y_origin-35 )
					.font({anchor: 'middle', size: 18});

			//severe range marker and text
   	 		var range_mod = draw.polyline([
   	 			[plot_x_offset + plot_width * ((severe_low-20)/60), y_origin],
   	 			[plot_x_offset + plot_width * ((severe_low-20)/60), y_origin-10],
				[plot_x_offset + plot_width * ((severe_low-20)/60), y_origin-10],
				[plot_x_offset + plot_width * ((severe_high-20)/60), y_origin-10],
				[plot_x_offset + plot_width * ((severe_high-20)/60), y_origin]
				])
   	 			.fill('none')
				.stroke({width:2, color:'#000000'})
			var severe_center = (plot_x_offset + plot_width * ((severe_low-20)/60)
				 + plot_x_offset + plot_width * ((severe_high-20)/60)) / 2
			draw.text('Severe')
					.move( severe_center, y_origin-35 )
					.font({anchor: 'middle', size: 18});

			// x-axis bottom
			for (i = 0; i < num_tics; i++) {
				draw.rect(tic_width,tic_height)
					.fill('#000000')
					.move(i*(plot_width/(num_tics-1)) + plot_x_offset-1, plot_height + plot_y_offset - tic_height )
				x_axis_label_text = ((i+1)*10+10).toString();
				x_axis_label = draw.text(x_axis_label_text)
					.move(i*(plot_width/(num_tics-1)) + plot_x_offset-5, plot_height + plot_y_offset + 10 )
				}

				var x_axis = draw.rect(plot_width, 2)
						.fill('#000000')
						.move(plot_x_offset, plot_height + plot_y_offset)

			
			// obs data will be passed in from php as a 2D array of tscore,stdev pairs
			// ex: obs[0,obstheta]= 55  o

			var num_obs = 2 // will be calculated from php array as size_of(obs)
			var obs_number
			var obs_theta
			var obs_sd
			var obs_y
			var marker_radius = 20
			var marker_fill = '#0042ff'
			var marker


			// this entire section should loop through a set of obsevations
			// for the sample these are hardcoded
			// observation 1
			obs_number = 1
			obs_theta = 63.5
			obs_sd = 2.5
			obs_y = plot_y_offset + (obs_number*plot_height/(num_obs + 1))

			marker = draw.circle(marker_radius)
			marker.fill(marker_fill)
			marker.cx(plot_x_offset + plot_width * ((obs_theta-20)/60))
			marker.cy(obs_y)
			
			var y_axis_label = draw.text('3/2/2016')
					.move( plot_x_offset-10, obs_y - 10 )
					.font({anchor: 'end', size: 20});
			var y_axis_tic = draw.line(
				plot_x_offset, obs_y,
				plot_x_offset+10, obs_y,
				).stroke({width:2, color:'#000000'})

			var error_bar_max = obs_theta + obs_sd
			var error_bar_min = obs_theta - obs_sd
			var error_range  = draw.line( //x1,y1,x2,y2
				plot_x_offset + plot_width * ((error_bar_min-20)/60),  
				obs_y,
				plot_x_offset + plot_width * ((error_bar_max-20)/60),  
				obs_y
				)
				.stroke({width:4, color:'#0042ff'})
			var error_low = draw.line(
				plot_x_offset + plot_width * ((error_bar_min-20)/60),
				obs_y-10,
				plot_x_offset + plot_width * ((error_bar_min-20)/60),
				obs_y+10,
				)
				.stroke({width:4, color:'#0042ff'})
			var error_high = draw.line(
				plot_x_offset + plot_width * ((error_bar_max-20)/60),
				obs_y - 10,
				plot_x_offset + plot_width * ((error_bar_max-20)/60),
				obs_y + 10,
				)
				.stroke({width:4, color:'#0042ff'})

			
			
			//observation 2
			obs_number = 2
			obs_theta = 42.5
			obs_sd = 2.0
			obs_y = plot_y_offset + (obs_number * plot_height / (num_obs + 1))

			marker = draw.circle(marker_radius)
			marker.fill(marker_fill)
			marker.cx(plot_x_offset + plot_width * ((obs_theta-20)/60))
			marker.cy(obs_y)
			
			var y_axis_label = draw.text('4/2/2016')
					.move( plot_x_offset-10, obs_y - 10 )
					.font({anchor: 'end', size: 20});
			var y_axis_tic = draw.line(
				plot_x_offset, obs_y,
				plot_x_offset+10, obs_y,
				).stroke({width:2, color:'#000000'})

			var error_bar_max = obs_theta + obs_sd
			var error_bar_min = obs_theta - obs_sd
			var error_range  = draw.line( //x1,y1,x2,y2
				plot_x_offset + plot_width * ((error_bar_min-20)/60),  
				obs_y,
				plot_x_offset + plot_width * ((error_bar_max-20)/60),  
				obs_y
				)
				.stroke({width:4, color:'#0042ff'})
			var error_low = draw.line(
				plot_x_offset + plot_width * ((error_bar_min-20)/60),
				obs_y-10,
				plot_x_offset + plot_width * ((error_bar_min-20)/60),
				obs_y+10,
				)
				.stroke({width:4, color:'#0042ff'})
			var error_high = draw.line(
				plot_x_offset + plot_width * ((error_bar_max-20)/60),
				obs_y - 10,
				plot_x_offset + plot_width * ((error_bar_max-20)/60),
				obs_y + 10,
				)
				.stroke({width:4, color:'#0042ff'})
		}	
				
	</script>

<h2>Notes:</h2>
<h4>T-scores</h4>
<ul>
<li>Meaningful change</li>
<li>Mean=50 in the general population</li>
<li>Standard Deviation = 10</li>
<li>High = more of what is being measured (can be positive or negative).
Examples: 
<li>Pain Interference, Higher score would mean more pain interference, hence is bad</li>
<li>Mobility, Higher score would mean more mobility, hence that is good.</li></li>
<li>TScores generally range from 20 to 80</li>
	<ul><li>Normal=20-55 (58%)</li>
	<li> Mild = 55-60 (67%)</li>
	<li>Moderate= 60-70 (83%)</li>
	<li>Severe = 70-80 (100%)</li>
	</ul>
</ul>

<h5>(rgb)</h5>
green (0,125,0) <br />
yellow (255, 255, 0)<br />
orange (255, 125, 0)<br />
red  (255,0,0) <br />

<h5>PROMIS Global Measures</h5>
Excellent: greater than 65<br />
Very Good: 55-65<br />
Good: 45-55<br />
Fair: 35-45<br />
Poor: less than 35<br />


</body>
</html>
