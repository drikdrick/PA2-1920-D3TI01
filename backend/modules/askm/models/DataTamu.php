<?php

namespace backend\modules\askm\models;

use Yii;

use common\behaviors\TimestampBehavior;
use common\behaviors\BlameableBehavior;
use common\behaviors\DeleteBehavior;

/**
 * This is the model class for table "ubux_data_tamu".
 *
 * @property integer $data_tamu_id
 * @property string $nik
 * @property string $nama
 * @property string $waktu_kedatangan
 * @property string $desc
 * @property string $waktu_kembali
 * @property integer $deleted
 * @property string $deleted_at
 * @property string $deleted_by
 * @property string $created_by
 * @property string $created_at
 * @property string $updated_at
 * @property string $updated_by
 */
class DataTamu extends \yii\db\ActiveRecord
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
        return 'ubux_data_tamu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['waktu_kedatangan'], 'required'],
            [['waktu_kedatangan', 'waktu_kembali', 'deleted_at', 'created_at', 'updated_at'], 'safe'],
            [['desc'], 'string'],
            [['deleted'], 'integer'],
            [['nik', 'nama', 'deleted_by', 'created_by', 'updated_by'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'data_tamu_id' => 'Data Tamu ID',
            'nik' => 'Nik',
            'nama' => 'Nama',
            'waktu_kedatangan' => 'Waktu Kedatangan',
            'desc' => 'Desc',
            'waktu_kembali' => 'Waktu Kembali',
            'deleted' => 'Deleted',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
