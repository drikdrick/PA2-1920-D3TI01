<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rppx_load_pengajaran".
 *
 * @property integer $load_pengajaran_id
 * @property integer $pengajaran_id
 * @property integer $pegawai_id
 * @property double $load
 * @property integer $deleted
 * @property string $deleted_at
 * @property string $deleted_by
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 *
 * @property AdakPengajaran $pengajaran
 * @property RppxPeriodePengajaran $pengajaran0
 */
class RppxLoadPengajaran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rppx_load_pengajaran';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengajaran_id', 'pegawai_id', 'deleted'], 'integer'],
            [['load'], 'number'],
            [['deleted_at', 'created_at', 'updated_at'], 'safe'],
            [['deleted_by', 'created_by', 'updated_by'], 'string', 'max' => 32],
            [['pengajaran_id'], 'exist', 'skipOnError' => true, 'targetClass' => AdakPengajaran::className(), 'targetAttribute' => ['pengajaran_id' => 'pengajaran_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'load_pengajaran_id' => 'Load Pengajaran ID',
            'pengajaran_id' => 'Pengajaran ID',
            'pegawai_id' => 'Pegawai ID',
            'load' => 'Load',
            'deleted' => 'Deleted',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPengajaran()
    {
        return $this->hasOne(AdakPengajaran::className(), ['pengajaran_id' => 'pengajaran_id']);
    }
}
