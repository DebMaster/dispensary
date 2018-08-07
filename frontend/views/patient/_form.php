<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Locations;


/* @var $this yii\web\View */
/* @var $model app\models\Patient */
/* @var $form yii\widgets\ActiveForm */
$locations=Locations::find()->all();
$locationsArray=ArrayHelper::map($locations,'id','name');
$genders=["Male"=>"Male","Female"=>"Female"];
?>

<div class="patient-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'age')->textInput() ?>

<?php echo $form->field($model, 'gender')->dropDownList($genders,['prompt'=>'Select Gender']); ?>
<?php //echo $form->field($model, 'location')->dropDownList($locationsArray,['prompt'=>'Select Location']); ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
