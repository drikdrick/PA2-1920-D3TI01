<?php

namespace backend\modules\askm\models;

use Yii;

use common\behaviors\TimestampBehavior;
use common\behaviors\BlameableBehavior;
use common\behaviors\DeleteBehavior;

/**
 * This is the model class for table "ubux_data_paket".
 *
 * @property integer $data_paket_id
 * @property integer $tag
 * @property integer $penerima
 * @property string $pengirim
 * @property string $tanggal_kedatangan
 * @property string $diambil_oleh
 * @property string $tanggal_diambil
 * @property integer $posisi
 * @property integer $status
 * @property string $desc
 * @property integer $deleted
 * @property string $deleted_at
 * @property string $deleted_by
 * @property string $created_by
 * @property string $created_at
 * @property string $updated_at
 * @property string $updated_by
 *
 * @property SysxUser $penerima0
 * @property UbuxRPosisiPaket $posisi0
 * @property UbuxRStatusPaket $status0
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
            [['tag', 'tanggal_kedatangan'], 'required'],
            [['tag', 'penerima', 'posisi', 'status', 'deleted'], 'integer'],
            [['tanggal_kedatangan', 'tanggal_diambil', 'deleted_at', 'created_at', 'updated_at'], 'safe'],
            [['desc'], 'string'],
            [['pengirim', 'diambil_oleh', 'deleted_by', 'created_by', 'updated_by'], 'string', 'max' => 32],
            [['penerima'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['penerima' => 'user_id']],
            [['posisi'], 'exist', 'skipOnError' => true, 'targetClass' => PosisiPaket::className(), 'targetAttribute' => ['posisi' => 'posisi_id']],
            [['status'], 'exist', 'skipOnError' => true, 'targetClass' => StatusPaket::className(), 'targetAttribute' => ['status' => 'status_id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'data_paket_id' => 'Data Paket ID',
            'tag' => 'Tag',
            'penerima' => 'Penerima',
            'pengirim' => 'Pengirim',
            'tanggal_kedatangan' => 'Tanggal Kedatangan',
            'diambil_oleh' => 'Diambil Oleh',
            'tanggal_diambil' => 'Tanggal Diambil',
            'posisi' => 'Posisi',
            'status' => 'Status',
            'desc' => 'Desc',
            'deleted' => 'Deleted',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPenerimas()
    {
        return $this->hasOne(User::className(), ['user_id' => 'penerima']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosisis()
    {
        return $this->hasOne(PosisiPaket::className(), ['posisi_id' => 'posisi']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatuss()
    {
        return $this->hasOne(StatusPaket::className(), ['status_id' => 'status']);
    }

    public function getMahasiswa(){
        return $this->hasOne(Dim::className(),['user_id'=>'user_id'])
        ->viaTable('sysx_user',['user_id' => 'penerima']);
    }

    public function getPegawai(){
        return $this->hasOne(Pegawai::className(),['user_id'=>'user_id'])
        ->viaTable('sysx_user',['user_id' => 'penerima']);
    }
}
