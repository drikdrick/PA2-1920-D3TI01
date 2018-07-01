<?php

namespace backend\modules\ubux\models;

use Yii;

use common\behaviors\TimestampBehavior;
use common\behaviors\BlameableBehavior;
use common\behaviors\DeleteBehavior;

/**
 * This is the model class for table "ubux_laporan_pemakaian_kendaraan".
 *
 * @property integer $laporan_pemakaian_kendaraan_id
 * @property string $tujuan
 * @property string $desc
 * @property integer $jumlah_penumpang
 * @property string $keperluan
 * @property string $waktu_keberangkatan
 * @property string $waktu_tiba
 * @property integer $deleted
 * @property string $deleted_at
 * @property string $deleted_by
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 * @property integer $kendaraan_id
 * @property integer $supir_id
 * @property integer $pemakaian_kendaraan_id
 *
 * @property Kendaraan $kendaraan
 * @property Supir $supir
 * @property PemakaianKendaraan $pemakaianKendaraan
 */
class LaporanPemakaianKendaraan extends \yii\db\ActiveRecord
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
        return 'ubux_laporan_pemakaian_kendaraan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tujuan', 'desc', 'jumlah_penumpang', 'keperluan', 'waktu_keberangkatan', 'waktu_tiba'], 'required'],
            [['jumlah_penumpang', 'deleted', 'kendaraan_id', 'supir_id', 'pemakaian_kendaraan_id'], 'integer'],
            [['waktu_keberangkatan', 'waktu_tiba', 'deleted_at', 'created_at', 'updated_at'], 'safe'],
            [['tujuan', 'desc', 'keperluan'], 'string'],
            [['deleted_by', 'created_by', 'updated_by'], 'string', 'max' => 32],
            [['kendaraan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kendaraan::className(), 'targetAttribute' => ['kendaraan_id' => 'kendaraan_id']],
            [['supir_id'], 'exist', 'skipOnError' => true, 'targetClass' => Supir::className(), 'targetAttribute' => ['supir_id' => 'supir_id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'laporan_pemakaian_kendaraan_id' => 'Laporan Pemakaian Kendaraan ID',
            'tujuan' => 'Tujuan',
            'desc' => 'Deskripsi Penumpang',
            'jumlah_penumpang' => 'Jumlah Penumpang',
            'keperluan' => 'Keperluan',
            'waktu_keberangkatan' => 'Waktu Keberangkatan',
            'waktu_tiba' => 'Waktu Tiba',
            'deleted' => 'Deleted',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'kendaraan_id' => 'Kendaraan',
            'supir_id' => 'Supir',
            'pemakaian_kendaraan_id' => 'Pemakaian Kendaraan Id'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKendaraan()
    {
        return $this->hasOne(Kendaraan::className(), ['kendaraan_id' => 'kendaraan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupir()
    {
        return $this->hasOne(Supir::className(), ['supir_id' => 'supir_id']);
    }

    public function getPemakaianKendaraan()
    {
        return $this->hasOne(PemakaianKendaraan::className(), ['pemakaian_kendaraan_id' => 'pemakaian_kendaraan_id']);
    }
}
