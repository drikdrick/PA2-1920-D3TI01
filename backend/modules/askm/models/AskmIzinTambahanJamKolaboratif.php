<?php

namespace backend\modules\askm\models;

use Yii;
use backend\modules\dimx\models\DimxDim;
use backend\modules\hrdx\models\HrdxStaf;

/**
 * This is the model class for table "askm_izin_tambahan_jam_kolaboratif".
 *
 * @property integer $izin_tambahan_jam_kolaboratif_id
 * @property string $rencana_mulai
 * @property string $rencana_berakhir
 * @property string $decs
 * @property integer $dim_id
 * @property integer $status_request_id
 * @property integer $staf_id
 *
 * @property AskmRStatusRequest $statusRequest
 * @property DimxDim $dim
 * @property HrdxStaf $staf
 * @property AskmRuangan[] $askmRuangans
 */
class AskmIzinTambahanJamKolaboratif extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'askm_izin_tambahan_jam_kolaboratif';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rencana_mulai', 'rencana_berakhir', 'decs', 'dim_id'], 'required'],
            [['rencana_mulai', 'rencana_berakhir'], 'safe'],
            [['decs'], 'string'],
            [['dim_id', 'status_request_id', 'staf_id'], 'integer'],
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
            'izin_tambahan_jam_kolaboratif_id' => 'Izin Tambahan Jam Kolaboratif ID',
            'rencana_mulai' => 'Rencana Mulai',
            'rencana_berakhir' => 'Rencana Berakhir',
            'decs' => 'Decs',
            'dim_id' => 'Dim ID',
            'status_request_id' => 'Status Request ID',
            'staf_id' => 'Staf ID',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAskmRuangans()
    {
        return $this->hasMany(AskmRuangan::className(), ['izin_tambahan_jam_kolaboratif_id' => 'izin_tambahan_jam_kolaboratif_id']);
    }
}
