<?php
use app\models\Patient;
use app\models\Drugs;
use app\models\Staff;
use app\models\Locations;
?>
		<div class="four-grids">
					<div class="col-md-3 four-grid">
						<div class="four-agileits">
							<div class="icon">
								<i class="glyphicon glyphicon-user" aria-hidden="true"></i>
							</div>
							<div class="four-text">
								<h3>Patients</h3>
								<h4> 
								<?php
echo count(Patient::find()->all());

?>								</h4>
								
							</div>
							
						</div>
					</div>
					<div class="col-md-3 four-grid">
						<div class="four-agileinfo">
							<div class="icon">
								<i class="glyphicon glyphicon-list-alt" aria-hidden="true"></i>
							</div>
							<div class="four-text">
								<h3>Drugs</h3>
								<h4><?php
echo count(Drugs::find()->all());

?></h4>

							</div>
							
						</div>
					</div>
					<div class="col-md-3 four-grid">
						<div class="four-w3ls">
							<div class="icon">
								<i class="glyphicon glyphicon-folder-open" aria-hidden="true"></i>
							</div>
							<div class="four-text">
								<h3>Locations</h3>
								<h4><?php
echo count(Locations::find()->all());

?></h4>
								
							</div>
							
						</div>
					</div>
					<div class="col-md-3 four-grid">
						<div class="four-wthree">
							<div class="icon">
								<i class="glyphicon glyphicon-briefcase" aria-hidden="true"></i>
							</div>
							<div class="four-text">
								<h3>Staff</h3>
								<h4><?php
echo count(Staff::find()->all());

?></h4>
								
							</div>
							
						</div>
					</div>
					<div class="clearfix"></div>
				</div>