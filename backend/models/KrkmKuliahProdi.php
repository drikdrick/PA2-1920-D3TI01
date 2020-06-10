<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "krkm_kuliah_prodi".
 *
 * @property integer $krkm_kuliah_prodi_id
 * @property integer $kuliah_id
 * @property integer $ref_kbk_id
 * @property integer $semester
 * @property string $deleted_by
 * @property string $deleted_at
 * @property string $created_by
 * @property string $created_at
 * @property string $updated_by
 * @property string $updated_at
 *
 * @property KrkmKuliah $kuliah
 * @property InstProdi $refKbk
 */
class KrkmKuliahProdi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'krkm_kuliah_prodi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kuliah_id', 'ref_kbk_id', 'semester'], 'integer'],
            [['deleted_at', 'created_at', 'updated_at'], 'safe'],
            [['deleted_by', 'created_by', 'updated_by'], 'string', 'max' => 32],
            [['kuliah_id'], 'exist', 'skipOnError' => true, 'targetClass' => KrkmKuliah::className(), 'targetAttribute' => ['kuliah_id' => 'kuliah_id']],
            [['ref_kbk_id'], 'exist', 'skipOnError' => true, 'targetClass' => InstProdi::className(), 'targetAttribute' => ['ref_kbk_id' => 'ref_kbk_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'krkm_kuliah_prodi_id' => 'Krkm Kuliah Prodi ID',
            'kuliah_id' => 'Kuliah ID',
            'ref_kbk_id' => 'Ref Kbk ID',
            'semester' => 'Semester',
            'deleted_by' => 'Deleted By',
            'deleted_at' => 'Deleted At',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKuliah()
    {
        return $this->hasOne(KrkmKuliah::className(), ['kuliah_id' => 'kuliah_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKbk()
    {
        return $this->hasOne(InstProdi::className(), ['ref_kbk_id' => 'ref_kbk_id']);
    }
}
