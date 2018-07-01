<?php

namespace backend\modules\baak\models;

use Yii;

use common\behaviors\TimestampBehavior;
use common\behaviors\BlameableBehavior;
use common\behaviors\DeleteBehavior;

/**
 * This is the model class for table "baak_surat_lomba".
 *
 * @property integer $surat_id
 * @property string $nomor_surat
 * @property string $perihal
 * @property string $banyak_lampiran
 * @property string $tanggal_surat
 * @property string $nama_lomba
 * @property integer $pengaju
 * @property integer $deleted
 * @property string $deleted_at
 * @property string $deleted_by
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 * @property integer $hrdx_pegawai_pegawai_id
 * @property integer $status
 * @property string $waktu_pengambilan
 *
 * @property HrdxPegawai $hrdxPegawaiPegawai
 * @property BaakRStatusPengajuan $status0
 * @property DimxDim $pengaju0
 * @property DimxDimHasBaakSuratLomba[] $dimxDimHasBaakSuratLombas
 * @property DimxDim[] $dimxDimDims
 */
class SuratLomba extends \yii\db\ActiveRecord
{
    public $dims;

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
        return 'baak_surat_lomba';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dims', 'tanggal_surat', 'deleted_at', 'created_at', 'updated_at', 'waktu_pengambilan', 'nomor_surat_lengkap', 'alamat_tujuan', 'salam_pembuka'], 'safe'],
            [['pemohon_id', 'deleted', 'pegawai_id', 'status_pengajuan_id', 'nomor_surat'], 'integer'],
            [['banyak_lampiran', 'nama_lomba', 'nomor_surat_lengkap'], 'string', 'max' => 45],
            [['perihal', 'alamat_tujuan', 'salam_pembuka'], 'string'],
            [['deleted_by', 'created_by', 'updated_by'], 'string', 'max' => 32],
            [['pegawai_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pegawai::className(), 'targetAttribute' => ['pegawai_id' => 'pegawai_id']],
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
            'salam_pembuka' => 'Salam Pembuka',
            'surat_lomba_id' => 'Id Surat',
            'nomor_surat' => 'Nomor Surat',
            'nomor_surat_lengkap' => 'Detail Nomor Surat',
            'perihal' => 'Perihal',
            'alamat_tujuan' => 'Alamat Tujuan Surat',
            'banyak_lampiran' => 'Banyak Lampiran',
            'tanggal_surat' => 'Tanggal Surat',
            'nama_lomba' => 'Nama Kompetisi',
            'pemohon_id' => 'Pemohon',
            'deleted' => 'Deleted',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'pegawai_id' => 'Hrdx Pegawai Pegawai ID',
            'status_pengajuan_id' => 'Status',
            'waktu_pengambilan' => 'Waktu Pengambilan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPegawai()
    {
        return $this->hasOne(Pegawai::className(), ['pegawai_id' => 'pegawai_id']);
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDimHasSuratLomba()
    {
        return $this->hasMany(DimHasSuratLomba::className(), ['surat_lomba_id' => 'surat_lomba_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDim()
    {
        return $this->hasMany(Dim::className(), ['dim_id' => 'dim_id'])->viaTable('baak_dim_has_surat_lomba', ['surat_lomba_id' => 'surat_lomba_id']);
    }
}
