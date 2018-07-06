<?php

namespace backend\modules\baak\models;

use Yii;

use common\behaviors\TimestampBehavior;
use common\behaviors\BlameableBehavior;
use common\behaviors\DeleteBehavior;

/**
 * This is the model class for table "baak_ktm".
 *
 * @property integer $pengajuan_id
 * @property string $alasan
 * @property integer $pengaju
 * @property integer $deleted
 * @property string $deleted_at
 * @property string $deleted_by
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 * @property integer $dimx_dim_dim_id
 * @property integer $hrdx_pegawai_pegawai_id
 * @property integer $status
 * @property string $waktu_pengambilan
 *
 * @property DimxDim $dimxDimDim
 * @property HrdxPegawai $hrdxPegawaiPegawai
 * @property BaakRStatusPengajuan $status0
 * @property DimxDim $pengaju0
 */
class KartuTandaMahasiswa extends \yii\db\ActiveRecord
{

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
        return 'baak_kartu_tanda_mahasiswa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pemohon_id', 'deleted', 'pegawai_id', 'status_pengajuan_id'], 'integer'],
            [['alasan'], 'required'],
            [['deleted_at', 'created_at', 'updated_at', 'waktu_pengambilan'], 'safe'],
            [['alasan', 'alasan_penolakan'], 'string'],
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
            'kartu_tanda_mahasiswa_id' => 'Id Pengajuan',
            'alasan' => 'Alasan',
            'pemohon_id' => 'Pemohon',
            'deleted' => 'Deleted',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'pegawai_id' => 'Pegawai',
            'status_pengajuan_id' => 'Status',
            'alasan_penolakan' => 'Alasan Penolakan',
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
}
