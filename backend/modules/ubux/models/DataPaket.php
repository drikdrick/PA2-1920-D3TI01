<?php

namespace backend\modules\ubux\models;

use Yii;

use common\behaviors\TimestampBehavior;
use common\behaviors\BlameableBehavior;
use common\behaviors\DeleteBehavior;

/**
 * This is the model class for table "ubux_data_paket".
 *
 * @property integer $data_paket_id
 * @property integer $tag
 * @property integer $dim_id
 * @property integer $pegawai_id
 * @property string $pengirim
 * @property string $tanggal_kedatangan
 * @property string $diambil_oleh
 * @property string $tanggal_diambil
 * @property integer $posisi_paket_id
 * @property integer $status_paket_id
 * @property string $desc
 * @property integer $deleted
 * @property string $deleted_at
 * @property string $deleted_by
 * @property string $created_by
 * @property string $created_at
 * @property string $updated_at
 * @property string $updated_by
 *
 * @property DimxDim $dim
 * @property HrdxPegawai $pegawai
 * @property UbuxRPosisiPaket $posisiPaket
 * @property UbuxRStatusPaket $statusPaket
 */
class DataPaket extends \yii\db\ActiveRecord
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
        return 'ubux_data_paket';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tag', 'dim_id', 'pegawai_id', 'posisi_paket_id', 'status_paket_id', 'deleted'], 'integer'],
            [['tanggal_kedatangan'], 'required'],
            [['tanggal_kedatangan', 'tanggal_diambil', 'deleted_at', 'created_at', 'updated_at'], 'safe'],
            [['desc'], 'string'],
            [['pengirim', 'diambil_oleh', 'deleted_by', 'created_by', 'updated_by'], 'string', 'max' => 32],
            [['dim_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dim::className(), 'targetAttribute' => ['dim_id' => 'dim_id']],
            [['pegawai_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pegawai::className(), 'targetAttribute' => ['pegawai_id' => 'pegawai_id']],
            [['posisi_paket_id'], 'exist', 'skipOnError' => true, 'targetClass' => PosisiPaket::className(), 'targetAttribute' => ['posisi_paket_id' => 'posisi_paket_id']],
            [['status_paket_id'], 'exist', 'skipOnError' => true, 'targetClass' => StatusPaket::className(), 'targetAttribute' => ['status_paket_id' => 'status_paket_id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'data_paket_id' => 'Data Paket ID',
            'tag' => 'Tag',
            'dim_id' => 'Dim ID',
            'pegawai_id' => 'Pegawai ID',
            'pengirim' => 'Pengirim',
            'tanggal_kedatangan' => 'Tanggal Kedatangan',
            'diambil_oleh' => 'Diambil Oleh',
            'tanggal_diambil' => 'Tanggal Diambil',
            'posisi_paket_id' => 'Posisi Paket ID',
            'status_paket_id' => 'Status Paket ID',
            'desc' => 'Desc',
            'deleted' => 'Deleted',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDim()
    {
        return $this->hasOne(Dim::className(), ['dim_id' => 'dim_id']);
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
    public function getPosisiPaket()
    {
        return $this->hasOne(PosisiPaket::className(), ['posisi_paket_id' => 'posisi_paket_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatusPaket()
    {
        return $this->hasOne(StatusPaket::className(), ['status_paket_id' => 'status_paket_id']);
    }
}
