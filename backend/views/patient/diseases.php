<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Diseases';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-index">
<h1><?= Html::encode($this->title) ?></h1>
<table class='table table-stripped'>
<tr>
<td>Name</td>
<td>Action</td>
</tr>
<?php
foreach($diseases as $d){
$url=Url::to(["patient/disease","id"=>$d->diseases]);	
echo "<tr><td>".$d->diseases."</td><td><a href='".$url."' class='btn btn-primary btn-sm'>View</a></td></tr>";
}
?>
</table>
</div>
