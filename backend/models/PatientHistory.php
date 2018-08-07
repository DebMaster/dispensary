<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "patient_history".
 *
 * @property integer $id
 * @property integer $pid
 * @property string $description
 * @property string $created
 * @property integer $did
 * @property string $location
 * @property integer $amount
 * @property string $diseases
 */
class PatientHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'patient_history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'description', 'did', 'location', 'amount', 'diseases'], 'required'],
            [['pid', 'did', 'amount'], 'integer'],
            [['description'], 'string'],
            [['created'], 'safe'],
            [['location', 'diseases'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pid' => 'Pid',
            'description' => 'Description',
            'created' => 'Created',
            'did' => 'Did',
            'location' => 'Location',
            'amount' => 'Amount',
            'diseases' => 'Diseases',
        ];
    }
public function getDiseaseAgeData($disease){	
		$connection = \Yii::$app->getDb();
		$command = $connection->createCommand("SELECT 
	 count(CASE WHEN patient.age BETWEEN 0 AND 18 THEN 1 END) as count0_18,
     count(CASE WHEN patient.age BETWEEN 19 AND 30 THEN 1 END) as count19_30,
     count(CASE WHEN patient.age BETWEEN 31 AND 40 THEN 1 END) as count31_40,
	 count(CASE WHEN patient.age BETWEEN 41 AND 50 THEN 1 END) as count41_50,
	 count(CASE WHEN patient.age BETWEEN 51 AND 60 THEN 1 END) as count51_60,
	 count(CASE WHEN patient.age BETWEEN 61 AND 70 THEN 1 END) as count61_70,
	 count(CASE WHEN patient.age BETWEEN 71 AND 120 THEN 1 END) as count71_100 
	 FROM patient,patient_history WHERE patient_history.pid=patient.id AND patient_history.diseases='{$disease}'");
        $res=$command->queryAll();		
		return $res;
}

public function getDiseaseLocationData($disease){	
		$connection = \Yii::$app->getDb();
		$command = $connection->createCommand("SELECT locations.name,COUNT(patient_history.location) AS cl FROM locations,patient_history WHERE locations.id=patient_history.location AND patient_history.diseases='{$disease}' GROUP BY locations.name");
        $res=$command->queryAll();		
		return $res;
}
public function getDiseasePatientData($disease){	
		$connection = \Yii::$app->getDb();
		$command = $connection->createCommand("SELECT patient.*,patient_history.* FROM patient,patient_history WHERE patient.id=patient_history.pid AND patient_history.diseases='{$disease}'");
        $res=$command->queryAll();		
		return $res;
}	
	}
