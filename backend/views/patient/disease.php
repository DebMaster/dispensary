<?php
use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Disease-Age Analysis - '.$id;
?>
<div class="inventory-index">
    <h1><?= Html::encode($this->title) ?></h1>	
	<div class="row">
	<div class="col-md-12" id="canvas-holder">
		<canvas id="chart-area"></canvas>
	</div>
	</div>
	<div class="row">
<br><br><br><br>
</div>
		<div class="row">
	<div class="col-md-12" id="canvas-holder">
		<canvas id="pie"></canvas>
	</div>
	</div>

		<div class="row">
<br><br><br><br>
</div>
		<div class="row">
	<div class="col-md-12" id="canvas-holder">
	<h3>Patient Details</h3>
<table class="table table-stripped">
<tr>
<td>Name</td>
<td>Phone</td>
<td>Description</td>
<td>Age</td>
<td>Visit Date</td>
</tr>
<?php
//print_r($patients);
$count=count($patients);
for($x=0;$x<$count;$x++){
	$p=$patients[$x];
	echo "<tr><td>".$p['name']."</td><td>".$p['phone']."</td><td>".$p['description']."</td><td>".$p['age']."</td><td>".$p['created']."</td></tr>";	
}
?>
</table>
	</div>
	</div>

	
	<script>
	$(document).ready(function(){		
var url_string = window.location.href;
var url = new URL(url_string);
var id = url.searchParams.get("id");
		$.ajax({url: "index.php?r=patient/disease-age-stats&id="+id, success: function(result){        
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
				label: '# of Patients suffering from '+id,
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
        labelString: 'Age Groups'
      }
    }]
  }
				}
			});

		


		var colorNames = Object.keys(window.chartColors);				 
    }});
	//----------------------------------------------------------
	
	$.ajax({url: "index.php?r=patient/disease-location-stats&id="+id, success: function(result){       
		var genders = JSON.parse(result);
		var len2=genders.length;
		var names2=[];
		var amounts2=[];
for(var c=0;c<len2;c++){
	names2.push(genders[c]["name"]);
	amounts2.push(genders[c]["cl"]);
}
		var config2 = {
			type: 'pie',
			data: {
				datasets: [{
					data: amounts2,
					backgroundColor: [
						window.chartColors.red,
						window.chartColors.orange					
					],
					label: 'Locations Suffering from '+id
				}],
				labels: names2,
			},
			options: {
				responsive: true
				,
					title: {
						display: true,
						text: id+' - location breakdown'
					}
			}
		};

			var ctx2 = document.getElementById('pie').getContext('2d');
			window.myPie = new Chart(ctx2, config2);

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
