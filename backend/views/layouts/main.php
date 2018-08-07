<?php
/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\helpers\Url;

AppAsset::register($this);
?>
<!DOCTYPE HTML>
<html lang="<?= Yii::$app->language ?>">
<head>
<title><?= Html::encode(Yii::$app->name." - ".$this->title) ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Pooled Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/morris.css" type="text/css"/>
<!-- Graph CSS -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<script src="js/jquery-2.1.4.min.js"></script>
<script src="js/Chart.bundle.min.js"></script>
	<script src="js/utils.js"></script>
<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<!-- lined-icons -->
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
<!-- //lined-icons -->
</head> 
<body>
   <div class="page-container">
   <!--/content-inner-->
<div class="left-content">
	   <div class="mother-grid-inner">
             <!--header start here-->
				<div class="header-main">
					<div class="logo-w6-agile">
								<h1><a href="<?= Yii::$app->homeUrl; ?>"><?= Yii::$app->name ?></a></h1>
							</div>
					
							
				     <div class="clearfix"> </div>	
				</div>
<!--heder end here-->
<?php
			if(Yii::$app->session['name'] != ""){
			?>
		<ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= Yii::$app->homeUrl; ?>">Home</a> <i class="fa fa-angle-right"></i></li>
            </ol>
			<?php
			}
			?>
<!--=======cONTENT----------->
        <?= Alert::widget() ?>
        <?= $content ?>
<!--cONTENT-->

		                   
                   
						<div class="clearfix"></div>
                   
	
	  <!--//w3-agileits-pane-->	
<!-- script-for sticky-nav -->
		<script>
		$(document).ready(function() {
			 var navoffeset=$(".header-main").offset().top;
			 $(window).scroll(function(){
				var scrollpos=$(window).scrollTop(); 
				if(scrollpos >=navoffeset){
					$(".header-main").addClass("fixed");
				}else{
					$(".header-main").removeClass("fixed");
				}
			 });
			 
		});
		</script>
		<!-- /script-for sticky-nav -->
<!--inner block start here-->
<div class="inner-block">

</div>
<!--inner block end here-->
<!--copy rights start here-->
<div class="copyrights">
	 <p>© <?= date("Y")." - ".Yii::$app->name; ?> All Rights Reserved | Design by  KuKu </p>
</div>	
<!--COPY rights end here-->
</div>
</div>
  <!--//content-inner-->
			<!--/sidebar-menu-->
			<?php
	//		if(Yii::$app->session['name'] != ""){
			?>
				<div class="sidebar-menu">
					<header class="logo1">
						<a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a> 
					</header>
						<div style="border-top:1px ridge rgba(255, 255, 255, 0.15)"></div>
                           <div class="menu">
									<ul id="menu" >
										<li><a href="<?= Url::to(['site/index']); ?>"><i class="fa fa-tachometer"></i> <span>Dashboard</span><div class="clearfix"></div></a></li>																				
									 <li id="menu-academico" ><a href="#"><i class="fa fa-list-ul" aria-hidden="true"></i><span>Drugs</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
										   <ul id="menu-academico-sub" >
										   <li id="menu-academico-avaliacoes" ><a href="<?= Url::to(['drugs/create']); ?>">New</a></li>
											<li id="menu-academico-avaliacoes" ><a href="<?= Url::to(['drugs/index']); ?>">View</a></li>
										  </ul>
										</li>
										   <li id="menu-academico" ><a href="#"><i class="fa fa-list-ul" aria-hidden="true"></i><span>Inventory</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
										   <ul id="menu-academico-sub" >
										   <li id="menu-academico-avaliacoes" ><a href="<?= Url::to(['inventory/create']); ?>">New</a></li>
											<li id="menu-academico-avaliacoes" ><a href="<?= Url::to(['inventory/index']); ?>">View</a></li>
											<!--<li id="menu-academico-avaliacoes" ><a href="<?= Url::to(['inventory/product-analysis']); ?>">Top Inventory Product</a></li>-->
											<li id="menu-academico-avaliacoes" ><a href="<?= Url::to(['inventory/age-analysis']); ?>">Age Analysis</a></li>
											<li id="menu-academico-avaliacoes" ><a href="<?= Url::to(['inventory/product-age-analysis']); ?>">Prouct-Patient Analysis</a></li>
										  </ul>
										</li>
										<li id="menu-academico" ><a href="#"><i class="fa fa-list-ul" aria-hidden="true"></i><span>Locations</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
										   <ul id="menu-academico-sub" >
										   <li id="menu-academico-avaliacoes" ><a href="<?= Url::to(['locations/create']); ?>">New</a></li>
											<li id="menu-academico-avaliacoes" ><a href="<?= Url::to(['locations/index']); ?>">View</a></li>
										  </ul>
										</li>
										<li id="menu-academico"><a href="#"><i class="fa fa-list-ul" aria-hidden="true"></i><span>Patients</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
										   <ul id="menu-academico-sub">
										   <li id="menu-academico-avaliacoes" ><a href="<?= Url::to(['patient/create']); ?>">New</a></li>
											<li id="menu-academico-avaliacoes" ><a href="<?= Url::to(['patient/index']); ?>">View</a></li>
											<li id="menu-academico-avaliacoes" ><a href="<?= Url::to(['patient/diseases']); ?>">Diseases</a></li>
										  </ul>
										</li>
										<li id="menu-academico" ><a href="#"><i class="fa fa-list-ul" aria-hidden="true"></i><span>Records</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
										   <ul id="menu-academico-sub" >
										   <li id="menu-academico-avaliacoes" ><a href="<?= Url::to(['records/create']); ?>">New</a></li>
											<li id="menu-academico-avaliacoes" ><a href="<?= Url::to(['records/index']); ?>">View</a></li>
										  </ul>
										</li>
										<li id="menu-academico" ><a href="#"><i class="fa fa-list-ul" aria-hidden="true"></i><span>Staff</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
										   <ul id="menu-academico-sub" >
										   <li id="menu-academico-avaliacoes" ><a href="<?= Url::to(['staff/create']); ?>">New</a></li>
											<li id="menu-academico-avaliacoes" ><a href="<?= Url::to(['staff/index']); ?>">View</a></li>
										  </ul>
										</li>
								  </ul>
								</div>
							  </div>
							  <?php
		// 	}
							  ?>
							  <div class="clearfix"></div>		
							</div>
<!--js -->
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.min.js"></script>
   <!-- /Bootstrap Core JavaScript -->	   
<!-- morris JavaScript -->	
<script src="js/raphael-min.js"></script>
<script src="js/morris.js"></script>
<script type="text/javascript">
var myVar = setInterval(function(){ myTimer() }, 3600000);//run every hour

function myTimer() {
 $.ajax({url: "http://localhost:8080/drugs/backend/web/index.php?r=inventory%2Frun2", success: function(result){
        console.log("ran");
    }});
} 
</script>
</body>
</html>