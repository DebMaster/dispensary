<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "patient".
 *
 * @property string $id
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $created
 * @property integer $age
 * @property string $location
 * @property string $gender
 */
class Patient extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'patient';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created'], 'safe'],
            [['age'], 'integer'],
            [['gender'], 'required'],
            [['name', 'email', 'location'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 100],
            [['gender'], 'string', 'max' => 20],
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
            'phone' => 'Phone',
            'email' => 'Email',
            'created' => 'Created',
            'age' => 'Age',
            'location' => 'Location',
            'gender' => 'Gender',
        ];
    }
}
