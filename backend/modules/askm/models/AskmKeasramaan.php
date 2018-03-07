<?php

namespace backend\modules\askm\models;

use Yii;
use backend\modules\hrdx\models\HrdxPegawai;

/**
 * This is the model class for table "askm_keasramaan".
 *
 * @property integer $keasramaan_id
 * @property string $aktif_start
 * @property string $aktif_end
 * @property integer $pegawai_id
 *
 * @property AskmIzinBermalam[] $askmIzinBermalams
 * @property AskmIzinKeluar[] $askmIzinKeluars
 * @property HrdxPegawai $pegawai
 */
class AskmKeasramaan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'askm_keasramaan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['aktif_start', 'aktif_end'], 'safe'],
            [['pegawai_id'], 'required'],
            [['pegawai_id'], 'integer'],
            [['pegawai_id'], 'exist', 'skipOnError' => true, 'targetClass' => HrdxPegawai::className(), 'targetAttribute' => ['pegawai_id' => 'pegawai_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'keasramaan_id' => 'Keasramaan ID',
            'aktif_start' => 'Aktif Start',
            'aktif_end' => 'Aktif End',
            'pegawai_id' => 'Pegawai ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAskmIzinBermalams()
    {
        return $this->hasMany(AskmIzinBermalam::className(), ['keasramaan_id' => 'keasramaan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAskmIzinKeluars()
    {
        return $this->hasMany(AskmIzinKeluar::className(), ['keasramaan_id' => 'keasramaan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPegawai()
    {
        return $this->hasOne(HrdxPegawai::className(), ['pegawai_id' => 'pegawai_id']);
    }
}
