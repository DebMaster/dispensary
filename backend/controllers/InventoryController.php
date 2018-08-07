<?php

namespace backend\controllers;

use Yii;
use app\models\Inventory;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InventoryController implements the CRUD actions for Inventory model.
 */
class InventoryController extends Controller
{
    /**
     * @inheritdoc
     */
/*    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }*/

    /**
     * Lists all Inventory models.
     * @return mixed
     */
    public function actionIndex()
    {
		 $inv=new Inventory;
/*		         $dataProvider = new SqlDataProvider([
            //'query' => Inventory::find(),
			'query' => $inv->getInventory(),
        ]);*/

		$count = Yii::$app->db->createCommand('SELECT COUNT(*) FROM inventory')->queryScalar();

$provider = new SqlDataProvider([
    'sql' => 'SELECT inventory.*,drugs.name FROM inventory,drugs WHERE inventory.did=drugs.id',
    'totalCount' => $count,
    'pagination' => [
        'pageSize' => 10,
    ],
    'sort' => [
        'attributes' => [
            'id',
            'name',
            'created',
        ],
    ],
]);

		
$dataProvider = new ActiveDataProvider([
            'query' => Inventory::find(),
        ]);
		
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Inventory model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
		$model=new Inventory;
        return $this->render('view', [
            'model' => $this->findModel($id),
			'orders'=>$model->getOrders($id),
			'ages'=>$model->getAges($id),
        ]);
    }

	public function actionOrders($id){
		$model=new Inventory;
		print_r(json_encode($model->getOrders($id)));
	}
	public function actionGenders($id){
		$model=new Inventory;
		print_r(json_encode($model->getOrdersByGender($id)));
	}
	public function actionRun()
    {
        return $this->render('run');
    }

	public function actionRun2()
    {
		$inv=new Inventory;
    	$inv->sendNotifications();	
		$this->redirect(['run']);
//        return $this->render('run');
	}
	
    /**
     * Creates a new Inventory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Inventory();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Inventory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        } else {
var_dump($model->errors);
        }
		            return $this->render('update', [
                'model' => $model,
            ]);

    }

    /**
     * Deletes an existing Inventory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Inventory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Inventory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Inventory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	public function actionProductAnalysis(){
	return $this->render('product-analysis');	
	}
	public function actionAgeAnalysis(){
	return $this->render('age-analysis');	
	}
	public function actionProductAgeAnalysis(){
	return $this->render('patient-product-analysis');	
	}
	public function actionGetProductAnalysis(){
	$connection = Yii::$app->getDb();
    $command = $connection->createCommand("SELECT drugs.name,SUM(inventory.amount) AS amount FROM drugs,inventory WHERE drugs.id=inventory.did GROUP BY name ORDER BY amount DESC LIMIT 10");
    print_r(json_encode($command->queryAll()));				
	}
	public function actionGetAgeGroups(){
	$connection = Yii::$app->getDb();
    $command = $connection->createCommand("SELECT 
     count(CASE WHEN age BETWEEN 0 AND 18 THEN 1 END) as count0_18,
     count(CASE WHEN age BETWEEN 19 AND 30 THEN 1 END) as count19_30,
     count(CASE WHEN age BETWEEN 31 AND 40 THEN 1 END) as count31_40,
	 count(CASE WHEN age BETWEEN 41 AND 50 THEN 1 END) as count41_50,
	 count(CASE WHEN age BETWEEN 51 AND 60 THEN 1 END) as count51_60,
	 count(CASE WHEN age BETWEEN 61 AND 70 THEN 1 END) as count61_70,
	 count(CASE WHEN age BETWEEN 71 AND 120 THEN 1 END) as count71_100
from patient
    ");
    print_r(json_encode($command->queryAll()));				
	}
	public function actionGetPatientProductAnalysis(){
	$connection = Yii::$app->getDb();
    $command = $connection->createCommand("SELECT COUNT(patient.name) AS pcount,SUM(patient_drugs.amount) AS damount,drugs.*,patient_drugs.amount FROM patient,drugs,patient_drugs WHERE drugs.id=patient_drugs.did AND patient.id=patient_drugs.pid GROUP BY drugs.name ORDER BY damount DESC LIMIT 20");
    print_r(json_encode($command->queryAll()));				
	}
}
