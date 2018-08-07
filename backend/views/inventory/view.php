<?php
use app\models\Inventory;
use app\models\Drugs;
use app\models\PatientDrugs;
use app\models\PatientHistory;
use yii\helpers\Html;
use yii\widgets\DetailView;
use Phpml\Classification\KNearestNeighbors;
use Phpml\Regression\LeastSquares;
use Phpml\Math\Statistic\Mean;
use Phpml\Math\Statistic\StandardDeviation;
/* @var $this yii\web\View */
/* @var $model app\models\Inventory */
$this->params['breadcrumbs'][] = ['label' => 'Inventories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$inv=new Inventory;
$drug=$inv->getDrug($model->did);
$name="not set";
if($drug){
	$name=$drug->name;
}
$this->title = $name;
?>
<div class="inventory-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <input type="hidden" value="<?=$model->did ?>" id="did">
	    <input type="hidden" value="<?=$drug->name ?>" id="name">
	<p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'id',
            //'did',
            //'amount',
			[                                                  // the owner name of the model
            'label' => 'Quantity at hand',
            'value' => $model->amount,            
            'contentOptions' => ['class' => 'bg-red'],     // HTML attributes to customize value tag
            'captionOptions' => ['tooltip' => 'Tooltip'],  // HTML attributes to customize label tag
        ],
			[                                                  // the owner name of the model
            'label' => 'Drug Name',
            'value' => $name,            
            'contentOptions' => ['class' => 'bg-red'],     // HTML attributes to customize value tag
            'captionOptions' => ['tooltip' => 'Tooltip'],  // HTML attributes to customize label tag
        ],[                                                  // the owner name of the model
            'label' => 'Added On',
            'value' => $model->created,            
            'contentOptions' => ['class' => 'bg-red'],     // HTML attributes to customize value tag
            'captionOptions' => ['tooltip' => 'Tooltip'],  // HTML attributes to customize label tag
        ],
        //'created',
        ],
    ]) ?>
	
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
<?php
$ph=new PatientHistory;
$buyTimes=array();
$history=PatientHistory::find()->where(['did'=>$model->did])->all();
$current=Inventory::find()->where(['did'=>$model->did])->one();
$allInventory=Inventory::find()->where(['did'=>$model->did])->all();
$qty=array();
$samples=array();
$targets=array();
$invSamples=array();
$invTargets=array();
foreach($history as $h){
	$a[0]=$h->amount;
	array_push($buyTimes,$h->created);
	array_push($samples,$a);
	array_push($targets,$h->amount);
}
$targetCount=count($targets);
if($targetCount >1){
$regression = new LeastSquares();
$regression->train($samples, $targets);
}
?>
<div class="col-md-12" id="canvas-holder">
<?php
if($targetCount > 1){
?>
<table class="table">
<?php
$sold_on=$inv->changeDate($model->created);
$drugs=Drugs::find()->where(["id"=>$model->did])->one();
$patientDrugs=PatientDrugs::find()->where(["did"=>$model->id])->one();
if($patientDrugs){
$quantity_sold=$patientDrugs->amount;
$quantity_purchased=$model->amount;
$location=1;
$drug=$drugs->name;
?>
<tr>
<td>Should we stock this product?</td>
<td>
<?php
$inv->keepProduct($drug,$location,$sold_on,$quantity_purchased,$quantity_sold);
?>.
</td>
</tr>
<?php
}
?>
<tr>
<td>Predicted next purchase time</td>
<td><?php echo $inv->getAverageTime($buyTimes); ?></td>
</tr>
<tr>
<?php
if($targetCount > 0){
?>
<tr>
<td>Predicted next purchase quantity</td>
<td><?php echo round($regression->predict([$targets[$targetCount-1]]),0); ?> units</td>
</tr>
<?php
}
?>
<?php
if($targetCount > 0){
?>
<tr>
<td>Proposed next stock quantity</td>
<td><?php echo round($regression->predict([$current->amount]),2)+round($regression->predict([$targets[$targetCount-1]]),0); ?> units</td>
</tr>
<?php
}
?>
<?php
$drugAges=array();
foreach($ages as $age){
	array_push($drugAges,$age['age']);
}
if(count($drugAges) > 0){
?>
<tr>
<td>Mean Age</td>
<td>
<?php
echo round(Mean::arithmetic($drugAges),0);
?> years.
</td>
</tr>
<tr>
<td>Mode</td>
<td>
<?php
echo round(Mean::mode($drugAges),0);
?> years.
</td>
</tr>
<tr>
<td>Median Age</td>
<td>
<?php
echo round(Mean::median($drugAges),0);
?> years.
</td>
</tr>
<tr>
<td>Standard Deviation</td>
<td>
<?php
echo round(StandardDeviation::population($drugAges),2);
?>
</td>
</tr>
<?php
}
?>
</table>
<?php
}
?>
	</div>
	</div>

		<script>
	$(document).ready(function(){		
      var did=$("#did").val();
      var name=$("#name").val();	  
		 $.ajax({url: "index.php?r=inventory/orders&id="+did, success: function(result){
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
				label: '# of Patients using '+name,
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
			
		 //-----------------------------------------------------------------------------------
$.ajax({url: "index.php?r=inventory/genders&id="+did, success: function(result){
        var genders = JSON.parse(result);
		var len2=genders.length;
		var names2=[];
		var amounts2=[];
for(var c=0;c<len2;c++){
	names2.push(genders[c]["gender"]);
	amounts2.push(genders[c]["c"]);
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
					label: 'Genders using '+name
				}],
				labels: names2,
			},
			options: {
				responsive: true
				,
					title: {
						display: true,
						text: 'Gender Breakdown'
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