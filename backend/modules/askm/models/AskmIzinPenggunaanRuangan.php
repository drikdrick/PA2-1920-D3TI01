<?php

namespace backend\modules\askm\models;

use Yii;
use backend\modules\dimx\models\DimxDim;
use backend\modules\hrdx\models\HrdxStaf;

/**
 * This is the model class for table "askm_izin_penggunaan_ruangan".
 *
 * @property integer $izin_penggunaan_ruangan_id
 * @property string $rencana_mulai
 * @property string $rencana_berakhir
 * @property string $desc
 * @property integer $dim_id
 * @property integer $staf_id
 * @property integer $status_request_id
 *
 * @property AskmRStatusRequest $statusRequest
 * @property DimxDim $dim
 * @property HrdxStaf $staf
 */
class AskmIzinPenggunaanRuangan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'askm_izin_penggunaan_ruangan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rencana_mulai', 'rencana_berakhir', 'desc', 'dim_id'], 'required'],
            [['rencana_mulai', 'rencana_berakhir'], 'safe'],
            [['desc'], 'string'],
            [['dim_id', 'staf_id', 'status_request_id'], 'integer'],
            [['status_request_id'], 'exist', 'skipOnError' => true, 'targetClass' => AskmRStatusRequest::className(), 'targetAttribute' => ['status_request_id' => 'status_request_id']],
            [['dim_id'], 'exist', 'skipOnError' => true, 'targetClass' => DimxDim::className(), 'targetAttribute' => ['dim_id' => 'dim_id']],
            [['staf_id'], 'exist', 'skipOnError' => true, 'targetClass' => HrdxStaf::className(), 'targetAttribute' => ['staf_id' => 'staf_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'izin_penggunaan_ruangan_id' => 'Izin Penggunaan Ruangan ID',
            'rencana_mulai' => 'Rencana Mulai',
            'rencana_berakhir' => 'Rencana Berakhir',
            'desc' => 'Desc',
            'dim_id' => 'Dim ID',
            'staf_id' => 'Staf ID',
            'status_request_id' => 'Status Request ID',
        ];
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
    public function getStaf()
    {
        return $this->hasOne(HrdxStaf::className(), ['staf_id' => 'staf_id']);
    }
}
