<?php
use app\models\Inventory;
use app\models\Drugs;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Inventories';
$this->params['breadcrumbs'][] = $this->title;
//$inv=new Inventory;
//$drug=$inv->getDrug($model->id);
//$name="not set";
//if($drug){
//	$name=$drug->name;
//}

?>
<div class="inventory-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Add New Inventory', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Run Inventory Analysis', ['run'], ['class' => 'btn btn-primary']) ?>
		</p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
			[
            'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
            'label' => 'Drug name',
            'value' => function ($data) {
               return Drugs::getName($data->did);
            },
         ],
			//'name',
            'amount',
            'created',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
