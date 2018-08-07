<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Drugs;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Inventory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inventory-form">
<?php
$drugs=Drugs::find()->all();
$listData=ArrayHelper::map($drugs,'id','name');
?>
    <?php $form = ActiveForm::begin(); ?>

<?php
//= $form->field($model, 'did')->textInput()
echo $form->field($model, 'did')->dropDownList(
        $listData,
        ['prompt'=>'Select Drug']
        );
?>
    <?= $form->field($model, 'amount')->textInput() ?>

    <?php
	//= $form->field($model, 'created')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
