<?php

namespace backend\modules\askm\models;

use Yii;

/**
 * This is the model class for table "ubux_r_lokasi_log".
 *
 * @property integer $lokasi_log_id
 * @property string $name
 * @property string $desc
 * @property integer $deleted
 * @property string $deleted_at
 * @property string $created_by
 * @property string $created_at
 * @property string $updated_by
 * @property string $updated_at
 *
 * @property AskmIzinBermalam[] $askmIzinBermalams
 * @property AskmIzinKeluar[] $askmIzinKeluars
 * @property AskmLogMahasiswa[] $askmLogMahasiswas
 */
class LokasiLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ubux_r_lokasi_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['deleted'], 'integer'],
            [['deleted_at', 'created_at', 'updated_at'], 'safe'],
            [['name', 'desc', 'created_by', 'updated_by'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'lokasi_log_id' => 'Lokasi Log ID',
            'name' => 'Name',
            'desc' => 'Desc',
            'deleted' => 'Deleted',
            'deleted_at' => 'Deleted At',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAskmIzinBermalams()
    {
        return $this->hasMany(IzinBermalam::className(), ['lokasi_log_id' => 'lokasi_log_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAskmIzinKeluars()
    {
        return $this->hasMany(IzinKeluar::className(), ['lokasi_log_id' => 'lokasi_log_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAskmLogMahasiswas()
    {
        return $this->hasMany(LogMahasiswa::className(), ['lokasi_log_id' => 'lokasi_log_id']);
    }
}
