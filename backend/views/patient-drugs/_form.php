<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PatientDrugs */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patient-drugs-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'did')->textInput() ?>

    <?= $form->field($model, 'pid')->textInput() ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
