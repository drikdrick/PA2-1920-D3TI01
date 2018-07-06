<?php

namespace backend\modules\baak\models;

use Yii;

use common\behaviors\TimestampBehavior;
use common\behaviors\BlameableBehavior;
use common\behaviors\DeleteBehavior;

/**
 * This is the model class for table "baak_r_data_surat".
 *
 * @property integer $data_surat_id
 * @property string $nama_institut
 * @property string $alamat
 * @property string $nomor_telepon
 * @property string $nomor_fax
 * @property string $email
 * @property string $alamat_web
 * @property string $created_by
 * @property string $created_at
 * @property string $updated_by
 * @property string $updated_at
 * @property integer $deleted
 * @property string $deleted_by
 * @property string $deleted_at
 */
class DataSurat extends \yii\db\ActiveRecord
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
        return 'baak_r_data_surat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_institut', 'alamat', 'nomor_telepon', 'nomor_fax', 'email', 'alamat_web'], 'required'],
            [['deleted'], 'integer'],
            [['alamat'], 'string'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['nama_institut', 'nomor_telepon', 'nomor_fax', 'email', 'alamat_web', 'created_by', 'updated_by', 'deleted_by'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'data_surat_id' => 'Data Surat ID',
            'nama_institut' => 'Nama Institut',
            'alamat' => 'Alamat',
            'nomor_telepon' => 'Nomor Telepon',
            'nomor_fax' => 'Nomor Fax',
            'email' => 'Email',
            'alamat_web' => 'Alamat Web',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'deleted' => 'Deleted',
            'deleted_by' => 'Deleted By',
            'deleted_at' => 'Deleted At',
        ];
    }
}
