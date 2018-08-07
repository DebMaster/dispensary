<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "patient_drugs".
 *
 * @property integer $id
 * @property integer $did
 * @property integer $pid
 * @property string $created
 * @property integer $amount
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
            [['did', 'pid', 'amount'], 'required'],
            [['did', 'pid', 'amount'], 'integer'],
            [['created'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'did' => 'Did',
            'pid' => 'Pid',
            'created' => 'Created',
            'amount' => 'Amount',
        ];
    }
}
