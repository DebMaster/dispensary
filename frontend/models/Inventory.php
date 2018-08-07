<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inventory".
 *
 * @property string $id
 * @property integer $did
 * @property integer $amount
 * @property string $created
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
            [['did', 'amount'], 'integer'],
            [['created'], 'string', 'max' => 255],
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
            'amount' => 'Amount',
            'created' => 'Created',
        ];
    }
}
