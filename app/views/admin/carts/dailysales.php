<?php include_once (dirname(__DIR__) . ROOT . 'header.php') ?>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
	google.charts.load('current', {'packages':['bar']});

    google.charts.setOnLoadCallback(chart);

    function chart()
    {
    	var data = google.visualization.arrayToDataTable([
    		["Fecha", "Ventas"],
    		<?php
    			$string = '';
    			foreach ($data['data'] as $sale) {
    				$string .= "['".$sale->date."', ".$sale->sale."],";
    			}
    			print = rtrim($string, ",");
    		?>
    	]);
    	var options = {
    		chart: {
    			title: "Ventas diarias",
    			subtitle: "Tienda"
    		},
    		colors: ["orange"],
    		fontSize: 25,
    		fontName: "Times",
    		bars: "horizontal",
    		height: 600,
    		hAxis: {
    			title: "Ventas €",
    			titleTextStyle : {
    				color: "blue",
    				fontSize: 30
    			}
    			textPosition: "out",
    			textStyle: {
    				color: "blue",
    				fontSize: 20,
    				bold: true,
    				italic: true
    			}

    		},
    		vAxis: {

    			title: "Fecha",
    			titleTextStyle : {
    				color: "red",
    				fontSize: 30
    			}
    			textPosition: "out",
    			textStyle: {
    				color: "blue",
    				fontSize: 30,
    				bold: true,
    				italic: true
    			},
    			gridlines: {
    				color:"gray"
    			}
    		},
    		legend: {
    			position: "none"
    		},
    		titleTextStyle: {
    			color: "gray",
    			fontSize: 40,
    			italic: true
    		}
    	}

    	var chart = new google.charts.Bar(document.getElementById("chart"));
    	chart.draw(data, google.charts.Bar.convertOptions(options));


    }


</script>

<div id="chart"></div>
<?php include_once (dirname(__DIR__) . ROOT . 'footer.php') ?>
