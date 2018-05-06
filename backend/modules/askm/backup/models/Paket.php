<?php

namespace backend\modules\askm\models;

use Yii;
use yii\db\ActiveRecord;
use common\behaviors\TimestampBehavior;
use common\behaviors\BlameableBehavior;
use common\behaviors\DeleteBehavior;

/**
 * This is the model class for table "ubux_data_paket".
 *
 * @property integer $data_paket_id
 * @property string $penerima
 * @property string $pengirim
 * @property string $tanggal_kedatangan
 * @property string $diambil_oleh
 * @property string $tanggal_diambil
 * @property string $posisi
 * @property string $desc
 * @property integer $deleted
 * @property string $deleted_at
 * @property string $deleted_by
 * @property string $created_by
 * @property string $created_at
 * @property string $updated_at
 * @property string $updated_by
 *
 */
class Paket extends \yii\db\ActiveRecord
{

    /**
     * behaviour to add created_at and updatet_at field with current datetime (timestamp)
     * and created_by and updated_by field with current user id (blameable)
     */
    public function behaviors(){
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
             ],
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
        return 'ubux_data_paket';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tanggal_kedatangan','penerima'], 'required'],
            [['tanggal_kedatangan', 'tanggal_diambil', 'deleted_at', 'created_at', 'updated_at'], 'safe'],
            [[ 'deleted'], 'integer'],
            [['desc'], 'string'],
            [['penerima', 'pengirim', 'diambil_oleh', 'posisi', 'deleted_by', 'created_by', 'updated_by'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'data_paket_id' => 'Data Paket ID',
            'penerima' => 'Penerima',
            'pengirim' => 'Pengirim',
            'tanggal_kedatangan' => 'Tanggal Kedatangan',
            'diambil_oleh' => 'Diambil Oleh',
            'tanggal_diambil' => 'Tanggal Diambil',
            'posisi' => 'Posisi',
            'desc' => 'Deskripsi',
            'deleted' => 'Deleted',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
            'created_by' => 'Petugas',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
