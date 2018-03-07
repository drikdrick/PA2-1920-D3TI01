<?php

namespace backend\modules\askm\models;

use Yii;
use backend\modules\dimx\models\DimxDim;
use backend\modules\hrdx\models\HrdxDosen;
use backend\modules\hrdx\models\HrdxStaf;

/**
 * This is the model class for table "askm_izin_keluar".
 *
 * @property integer $izin_keluar_id
 * @property string $rencana_berangkat
 * @property string $rencana_kembali
 * @property string $realisasi_berangkat
 * @property string $realisasi_kembali
 * @property string $desc
 * @property integer $dim_id
 * @property integer $dosen_id
 * @property integer $staf_id
 * @property integer $status_request_id
 * @property integer $keasramaan_id
 *
 * @property AskmKeasramaan $keasramaan
 * @property AskmRStatusRequest $statusRequest
 * @property DimxDim $dim
 * @property HrdxDosen $dosen
 * @property HrdxStaf $staf
 */
class AskmIzinKeluar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'askm_izin_keluar';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rencana_berangkat', 'rencana_kembali', 'desc', 'dim_id'], 'required'],
            [['rencana_berangkat', 'rencana_kembali', 'realisasi_berangkat', 'realisasi_kembali'], 'safe'],
            [['desc'], 'string'],
            [['dim_id', 'dosen_id', 'staf_id', 'status_request_id', 'keasramaan_id'], 'integer'],
            [['keasramaan_id'], 'exist', 'skipOnError' => true, 'targetClass' => AskmKeasramaan::className(), 'targetAttribute' => ['keasramaan_id' => 'keasramaan_id']],
            [['status_request_id'], 'exist', 'skipOnError' => true, 'targetClass' => AskmRStatusRequest::className(), 'targetAttribute' => ['status_request_id' => 'status_request_id']],
            [['dim_id'], 'exist', 'skipOnError' => true, 'targetClass' => DimxDim::className(), 'targetAttribute' => ['dim_id' => 'dim_id']],
            [['dosen_id'], 'exist', 'skipOnError' => true, 'targetClass' => HrdxDosen::className(), 'targetAttribute' => ['dosen_id' => 'dosen_id']],
            [['staf_id'], 'exist', 'skipOnError' => true, 'targetClass' => HrdxStaf::className(), 'targetAttribute' => ['staf_id' => 'staf_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'izin_keluar_id' => 'Izin Keluar ID',
            'rencana_berangkat' => 'Rencana Berangkat',
            'rencana_kembali' => 'Rencana Kembali',
            'realisasi_berangkat' => 'Realisasi Berangkat',
            'realisasi_kembali' => 'Realisasi Kembali',
            'desc' => 'Desc',
            'dim_id' => 'Dim ID',
            'dosen_id' => 'Dosen ID',
            'staf_id' => 'Staf ID',
            'status_request_id' => 'Status Request ID',
            'keasramaan_id' => 'Keasramaan ID',
        ];
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDosen()
    {
        return $this->hasOne(HrdxDosen::className(), ['dosen_id' => 'dosen_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaf()
    {
        return $this->hasOne(HrdxStaf::className(), ['staf_id' => 'staf_id']);
    }
}
