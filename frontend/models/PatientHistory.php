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
}
