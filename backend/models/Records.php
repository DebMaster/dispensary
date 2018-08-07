<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "records".
 *
 * @property integer $id
 * @property integer $pid
 * @property string $description
 * @property integer $staff_id
 * @property string $created
 * @property string $diagnosis
 */
class Records extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'records';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'description', 'staff_id', 'diagnosis'], 'required'],
            [['pid', 'staff_id'], 'integer'],
            [['description', 'diagnosis'], 'string'],
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
            'pid' => 'Pid',
            'description' => 'Description',
            'staff_id' => 'Staff ID',
            'created' => 'Created',
            'diagnosis' => 'Diagnosis',
        ];
    }
}
