<?php

namespace backend\modules\askm\models;

use Yii;

/**
 * This is the model class for table "askm_asrama".
 *
 * @property integer $asrama_id
 * @property string $name
 * @property string $lokasi
 * @property integer $jumlah_mahasiswa
 * @property integer $kapasitas
 *
 * @property DimxDim[] $dimxDims
 */
class AskmAsrama extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'askm_asrama';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'lokasi'], 'required'],
            [['jumlah_mahasiswa', 'kapasitas'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['lokasi'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'asrama_id' => 'Asrama ID',
            'name' => 'Name',
            'lokasi' => 'Lokasi',
            'jumlah_mahasiswa' => 'Jumlah Mahasiswa',
            'kapasitas' => 'Kapasitas',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDimxDims()
    {
        return $this->hasMany(DimxDim::className(), ['asrama_id' => 'asrama_id']);
    }
}
