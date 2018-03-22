<?php

namespace backend\modules\askm\models;

use Yii;

/**
 * This is the model class for table "ubux_data_paket".
 *
 * @property integer $data_paket_id
 * @property string $tanggal_kedatangan
 * @property string $desc
 * @property string $penerima
 * @property string $pengirim
 * @property string $diambil_oleh
 * @property string $tanggal_diambil
 * @property integer $pegawai_id
 *
 * @property HrdxPegawai $pegawai
 */
class DataPaket extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ubux_data_paket';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tanggal_kedatangan', 'penerima', 'pengirim', 'pegawai_id'], 'required'],
            [['data_paket_id', 'pegawai_id'], 'integer'],
            [['tanggal_kedatangan', 'tanggal_diambil'], 'safe'],
            [['desc'], 'string'],
            [['penerima', 'pengirim', 'diambil_oleh'], 'string', 'max' => 45],
            [['pegawai_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pegawai::className(), 'targetAttribute' => ['pegawai_id' => 'pegawai_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'data_paket_id' => 'Data Paket ID',
            'tanggal_kedatangan' => 'Tanggal Kedatangan',
            'desc' => 'Deskripsi',
            'penerima' => 'Penerima',
            'pengirim' => 'Pengirim',
            'diambil_oleh' => 'Diambil Oleh',
            'tanggal_diambil' => 'Tanggal Diambil',
            'pegawai_id' => 'Petugas',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPegawai()
    {
        return $this->hasOne(Pegawai::className(), ['pegawai_id' => 'pegawai_id']);
    }
}
