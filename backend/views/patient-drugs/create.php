<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PatientDrugs */

$this->title = 'Create Patient Drugs';
$this->params['breadcrumbs'][] = ['label' => 'Patient Drugs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-drugs-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
