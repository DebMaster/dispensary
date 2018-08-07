<?php
use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Age Analysis - Patient Groups';
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
		 $.ajax({url: "index.php?r=inventory/get-age-groups", success: function(result){
         var drugs = JSON.parse(result);
		var len=drugs.length;
		var names=[];
		var amounts=[];
			amounts.push(drugs[0]["count0_18"]);
			amounts.push(drugs[0]["count19_30"]);
			amounts.push(drugs[0]["count31_40"]);
			amounts.push(drugs[0]["count41_50"]);
			amounts.push(drugs[0]["count51_60"]);
			amounts.push(drugs[0]["count61_70"]);
			amounts.push(drugs[0]["count71_100"]);
var randomScalingFactor = function() {
			return Math.round(Math.random() * 100);
		};


		var MONTHS = ['0-18', '19-30', '31-40', '41-50', '51-60', '61-70', '71-'];
		var color = Chart.helpers.color;
		var barChartData = {
			labels: ['0-18', '19-30', '31-40', '41-50', '51-60', '61-70', '71-'],
			datasets: [{
				label: '# of Patients',
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
						text: 'Age Groups Breakdown'
					},
					 scales: {
    yAxes: [{
      scaleLabel: {
        display: true,
        labelString: 'Number of Patients'
      }
    }],
	xAxes: [{
      scaleLabel: {
        display: true,
        labelString: 'Age Group'
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
