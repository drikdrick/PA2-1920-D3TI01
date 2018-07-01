<?php

namespace backend\modules\ubux\models;

use Yii;

use common\behaviors\TimestampBehavior;
use common\behaviors\BlameableBehavior;
use common\behaviors\DeleteBehavior;

/**
 * This is the model class for table "ubux_supir".
 *
 * @property integer $supir_id
 * @property integer $pegawai_id
 * @property string $no_telepon_supir
 * @property integer $status
 * @property integer $deleted
 * @property string $deleted_at
 * @property string $deleted_by
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 *
 * @property LaporanPemakaianKendaraan[] $laporanPemakaianKendaraans
 * @property Pegawai $pegawai
 * @property UbuxTransaksiKendaraan[] $transaksiKendaraans
 */
class Supir extends \yii\db\ActiveRecord
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
        return 'ubux_supir';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pegawai_id', 'deleted', 'status'], 'integer'],
            [['deleted_at', 'created_at', 'updated_at'], 'safe'],
            [['no_telepon_supir', 'deleted_by', 'created_by', 'updated_by'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'supir_id' => 'Supir ID',
            'pegawai_id' => 'Nama',
            'no_telepon_supir' => 'No Telepon Supir',
            'status' => 'Ketersediaan',
            'deleted' => 'Deleted',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLaporanPemakaianKendaraans()
    {
        return $this->hasMany(LaporanPemakaianKendaraan::className(), ['supir_id' => 'supir_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransaksiKendaraans()
    {
        return $this->hasMany(UbuxTransaksiKendaraan::className(), ['supir_id' => 'supir_id']);
    }

    public function getTransaksiKendaraanBarus()
    {
        return $this->hasMany(PemakaianKendaraanMhs::className(), ['supir_id' => 'supir_id']);
    }

    public function getPegawai()
    {
        return $this->hasOne(Pegawai::className(), ['pegawai_id' => 'pegawai_id']);
    }

    public function getNamaSupir(){
        $status = null;
        if($this->status == 1) $status = 'Di Perjalanan';
        elseif($this->status == 0) $status = 'Tersedia';
        return $this->pegawai->nama.' ('.$status.')';
    }
}
