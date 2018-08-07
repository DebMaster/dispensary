<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Inventory */

$this->params['breadcrumbs'][] = ['label' => 'Inventories', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Inventory Analysis";
?>
<div class="inventory-view">

    <h1>Run Inventory Analysis</h1>

    <p>
        <?= Html::a('Run', ['run2'], ['class' => 'btn btn-primary']) ?>
<br>
Results will be emailed to you. 
 </p>


</div>
