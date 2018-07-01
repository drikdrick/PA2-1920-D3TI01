<?php

namespace backend\modules\ubux\models;

use Yii;

use common\behaviors\TimestampBehavior;
use common\behaviors\BlameableBehavior;
use common\behaviors\DeleteBehavior;

/**
 * This is the model class for table "ubux_pemakaian_kendaraan".
 *
 * @property integer $pemakaian_kendaraan_id
 * @property integer $pemakaian_kendaraan_mhs_id
 * @property integer $pegawai_id
 * @property string $desc
 * @property string $tujuan
 * @property integer $jumlah_penumpang_kendaraan
 * @property string $rencana_waktu_keberangkatan
 * @property string $rencana_waktu_kembali
 * @property int $status_req_sekretaris_rektorat
 * @property string $status_request_kemahasiswaan
 * @property string $jenis_keperluan_id
 * @property string $no_telepon
 * @property string $proposal
 * @property integer $deleted
 * @property string $deleted_at
 * @property string $deleted_by
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 * @property integer $kendaraan_id
 * @property integer $supir_id
 * @property string $no_hp_supir
 * @property integer $status_request_kabiro_KSD
 * @property integer $status_request_hrd
 * @property integer $status_request_keuangan
 * @property integer $status_request_wr2
 * @property integer $laporan
 *
 * @property Supir $supir
 * @property Kendaraan $kendaraan
 * @property StatusRequest $statusRequestSekretarisRektorat
 * @property StatusRequest $statusRequestKemahasiswaan
 * @property StatusRequest $statusRequestKabiroKSD
 * @property StatusRequest $statusRequestHRD
 * @property StatusRequest $statusRequestKeuangan
 * @property StatusRequest $statusRequestWr2
 * @property JenisKeperluan $jenisKeperluan
 * @property Pegawai $pegawai
 */
class PemakaianKendaraan extends \yii\db\ActiveRecord
{
    public $file;
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
        return 'ubux_pemakaian_kendaraan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['desc', 'tujuan', 'rencana_waktu_keberangkatan', 'rencana_waktu_kembali', 'no_telepon'], 'required'],
            [['status_req_sekretaris_rektorat', 'status_request_kemahasiswaan', 'jumlah_penumpang_kendaraan', 'deleted', 'kendaraan_id', 'supir_id', 'pemakaian_kendaraan_mhs_id',  'status_request_kabiro_KSD', 'status_request_hrd', 'status_request_keuangan', 'status_request_wr2', 'jenis_keperluan_id', 'pegawai_id', 'laporan'], 'integer'],
            [['rencana_waktu_keberangkatan', 'rencana_waktu_kembali', 'deleted_at', 'created_at', 'updated_at'], 'safe'],
            [['file'], 'file'],
            [['no_hp_supir'], 'string', 'max' => 300],
            [['desc', 'tujuan'], 'string'],
            [['proposal'], 'string', 'max' => 100],
            [['no_telepon', 'deleted_by', 'created_by', 'updated_by'], 'string', 'max' => 32],
            [['no_hp_supir'], 'string', 'max' => 300],
            [['supir_id'], 'exist', 'skipOnError' => true, 'targetClass' => Supir::className(), 'targetAttribute' => ['supir_id' => 'supir_id']],
            [['kendaraan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kendaraan::className(), 'targetAttribute' => ['kendaraan_id' => 'kendaraan_id']],
            [['pegawai_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pegawai::className(), 'targetAttribute' => ['pegawai_id' => 'pegawai_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pemakaian_kendaraan_id' => 'Transaksi Kendaraan ID',
            'pegawai_id' => 'Pegawai ID',
            'desc' => 'Keperluan',
            'tujuan' => 'Tujuan',
            'jumlah_penumpang_kendaraan' => 'Jumlah Penumpang',
            'rencana_waktu_keberangkatan' => 'Waktu Keberangkatan',
            'rencana_waktu_kembali' => 'Waktu Tiba',
            'status_req_sekretaris_rektorat' => 'Status',
            'status_request_kemahasiswaan' => 'Status Persetujuan Kemahasiswaan',
            'no_telepon' => 'No Telepon',
            'jenis_keperluan_id' => 'Jenis Permintaan',
            'proposal' => 'Proposal',
            'deleted' => 'Deleted',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'kendaraan_id' => 'Jenis Mobil',
            'supir_id' => 'Supir',
            'no_hp_supir' => 'No  Hp  Supir',
            'file' => 'Proposal',
            'status_request_kabiro_KSD' => 'Status Persetujuan Kabiro Ksd',
           'status_request_hrd' => 'Status Persetujuan Hrd',
           'status_request_keuangan' => 'Status Persetujuan Keuangan',
           'status_request_wr2' => 'Status Persetujuan Wr2',
            'pemakaian_kendaraan_mhs_id' => 'Transaksi Kendaraan Mahasiswa ID',
            'laporan' => 'Laporan Pemakaian',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupir()
    {
        return $this->hasOne(Supir::className(), ['supir_id' => 'supir_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKendaraan()
    {
        return $this->hasOne(Kendaraan::className(), ['kendaraan_id' => 'kendaraan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatusRequestSekretarisRektorat()
    {
        return $this->hasOne(StatusRequest::className(), ['status_request_id' => 'status_req_sekretaris_rektorat']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatusRequestKemahasiswaan()
    {
        return $this->hasOne(StatusRequest::className(), ['status_request_id' => 'status_request_kemahasiswaan']);
    }

    public function getStatusRequestKabiroKSD()
    {
        return $this->hasOne(StatusRequest::className(), ['status_request_id' => 'status_request_kabiro_KSD']);
    }

    public function getStatusRequestHRD()
    {
        return $this->hasOne(StatusRequest::className(), ['status_request_id' => 'status_request_hrd']);
    }

    public function getStatusRequestKeuangan()
    {
        return $this->hasOne(StatusRequest::className(), ['status_request_id' => 'status_request_keuangan']);
    }

    public function getStatusRequestWr2()
    {
        return $this->hasOne(StatusRequest::className(), ['status_request_id' => 'status_request_wr2']);
    }

    public function getJenisKeperluan(){
        return $this->hasOne(JenisKeperluan::className(), ['jenis_keperluan_id' => 'jenis_keperluan_id']);
    }

    public function getPegawai(){
        return $this->hasOne(Pegawai::className(), ['pegawai_id' => 'pegawai_id']);
    }
}
