<?php

namespace backend\modules\baak\models;

use Yii;

use common\behaviors\TimestampBehavior;
use common\behaviors\BlameableBehavior;
use common\behaviors\DeleteBehavior;

/**
 * This is the model class for table "dimx_dim_has_baak_surat_magang".
 *
 * @property integer $dimx_dim_dim_id
 * @property integer $baak_surat_magang_id_surat
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 * @property integer $deleted
 * @property string $deleted_at
 * @property string $deleted_by
 *
 * @property BaakSuratMagang $baakSuratMagangIdSurat
 * @property DimxDim $dimxDimDim
 */
class DimHasSuratMagang extends \yii\db\ActiveRecord
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
        return 'baak_dim_has_surat_magang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dim_id', 'surat_magang_id'], 'required'],
            [['dim_has_surat_magang_id', 'dim_id', 'surat_magang_id', 'deleted'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['created_by', 'updated_by', 'deleted_by'], 'string', 'max' => 32],
            [['surat_magang_id'], 'exist', 'skipOnError' => true, 'targetClass' => SuratMagang::className(), 'targetAttribute' => ['surat_magang_id' => 'surat_magang_id']],
            [['dim_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dim::className(), 'targetAttribute' => ['dim_id' => 'dim_id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'dim_has_surat_magang_id' => 'ID',
            'dim_id' => 'NIM Mahasiswa',
            'surat_magang_id' => 'Baak Surat Magang Id Surat',
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
    public function getSuratMagang()
    {
        return $this->hasOne(SuratMagang::className(), ['surat_magang_id' => 'surat_magang_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDim()
    {
        return $this->hasOne(Dim::className(), ['dim_id' => 'dim_id']);
    }
}
