<?php
use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Product Analysis - Top 10 Products';
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
		 $.ajax({url: "index.php?r=inventory/get-product-analysis", success: function(result){
         var drugs = JSON.parse(result);
		var len=drugs.length;
		var names=[];
		var amounts=[];
		for(var t=0; t< len; t++){
			names.push(drugs[t]["name"]);
			amounts.push(drugs[t]["amount"]);
		}
var randomScalingFactor = function() {
			return Math.round(Math.random() * 100);
		};

		var config = {
			type: 'pie',
			data: {
				datasets: [{
					data: amounts,
					backgroundColor: [
						window.chartColors.red,
						window.chartColors.orange,
						window.chartColors.yellow,
						window.chartColors.green,
						window.chartColors.blue,
						window.chartColors.bronze,
						window.chartColors.gray,
						window.chartColors.pink,
						window.chartColors.brown,
						window.chartColors.cyan,
					],
					label: 'Top 10 Drugs'
				}],
				labels: names
			},
			options: {
				responsive: true
			}
		};

		window.onload = function() {
			var ctx = document.getElementById('chart-area').getContext('2d');
			window.myPie = new Chart(ctx, config);
		};

		
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
