<?php
use app\models\Inventory;
use app\models\Patient;
use app\models\Drugs;
use app\models\Locations;
use yii\helpers\Url;
/* @var $this yii\web\View */
$this->title = 'Drug Analysis System';
$locations=Locations::find()->all();
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Dispensary</h1>
        <p class="lead">Dispatch Medicine.</p>
    </div>

    <div class="body-content">

        <div class="row">
                <form action="<?=Url::to(["site/otc"]); ?>" method="post">
				<?php
				if(isset($_REQUEST['status'])){
					echo "<h3>".$_REQUEST['status']."</h3>";
				}
				?>
		<div class="col-lg-8 col-lg-offset-2">
        <label>Patient</label>
		<select name="patient" class="form-control">
		<?php
		$patient=Patient::find()->limit(2000,2000)->orderBy('id DESC')->all();
		$c=count($patient);
for($x=0;$x<$c;$x++){
				echo "<option value='".$patient[$x]['id']."'>".$patient[$x]['name']."</option>";
}		
		?>
		</select>
        <label>Location</label>
		<select name="location" class="form-control">
		<?php
		$l=count($locations);
for($v=0;$v<$l;$v++){
				echo "<option value='".$locations[$v]['id']."'>".$locations[$v]['name']."</option>";
}		
		?>
		</select>
		
		<label>Drug</label>
		<select name="drug" class="form-control">
		<?php
		$drug=Drugs::find()->all();
		$d=count($drug);
for($y=0;$y<$d;$y++){
				echo "<option value='".$drug[$y]['id']."'>".$drug[$y]['name']."</option>";
}		
		?>
		</select>		
				<label>Disease</label>
		<input type="text" class="form-control" name="disease">	

		<label>Description of Illness</label>
		<textarea name="description" class="form-control"></textarea>
		<label>Amount</label>
		<input type="number" class="form-control" name="amount">	
<input type="submit" class="btn btn-sm btn-success" value="Process"/>		
                 </div>
        <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
				 </form>
           
        </div>

    </div>
</div>
