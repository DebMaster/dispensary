<?php

namespace app\models;
use app\models\Staff;
use Yii;

/**
 * This is the model class for table "inventory".
 *
 * @property integer $id
 * @property integer $did
 * @property integer $amount
 * @property integer $created
 */
class Inventory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inventory';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['did', 'amount'], 'required'],
            [['did', 'amount'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'did' => 'Drug',
            'amount' => 'Amount',
            'created' => 'Created',
        ];
    }
	public function getInventory(){
		$connection = \Yii::$app->getDb();
$command = $connection->createCommand("SELECT inventory.*,drugs.name FROM inventory,drugs WHERE inventory.did=drugs.id");
return $command->queryAll();	
/*return	$rows = (new \yii\db\Query())
    ->select(['inventory.*', 'drugs.name'])
    ->from('inventory,drugs')
    ->where(['drugs.id' => 'inventory.id'])
    ->all();*/
	
	}
public function getDepletedInventory(){
$connection = \Yii::$app->getDb();
$command = $connection->createCommand("SELECT inventory.*,drugs.name FROM inventory,drugs WHERE inventory.did=drugs.id AND inventory.amount <= 50");
return $command->queryAll();		
}

public function sendNotifications(){
	$inventory=$this->getDepletedInventory();
	$count=count($inventory);
	$message="The following inventory items are near depletion.<br>";
	for($x=0;$x<$count;$x++){
		$message .=$inventory[$x]['name']." - ".$inventory[$x]['amount']." items.<br>"; 		
	}
if($count > 0){
$staff=Staff::find()->all();
$c=Staff::find()->count();
foreach($staff AS $s){
$email=$s->email;
error_reporting(E_ALL);
ini_set('display_errors', 1);
$url="http://afrodeb.com/milly.php?msg=".urlencode($message)."&from=".urlencode("kudzai@hit.ac.zw")."&to=".urlencode($email);
$curl=curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.2 (KHTML, like Gecko) Chrome/22.0.1216.0 Safari/537.2");
$rizo=curl_exec($curl);
//curl_close($curl);

//-------------------SEND SMS NOW-----------------------
$theMessage=urlencode("Good day,".$s->name.". Please review your inventory. There are some products which are below reorder levels.");
$thePhone=urlencode($s->phone);
$cSession = curl_init(); 
curl_setopt($cSession,CURLOPT_URL,"http://www.bluedotsms.com/api/mt/SendSMS?user=afrodeb&password=gabby%26kudaPrezha1&senderid=KUKU&channel=Normal&DCS=0&flashsms=0&number=".$thePhone."&text=".$theMessage);
curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
curl_setopt($cSession,CURLOPT_HEADER, false); 
$result=curl_exec($cSession);
}
//curl_close($cSession);
//echo $rizo;
}	
}
public function getDrug($id){
return $staff=Drugs::find()->where(['id'=>$id])->one();	
}
public function getOrders($id){
$connection = \Yii::$app->getDb();
//$command = $connection->createCommand("SELECT inventory.*,drugs.name FROM inventory,drugs WHERE inventory.did=drugs.id AND inventory.id='{$id}'");
$command = $connection->createCommand("
SELECT     
     count(CASE WHEN patient.age BETWEEN 0 AND 18 THEN 1 END) as count0_18,
     count(CASE WHEN patient.age BETWEEN 19 AND 30 THEN 1 END) as count19_30,
     count(CASE WHEN patient.age BETWEEN 31 AND 40 THEN 1 END) as count31_40,
	 count(CASE WHEN patient.age BETWEEN 41 AND 50 THEN 1 END) as count41_50,
	 count(CASE WHEN patient.age BETWEEN 51 AND 60 THEN 1 END) as count51_60,
	 count(CASE WHEN patient.age BETWEEN 61 AND 70 THEN 1 END) as count61_70,
	 count(CASE WHEN patient.age BETWEEN 71 AND 120 THEN 1 END) as count71_100
FROM 
patient_drugs,patient 
WHERE 
patient_drugs.pid=patient.id 
AND 
patient_drugs.did={$id}");
return $command->queryAll();		
}

public function getAges($id){
$connection = \Yii::$app->getDb();
$command = $connection->createCommand("SELECT      	 
	 patient.age
FROM 
patient_drugs,patient 
WHERE 
patient_drugs.pid=patient.id 
AND 
patient_drugs.did={$id}");
return $command->queryAll();		
}


public function getOrdersByGender($id){
$connection = \Yii::$app->getDb();
$command = $connection->createCommand("
SELECT      
	 COUNT(patient.id) AS c,
	 patient.gender
FROM 
patient_drugs,patient 
WHERE 
patient_drugs.pid=patient.id 
AND 
patient_drugs.did={$id}
GROUP BY gender
");
return $command->queryAll();		
}
function getAverageTime(array $times)
{
    $seconds = $average = 0;
    $result = null;
    //get seconds after midnight
    foreach($times as $dateString){
        $date = new \DateTime($dateString);
        list($datePart) = explode(' ', $dateString);
        $midnight = new \DateTime($datePart);
        $seconds += $date->getTimestamp() - $midnight->getTimestamp();
    }

    if($seconds > 0){
        $average = $seconds/count($times);
        $hours = floor($average/3600);
        $average -= ($hours * 3600);
        $minutes = floor($average/60);
        $average -= ($minutes * 60);
        $result = $hours." hours and ".$minutes." minutes.";
		//$result = new \DateInterval("PT{$hours}H{$minutes}M{$average}S");
    } else $result = new \DateInterval('PT0S');
    //return $result->format("%Hh %Mm %Ss");
	return $result;
}

public function getSold($bought){
	return mt_rand($bought,($bought+$bought*0.3));	
}
public function changeDate($date){
	$date=date_create($date);
    return date_format($date,"d-m-Y");
}

public function keepProduct($drug,$location,$sold_on,$quantity_purchased,$quantity_sold){
$myfile = fopen("r/new-test2.csv", "w") or die("Unable to open file!");
$txt = "drug,location,sold_on,quantity_purchased,quantity_sold,keep\n".$drug." ,".$location.",".$sold_on.",".$quantity_purchased.",".$quantity_sold."\n";
fwrite($myfile, $txt);
fclose($myfile);
if(file_exists("r/new-test2.csv")){
	chdir('C:/Program Files/R/R-3.5.0/bin/');
	$output=shell_exec("Rscript C:\\xampp\\htdocs\\drugs\\backend\\web\\r\\final.R");
	$output=str_replace("Levels: No Yes","",$output);
	$output=str_replace("[1]","",$output);	
	$output=str_replace("1","",$output);
	print_r($output);
	}
}

}
