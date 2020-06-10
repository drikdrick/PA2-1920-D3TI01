<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "krkm_kurikulum_prodi".
 *
 * @property integer $kurikulum_prodi_id
 * @property integer $id_kur
 * @property string $kode_mk
 * @property string $kbk_id
 * @property integer $kurikulum_id
 * @property integer $ref_kbk_id
 * @property integer $deleted
 * @property string $deleted_at
 * @property string $deleted_by
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 *
 * @property KrkmKuliah $kurikulum
 * @property InstProdi $refKbk
 */
class KrkmKurikulumProdi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'krkm_kurikulum_prodi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_kur', 'kurikulum_id', 'ref_kbk_id', 'deleted'], 'integer'],
            [['kode_mk'], 'required'],
            [['deleted_at', 'created_at', 'updated_at'], 'safe'],
            [['kode_mk'], 'string', 'max' => 11],
            [['kbk_id'], 'string', 'max' => 255],
            [['deleted_by', 'created_by', 'updated_by'], 'string', 'max' => 32],
            [['kurikulum_id'], 'exist', 'skipOnError' => true, 'targetClass' => KrkmKuliah::className(), 'targetAttribute' => ['kurikulum_id' => 'kuliah_id']],
            [['ref_kbk_id'], 'exist', 'skipOnError' => true, 'targetClass' => InstProdi::className(), 'targetAttribute' => ['ref_kbk_id' => 'ref_kbk_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kurikulum_prodi_id' => 'Kurikulum Prodi ID',
            'id_kur' => 'Id Kur',
            'kode_mk' => 'Kode Mk',
            'kbk_id' => 'Kbk ID',
            'kurikulum_id' => 'Kurikulum ID',
            'ref_kbk_id' => 'Ref Kbk ID',
            'deleted' => 'Deleted',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKurikulum()
    {
        return $this->hasOne(KrkmKuliah::className(), ['kuliah_id' => 'kurikulum_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKbk()
    {
        return $this->hasOne(InstProdi::className(), ['ref_kbk_id' => 'ref_kbk_id']);
    }
}
