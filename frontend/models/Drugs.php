<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "drugs".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $interaction
 * @property string $status
 * @property string $created
 */
class Drugs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'drugs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'interaction', 'status'], 'required'],
            [['description', 'interaction', 'status'], 'string'],
            [['created'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'interaction' => 'Interaction',
            'status' => 'Status',
            'created' => 'Created',
        ];
    }
}
