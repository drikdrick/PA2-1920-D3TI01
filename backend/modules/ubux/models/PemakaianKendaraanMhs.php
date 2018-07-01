<?php

namespace backend\modules\ubux\models;

use Yii;

use common\behaviors\TimestampBehavior;
use common\behaviors\BlameableBehavior;
use common\behaviors\DeleteBehavior;

/**
 * This is the model class for table "ubux_pemakaian_kendaraan_mahasiswa".
 *
 * @property integer $pemakaian_kendaraan_mhs_id
 * @property integer $dim_id
 * @property string $desc
 * @property string $tujuan
 * @property integer $jumlah_penumpang_kendaraan
 * @property string $rencana_waktu_keberangkatan
 * @property string $rencana_waktu_kembali
 * @property integer $status_req_sekretaris_rektorat
 * @property integer $status_request_kemahasiswaan
 * @property string $proposal
 * @property string $no_telepon
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
 *
 *
 * @property Supir $supir
 * @property Kendaraan $kendaraan
 * @property Dim $mahasiswa
 * @property StatusRequest $statusRequestSekretarisRektorat
 * @property StatusRequest $statusRequestKemahasiswaan
 */
class PemakaianKendaraanMhs extends \yii\db\ActiveRecord
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
        return 'ubux_pemakaian_kendaraan_mhs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['desc', 'tujuan', 'rencana_waktu_keberangkatan', 'rencana_waktu_kembali', 'no_telepon'], 'required'],
            [['dim_id', 'jumlah_penumpang_kendaraan', 'deleted', 'kendaraan_id', 'supir_id', 'status_req_sekretaris_rektorat', 'status_request_kemahasiswaan'], 'integer'],
            [['rencana_waktu_keberangkatan', 'rencana_waktu_kembali', 'deleted_at', 'created_at', 'updated_at'], 'safe'],
            [['file'],'file'],
            [['desc', 'tujuan'], 'string'],
            [['no_hp_supir'], 'string', 'max' => 300],
            [['proposal'], 'string', 'max' => 100],
            [['no_telepon', 'deleted_by', 'created_by', 'updated_by'], 'string', 'max' => 32],
            ['rencana_waktu_kembali', 'compare', 'compareAttribute' => 'rencana_waktu_keberangkatan', 'operator' => '>', 'message' => 'Tidak bisa memilih tanggal sebelum memesan'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pemakaian_kendaraan_mhs_id' => 'Transaksi Kendaraan ID',
            'dim_id' => 'Dim ID',
            'desc' => 'Keperluan',
            'tujuan' => 'Tujuan',
            'jumlah_penumpang_kendaraan' => 'Jumlah Penumpang',
            'rencana_waktu_keberangkatan' => 'Waktu Keberangkatan',
            'rencana_waktu_kembali' => 'Waktu Tiba',
            'status_req_sekretaris_rektorat' => 'Status',
            'status_request_kemahasiswaan' => 'Status Persetujuan Kemahasiswaan',
            'proposal' => 'Proposal',
            'no_telepon' => 'No Telepon',
            'deleted' => 'Deleted',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'kendaraan_id' => 'Kendaraan',
            'supir_id' => 'Supir',
            'no_hp_supir' => 'No  Hp  Supir',
            'kode_proposal' => 'Kode Proposal',
            'file' => 'File Proposal',
        ];
    }

    // Untuk table kendaraan
    public function getKendaraan()
    {
        return $this->hasOne(Kendaraan::className(), ['kendaraan_id' => 'kendaraan_id']);
    }

    public function getSupir(){
        return $this->hasOne(Supir::className(), ['supir_id' => 'supir_id']);
    }

    public function getMahasiswa(){
        return $this->hasOne(Dim::className(), ['dim_id' => 'dim_id']);
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
}
