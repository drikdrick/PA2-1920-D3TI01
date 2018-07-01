<?php

namespace backend\modules\baak\models;

use Yii;

use common\behaviors\TimestampBehavior;
use common\behaviors\BlameableBehavior;
use common\behaviors\DeleteBehavior;

/**
 * This is the model class for table "baak_surat_magang".
 *
 * @property integer $id_surat
 * @property integer $hrdx_pegawai_pegawai_id
 * @property string $nomor_surat
 * @property string $perihal_surat
 * @property string $tanggal_surat
 * @property string $tujuan_magang
 * @property string $waktu_awal_magang
 * @property string $waktu_akhir_magang
 * @property integer $pengaju
 * @property integer $deleted
 * @property string $deleted_at
 * @property string $deleted_by
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 * @property integer $status
 * @property string $waktu_pengambilan
 *
 * @property HrdxPegawai $hrdxPegawaiPegawai
 * @property BaakRStatusPengajuan $status0
 * @property DimxDim $pengaju0
 * @property DimxDimHasBaakSuratMagang[] $dimxDimHasBaakSuratMagangs
 * @property DimxDim[] $dimxDimDims
 */
class SuratMagang extends \yii\db\ActiveRecord
{
    public $dims;
    public $nim;
    public $jk;

    /**
     * behaviour to add created_at and updatet_at field with current datetime (timestamp)
     * and created_by and updated_by field with current user id (blameable)
     */
    public function behaviors(){
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
            ],
            'delete' => [
                'class' => DeleteBehavior::className(),
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'baak_surat_magang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pemohon_id', 'deleted', 'status_pengajuan_id', 'nomor_surat'], 'integer'],
            [['dims', 'nim', 'jk', 'tanggal_surat', 'waktu_awal_magang', 'waktu_akhir_magang', 'deleted_at', 'created_at', 'updated_at', 'waktu_pengambilan', 'nama_perusahaan', 'alamat_perusahaan'], 'safe'],
            [['nomor_surat_lengkap', 'nama_perusahaan'], 'string', 'max' => 45],
            [['perihal_surat', 'alamat_perusahaan'], 'string'],
            [['deleted_by', 'created_by', 'updated_by'], 'string', 'max' => 32],
            [['status_pengajuan_id'], 'exist', 'skipOnError' => true, 'targetClass' => StatusPengajuan::className(), 'targetAttribute' => ['status_pengajuan_id' => 'status_pengajuan_id']],
            [['pemohon_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dim::className(), 'targetAttribute' => ['pemohon_id' => 'dim_id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'dims' => 'Daftar Mahasiswa',
            'surat_magang_id' => 'Id Surat',
            'nomor_surat' => 'Nomor Surat',
            'perihal_surat' => 'Perihal Surat',
            'tanggal_surat' => 'Tanggal Surat',
            'nama_perusahaan' => 'Nama Perusahaan',
            'alamat_perusahaan' => 'Alamat Perusahaan',
            'waktu_awal_magang' => 'Waktu Awal Magang',
            'waktu_akhir_magang' => 'Waktu Akhir Magang',
            'pemohon_id' => 'Pemohon',
            'deleted' => 'Deleted',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'status_pengajuan_id' => 'Status',
            'waktu_pengambilan' => 'Waktu Pengambilan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatusPengajuan()
    {
        return $this->hasOne(StatusPengajuan::className(), ['status_pengajuan_id' => 'status_pengajuan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPemohon()
    {
        return $this->hasOne(Dim::className(), ['dim_id' => 'pemohon_id']);
    }

    public function getPegawai()
    {
        return $this->hasOne(Pegawai::className(), ['pegawai_id' => 'pegawai_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDimHasSuratMagang()
    {
        return $this->hasMany(DimHasSuratMagang::className(), ['surat_magang_id' => 'surat_magang_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDim()
    {
        return $this->hasMany(Dim::className(), ['dim_id' => 'dim_id'])->viaTable('baak_dim_has_surat_magang', ['surat_magang_id' => 'surat_magang_id']);
    }
}
