<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "rppx_periode_pengajaran".
 *
 * @property integer $periode_pengajaran_id
 * @property integer $ta
 * @property integer $sem_ta_id
 * @property integer $deleted
 * @property string $deleted_at
 * @property string $deleted_by
 * @property string $updated_at
 * @property string $updated_by
 * @property string $created_at
 * @property string $created_by
 *
 * @property RppxLoadPengajaran[] $rppxLoadPengajarans
 * @property MrefRSemTa $semTa
 * @property RppxProdi[] $rppxProdis
 */
class RppxPeriodePengajaran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rppx_periode_pengajaran';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ta', 'sem_ta_id', 'deleted'], 'integer'],
            [['deleted_at', 'updated_at', 'created_at'], 'safe'],
            [['deleted_by', 'updated_by', 'created_by'], 'string', 'max' => 32],
            [['sem_ta_id'], 'exist', 'skipOnError' => true, 'targetClass' => MrefRSemTa::className(), 'targetAttribute' => ['sem_ta_id' => 'sem_ta_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'periode_pengajaran_id' => 'Periode Pengajaran ID',
            'ta' => 'Ta',
            'sem_ta_id' => 'Sem Ta ID',
            'deleted' => 'Deleted',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRppxLoadPengajarans()
    {
        return $this->hasMany(RppxLoadPengajaran::className(), ['pengajaran_id' => 'periode_pengajaran_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSemTa()
    {
        return $this->hasOne(MrefRSemTa::className(), ['sem_ta_id' => 'sem_ta_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRppxProdis()
    {
        return $this->hasMany(RppxProdi::className(), ['periode_pengajaran_id' => 'periode_pengajaran_id']);
    }
}
