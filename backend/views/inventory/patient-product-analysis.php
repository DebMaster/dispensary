<?php
use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Product Analysis - Top Selling Products';
?>
<div class="inventory-index">

    <h1><?= Html::encode($this->title) ?></h1>
	<div class="row">
	<div class="col-md-12" id="canvas-holder">
		<canvas id="chart-area"></canvas>
	</div>
	</div>
	<script>
	$(document).ready(function(){		
		 $.ajax({url: "index.php?r=inventory/get-patient-product-analysis", success: function(result){
         var drugs = JSON.parse(result);
		var len=drugs.length;
				var names=[];
		var amounts=[];
		for(var t=0; t< len; t++){
			names.push(drugs[t]["name"]);
			amounts.push(drugs[t]["damount"]);
		}
var randomScalingFactor = function() {
			return Math.round(Math.random() * 100);
		};


		var MONTHS = ['0-18', '19-30', '31-40', '41-50', '51-60', '61-70', '71-'];
		var color = Chart.helpers.color;
		var barChartData = {
			labels: names,
			datasets: [{
				label: 'Quantity Bought',
				backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
				borderColor: window.chartColors.red,
				borderWidth: 1,
				data: amounts
			}]

		};

		
			var ctx = document.getElementById('chart-area').getContext('2d');
			window.myBar = new Chart(ctx, {
				type: 'bar',
				data: barChartData,
				options: {
					responsive: true,
					legend: {
						position: 'top',
					},
					title: {
						display: true,
						text: 'Top Selling products'
					},
					 scales: {
    yAxes: [{
      scaleLabel: {
        display: true,
        labelString: 'Quantity Bought'
      }
    }],
	xAxes: [{
      scaleLabel: {
        display: true,
        labelString: 'Drugs'
      }
    }]
  }     
				}
			});

		


		var colorNames = Object.keys(window.chartColors);
		
		 
		 
    }});
	var dynamicColors = function() {
            var r = Math.floor(Math.random() * 255);
            var g = Math.floor(Math.random() * 255);
            var b = Math.floor(Math.random() * 255);
            return "rgb(" + r + "," + g + "," + b + ")";
         };
	});
		
	</script>
</div>
