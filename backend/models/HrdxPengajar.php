<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hrdx_pengajar".
 *
 * @property integer $pengajar_id
 * @property integer $ta
 * @property integer $id_kur
 * @property string $kode_mk
 * @property string $id
 * @property string $role
 * @property integer $kurikulum_id
 * @property integer $pegawai_id
 * @property integer $deleted
 * @property string $deleted_at
 * @property string $deleted_by
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 *
 * @property HrdxPegawai $pegawai
 * @property KrkmKuliah $kurikulum
 * @property RppxRequestDosen[] $rppxRequestDosens
 */
class HrdxPengajar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hrdx_pengajar';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ta', 'id_kur', 'kurikulum_id', 'pegawai_id', 'deleted'], 'integer'],
            [['kode_mk', 'id'], 'required'],
            [['deleted_at', 'created_at', 'updated_at'], 'safe'],
            [['kode_mk'], 'string', 'max' => 11],
            [['id'], 'string', 'max' => 20],
            [['role'], 'string', 'max' => 1],
            [['deleted_by', 'created_by', 'updated_by'], 'string', 'max' => 32],
            [['pegawai_id'], 'exist', 'skipOnError' => true, 'targetClass' => HrdxPegawai::className(), 'targetAttribute' => ['pegawai_id' => 'pegawai_id']],
            [['kurikulum_id'], 'exist', 'skipOnError' => true, 'targetClass' => KrkmKuliah::className(), 'targetAttribute' => ['kurikulum_id' => 'kuliah_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengajar_id' => 'Pengajar ID',
            'ta' => 'Ta',
            'id_kur' => 'Id Kur',
            'kode_mk' => 'Kode Mk',
            'id' => 'ID',
            'role' => 'Role',
            'kurikulum_id' => 'Kurikulum ID',
            'pegawai_id' => 'Pegawai ID',
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
    public function getPegawai()
    {
        return $this->hasOne(HrdxPegawai::className(), ['pegawai_id' => 'pegawai_id']);
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
    public function getRppxRequestDosens()
    {
        return $this->hasMany(RppxRequestDosen::className(), ['pengajar_id' => 'pengajar_id']);
    }
}
