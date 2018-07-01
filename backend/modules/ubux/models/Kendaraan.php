<?php

namespace backend\modules\ubux\models;

use Yii;

use common\behaviors\TimestampBehavior;
use common\behaviors\BlameableBehavior;
use common\behaviors\DeleteBehavior;

/**
 * This is the model class for table "ubux_kendaraan".
 *
 * @property integer $kendaraan_id
 * @property string $kendaraan
 * @property integer $daya_tampung_kendaraan
 * @property integer $plat_nomor
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
 * @property PemakaianKendaraan[] $transaksiKendaraanMahasiswas
 * @property UbuxTransaksiKendaraanPegawai[] $transaksiKendaraanPegawais
 */
class Kendaraan extends \yii\db\ActiveRecord
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
        return 'ubux_kendaraan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kendaraan', 'daya_tampung_kendaraan'], 'required'],
            [['daya_tampung_kendaraan', 'deleted', 'status'], 'integer'],
            [['deleted_at', 'created_at', 'updated_at'], 'safe'],
            [['kendaraan', 'plat_nomor'], 'string', 'max' => 100],
            [['deleted_by', 'created_by', 'updated_by', 'plat_nomor'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kendaraan_id' => 'Kendaraan ID',
            'kendaraan' => 'Kendaraan',
            'daya_tampung_kendaraan' => 'Daya Tampung Kendaraan',
            'plat_nomor' => 'Plat Nomor',
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
        return $this->hasMany(LaporanPemakaianKendaraan::className(), ['kendaraan_id' => 'kendaraan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogServices()
    {
        return $this->hasMany(UbuxLogService::className(), ['kendaraan_id' => 'kendaraan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransaksiKendaraanMahasiswas()
    {
        return $this->hasMany(PemakaianKendaraan::className(), ['kendaraan_id' => 'kendaraan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransaksiKendaraanPegawais()
    {
        return $this->hasMany(UbuxTransaksiKendaraanPegawai::className(), ['kendaraan_id' => 'kendaraan_id']);
    }

    public function getTransaksiKendaraanMahasiswaBarus()
    {
        return $this->hasMany(PemakaianKendaraanMhs::className(), ['kendaraan_id' => 'kendaraan_id']);
    }

    public function getKeteranganKendaraan(){
        $status = null;
        if($this->status == 1) $status = 'Terpakai';
        elseif($this->status == 0) $status = 'Tersedia';
        return $this->kendaraan.' '.$this->plat_nomor.' ('.$status.')';
    }
}
