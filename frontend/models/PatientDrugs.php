<?php

namespace app\models;

use Yii;


/**
 * This is the model class for table "patient_drugs".
 *
 * @property integer $pid
 * @property string $created
 * @property integer $amount
 * @property integer $did
 * @property integer $id
 */
class PatientDrugs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'patient_drugs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'amount', 'did'], 'integer'],
            [['created'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pid' => 'Pid',
            'created' => 'Created',
            'amount' => 'Amount',
            'did' => 'Did',
            'id' => 'ID',
        ];
    }

	public function otc($pid,$did,$amount,$location,$description,$disease){
		$p=new PatientDrugs;
		$h=new PatientHistory;
		$connection = \Yii::$app->getDb();
		$command = $connection->createCommand("SELECT * FROM inventory WHERE did='{$did}' LIMIT 1");
        $res=$command->queryAll();	
		$count=count($res);
		$bal=0;		
		if($count > 0){//we have stock
			if($res[0]['amount'] > $amount){
			$bal=$res[0]['amount']-$amount;			
            $command2 = $connection->createCommand("UPDATE inventory SET amount='{$bal}' WHERE did='{$did}'");
            $command2->query();		
            $p->amount=$amount;
			$p->did=$did;
			$p->pid=$pid;			
			$p->save();
			$h->pid=$pid;
			$h->description=$description;
			$h->did=$did;
			$h->diseases=$disease;
			$h->location=$location;
			$h->amount=$amount;
			$h->save();
			return $bal;
		}else{
			return "-1";
		}
		}else{//we dont have stock
		return "0";	
		}
		
	}
	}
