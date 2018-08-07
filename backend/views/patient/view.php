<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Drugs;
use app\models\Locations;
use app\models\PatientHistory;

/* @var $this yii\web\View */
/* @var $model app\models\Patient */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Patients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
            'id',
            'name',
            'phone',
            'email:email',
            'created',
            'age',
            'location',
        ],
    ]);
	?>
<h2>Patient History</h2>	
<table class="table table-stripped">
<tr>
<td>Illness Description</td>
<td>Drug Administered</td>
<td>Location</td>
<td>Amount</td>
<td>Date</td>
</tr>
<?php
$history=PatientHistory::find()->where(['pid'=>$model->id])->all();
//$count=$history->count();
//for($x=0;$x<$count;$x++){
	foreach($history as $h){
	$l=$h->location;
	$location=Locations::find()->where(['id'=>$l])->one();
	$drug=Drugs::find()->where(["id"=>$h->did])->one();
	echo "<tr><td>".$h->description."</td><td>".$drug->name."</td><td>".$location->name."</td><td>".$h->amount."</td><td>".$h->created."</td></tr>";	
}
?>
</table>
</div>
