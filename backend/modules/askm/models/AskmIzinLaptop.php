<?php

namespace backend\modules\askm\models;

use Yii;

/**
 * This is the model class for table "askm_izin_laptop".
 *
 * @property integer $izin_laptop_id
 * @property string $status_laptop
 *
 * @property AskmIzinBermalam[] $askmIzinBermalams
 */
class AskmIzinLaptop extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'askm_izin_laptop';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status_laptop'], 'required'],
            [['status_laptop'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'izin_laptop_id' => 'Izin Laptop ID',
            'status_laptop' => 'Status Laptop',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAskmIzinBermalams()
    {
        return $this->hasMany(AskmIzinBermalam::className(), ['izin_laptop_id' => 'izin_laptop_id']);
    }
}
