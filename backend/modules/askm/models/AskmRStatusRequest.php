<?php

namespace backend\modules\askm\models;

use Yii;

/**
 * This is the model class for table "askm_r_status_request".
 *
 * @property integer $status_request_id
 * @property string $status_request
 *
 * @property AskmIzinBermalam[] $askmIzinBermalams
 * @property AskmIzinKeluar[] $askmIzinKeluars
 * @property AskmIzinPenggunaanRuangan[] $askmIzinPenggunaanRuangans
 * @property AskmIzinTambahanJamKolaboratif[] $askmIzinTambahanJamKolaboratifs
 */
class AskmRStatusRequest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'askm_r_status_request';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status_request_id', 'status_request'], 'required'],
            [['status_request_id'], 'integer'],
            [['status_request'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'status_request_id' => 'Status Request ID',
            'status_request' => 'Status Request',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAskmIzinBermalams()
    {
        return $this->hasMany(AskmIzinBermalam::className(), ['status_request_id' => 'status_request_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAskmIzinKeluars()
    {
        return $this->hasMany(AskmIzinKeluar::className(), ['status_request_id' => 'status_request_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAskmIzinPenggunaanRuangans()
    {
        return $this->hasMany(AskmIzinPenggunaanRuangan::className(), ['status_request_id' => 'status_request_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAskmIzinTambahanJamKolaboratifs()
    {
        return $this->hasMany(AskmIzinTambahanJamKolaboratif::className(), ['status_request_id' => 'status_request_id']);
    }
}
