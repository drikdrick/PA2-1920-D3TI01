<?php

namespace backend\modules\askm\models;

use Yii;
use backend\modules\dimx\models\DimxDim;

/**
 * This is the model class for table "askm_izin_bermalam".
 *
 * @property integer $izin_bermalam_id
 * @property string $rencana_berangkat
 * @property string $rencana_kembali
 * @property string $realisasi_berangkat
 * @property string $realisasi_kembali
 * @property string $desc
 * @property string $tujuan
 * @property integer $dim_id
 * @property integer $keasramaan_id
 * @property integer $status_request_id
 * @property integer $izin_laptop_id
 *
 * @property AskmIzinLaptop $izinLaptop
 * @property AskmKeasramaan $keasramaan
 * @property AskmRStatusRequest $statusRequest
 * @property DimxDim $dim
 */
class AskmIzinBermalam extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'askm_izin_bermalam';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rencana_berangkat', 'rencana_kembali', 'desc', 'tujuan', 'dim_id'], 'required'],
            [['rencana_berangkat', 'rencana_kembali', 'realisasi_berangkat', 'realisasi_kembali'], 'safe'],
            [['desc'], 'string'],
            [['dim_id', 'keasramaan_id', 'status_request_id', 'izin_laptop_id'], 'integer'],
            [['tujuan'], 'string', 'max' => 45],
            [['izin_laptop_id'], 'exist', 'skipOnError' => true, 'targetClass' => AskmIzinLaptop::className(), 'targetAttribute' => ['izin_laptop_id' => 'izin_laptop_id']],
            [['keasramaan_id'], 'exist', 'skipOnError' => true, 'targetClass' => AskmKeasramaan::className(), 'targetAttribute' => ['keasramaan_id' => 'keasramaan_id']],
            [['status_request_id'], 'exist', 'skipOnError' => true, 'targetClass' => AskmRStatusRequest::className(), 'targetAttribute' => ['status_request_id' => 'status_request_id']],
            [['dim_id'], 'exist', 'skipOnError' => true, 'targetClass' => DimxDim::className(), 'targetAttribute' => ['dim_id' => 'dim_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'izin_bermalam_id' => 'Izin Bermalam ID',
            'rencana_berangkat' => 'Rencana Berangkat',
            'rencana_kembali' => 'Rencana Kembali',
            'realisasi_berangkat' => 'Realisasi Berangkat',
            'realisasi_kembali' => 'Realisasi Kembali',
            'desc' => 'Desc',
            'tujuan' => 'Tujuan',
            'dim_id' => 'Dim ID',
            'keasramaan_id' => 'Keasramaan ID',
            'status_request_id' => 'Status Request ID',
            'izin_laptop_id' => 'Izin Laptop ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIzinLaptop()
    {
        return $this->hasOne(AskmIzinLaptop::className(), ['izin_laptop_id' => 'izin_laptop_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKeasramaan()
    {
        return $this->hasOne(AskmKeasramaan::className(), ['keasramaan_id' => 'keasramaan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatusRequest()
    {
        return $this->hasOne(AskmRStatusRequest::className(), ['status_request_id' => 'status_request_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDim()
    {
        return $this->hasOne(DimxDim::className(), ['dim_id' => 'dim_id']);
    }
}
