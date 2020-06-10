<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rppx_request_dosen".
 *
 * @property integer $id_request
 * @property integer $pengajar_id
 * @property string $kode_mk
 * @property integer $id_pemohon
 * @property integer $status_request
 *
 * @property HrdxPengajar $pengajar
 * @property HrdxPegawai $idPemohon
 */
class RppxRequestDosen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rppx_request_dosen';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengajar_id', 'kode_mk', 'id_pemohon', 'status_request'], 'required'],
            [['pengajar_id', 'id_pemohon', 'status_request'], 'integer'],
            [['kode_mk'], 'string', 'max' => 11],
            [['pengajar_id'], 'exist', 'skipOnError' => true, 'targetClass' => HrdxPengajar::className(), 'targetAttribute' => ['pengajar_id' => 'pengajar_id']],
            [['id_pemohon'], 'exist', 'skipOnError' => true, 'targetClass' => HrdxPegawai::className(), 'targetAttribute' => ['id_pemohon' => 'pegawai_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_request' => 'Id Request',
            'pengajar_id' => 'Pengajar ID',
            'kode_mk' => 'Kode Mk',
            'id_pemohon' => 'Id Pemohon',
            'status_request' => 'Status Request',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPengajar()
    {
        return $this->hasOne(HrdxPengajar::className(), ['pengajar_id' => 'pengajar_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPemohon()
    {
        return $this->hasOne(HrdxPegawai::className(), ['pegawai_id' => 'id_pemohon']);
    }
}
