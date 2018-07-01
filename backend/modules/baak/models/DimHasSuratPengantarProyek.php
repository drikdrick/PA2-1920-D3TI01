<?php

namespace backend\modules\baak\models;

use Yii;

use common\behaviors\TimestampBehavior;
use common\behaviors\BlameableBehavior;
use common\behaviors\DeleteBehavior;

/**
 * This is the model class for table "baak_dim_has_surat_pengantar_proyek".
 *
 * @property integer $dim_has_surat_pengantar_proyek
 * @property integer $surat_pengantar_proyek_id
 * @property integer $dim_id
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 * @property integer $deleted
 * @property string $deleted_at
 * @property string $deleted_by
 *
 * @property BaakSuratPengantarProyek $suratPengantarProyek
 * @property DimxDim $dim
 */
class DimHasSuratPengantarProyek extends \yii\db\ActiveRecord
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
        return 'baak_dim_has_surat_pengantar_proyek';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['surat_pengantar_proyek_id', 'dim_id', 'deleted'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['created_by', 'updated_by', 'deleted_by'], 'string', 'max' => 32],
            [['surat_pengantar_proyek_id'], 'exist', 'skipOnError' => true, 'targetClass' => SuratPengantarProyek::className(), 'targetAttribute' => ['surat_pengantar_proyek_id' => 'surat_pengantar_proyek_id']],
            [['dim_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dim::className(), 'targetAttribute' => ['dim_id' => 'dim_id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'dim_has_surat_pengantar_proyek_id' => 'Dim Has Surat Pengantar Proyek',
            'surat_pengantar_proyek_id' => 'Surat Pengantar Proyek ID',
            'dim_id' => 'Dim ID',
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
    public function getSuratPengantarProyek()
    {
        return $this->hasOne(SuratPengantarProyek::className(), ['surat_pengantar_proyek_id' => 'surat_pengantar_proyek_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDim()
    {
        return $this->hasOne(Dim::className(), ['dim_id' => 'dim_id']);
    }
}
