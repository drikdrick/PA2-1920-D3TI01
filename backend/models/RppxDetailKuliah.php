<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rppx_detail_kuliah".
 *
 * @property integer $load_detail_id
 * @property integer $kuliah_id
 * @property integer $penugasan_pengajaran_prodi_id
 * @property integer $pegawai_id
 * @property integer $kelas_riil
 * @property integer $kelas_tatap_muka
 * @property integer $kelas_praktikum
 * @property integer $deleted
 * @property string $deleted_at
 * @property string $deleted_by
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 * @property integer $sks_teori
 * @property integer $sks_praktikum
 *
 * @property KrkmKuliah $kuliah
 * @property HrdxPegawai $pegawai
 * @property RppxProdi $penugasanPengajaranProdi
 * @property RppxPengajuanPengajaran[] $rppxPengajuanPengajarans
 */
class RppxDetailKuliah extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rppx_detail_kuliah';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kuliah_id', 'penugasan_pengajaran_prodi_id', 'pegawai_id', 'kelas_riil', 'kelas_tatap_muka', 'kelas_praktikum', 'deleted', 'sks_teori', 'sks_praktikum'], 'integer'],
            [['deleted_at', 'created_at', 'updated_at'], 'safe'],
            [['deleted_by', 'created_by', 'updated_by'], 'string', 'max' => 32],
            [['kuliah_id'], 'exist', 'skipOnError' => true, 'targetClass' => KrkmKuliah::className(), 'targetAttribute' => ['kuliah_id' => 'kuliah_id']],
            [['pegawai_id'], 'exist', 'skipOnError' => true, 'targetClass' => HrdxPegawai::className(), 'targetAttribute' => ['pegawai_id' => 'pegawai_id']],
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'load_detail_id' => 'Load Detail ID',
            'kuliah_id' => 'Kuliah ID',
            'penugasan_pengajaran_prodi_id' => 'Penugasan Pengajaran Prodi ID',
            'pegawai_id' => 'Pegawai ID',
            'kelas_riil' => 'Kelas Riil',
            'kelas_tatap_muka' => 'Kelas Tatap Muka',
            'kelas_praktikum' => 'Kelas Praktikum',
            'deleted' => 'Deleted',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'sks_teori' => 'Sks Teori',
            'sks_praktikum' => 'Sks Praktikum',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKuliah()
    {
        return $this->hasOne(KrkmKuliah::className(), ['kuliah_id' => 'kuliah_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPegawai()
    {
        return $this->hasOne(HrdxPegawai::className(), ['pegawai_id' => 'pegawai_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRppxPengajuanPengajarans()
    {
        return $this->hasMany(RppxPengajuanPengajaran::className(), ['load_detail_id' => 'load_detail_id']);
    }
}
