<?php

namespace backend\modules\baak\models;

use Yii;

use common\behaviors\TimestampBehavior;
use common\behaviors\BlameableBehavior;
use common\behaviors\DeleteBehavior;

/**
 * This is the model class for table "baak_surat_pengantar_proyek".
 *
 * @property integer $baak_surat_proyek_mata_kuliah
 * @property integer $nomor_surat
 * @property string $nomor_surat_lengkap
 * @property string $perihal_surat
 * @property string $alamat_tujuan
 * @property string $banyak_lampiran
 * @property integer $kuliah_id
 * @property string $salam_pembuka
 * @property string $tanggal_surat
 * @property integer $pemohon_id
 * @property integer $pegawai_id
 * @property integer $status_pengajuan_id
 * @property string $waktu_pengambilan
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 * @property integer $deleted
 * @property string $deleted_at
 * @property string $deleted_by
 *
 * @property BaakDimHasSuratPengantarProyek[] $baakDimHasSuratPengantarProyeks
 * @property DimxDim $pemohon
 * @property HrdxPegawai $pegawai
 * @property BaakRStatusPengajuan $statusPengajuan
 * @property KrkmKuliah $kuliah
 */
class SuratPengantarProyek extends \yii\db\ActiveRecord
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
        return 'baak_surat_pengantar_proyek';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nomor_surat', 'kuliah_id', 'pemohon_id', 'pegawai_id', 'status_pengajuan_id', 'deleted'], 'integer'],
            [['perihal_surat', 'alamat_tujuan', 'salam_pembuka'], 'string'],
            [['alamat_tujuan'], 'required'],
            [['dims', 'nim', 'jk', 'tanggal_surat', 'waktu_pengambilan', 'created_at', 'updated_at', 'deleted_at', 'alasan_penolakan', ], 'safe'],
            [['nomor_surat_lengkap'], 'string', 'max' => 45],
            [['banyak_lampiran'], 'string', 'max' => 45],
            [['created_by', 'updated_by', 'deleted_by'], 'string', 'max' => 32],
            [['pemohon_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dim::className(), 'targetAttribute' => ['pemohon_id' => 'dim_id']],
            [['pegawai_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pegawai::className(), 'targetAttribute' => ['pegawai_id' => 'pegawai_id']],
            [['status_pengajuan_id'], 'exist', 'skipOnError' => true, 'targetClass' => StatusPengajuan::className(), 'targetAttribute' => ['status_pengajuan_id' => 'status_pengajuan_id']],
            [['kuliah_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kuliah::className(), 'targetAttribute' => ['kuliah_id' => 'kuliah_id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'dims' => 'Daftar Mahasiswa',
            'surat_pengantar_proyek_id' => 'Baak Surat Proyek Mata Kuliah',
            'nomor_surat' => 'Nomor Surat',
            'nomor_surat_lengkap' => 'Nomor Surat Lengkap',
            'perihal_surat' => 'Perihal Surat',
            'alamat_tujuan' => 'Nama Tempat',
            'banyak_lampiran' => 'Banyak Lampiran',
            'kuliah_id' => 'Kuliah ID',
            'salam_pembuka' => 'Salam Pembuka',
            'tanggal_surat' => 'Tanggal Surat',
            'pemohon_id' => 'Pemohon',
            'pegawai_id' => 'Pegawai ID',
            'status_pengajuan_id' => 'Status Pengajuan ID',
            'alasan_penolakan' => 'Alasan Penolakan',
            'waktu_pengambilan' => 'Waktu Pengambilan',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'deleted' => 'Deleted',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDimHasSuratPengantarProyek()
    {
        return $this->hasMany(DimHasSuratPengantarProyek::className(), ['surat_pengantar_proyek_id' => 'surat_pengantar_proyek_id']);
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
    public function getKuliah()
    {
        return $this->hasOne(Kuliah::className(), ['kuliah_id' => 'kuliah_id']);
    }
}
