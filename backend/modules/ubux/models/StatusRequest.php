<?php

namespace backend\modules\ubux\models;

use Yii;

use common\behaviors\TimestampBehavior;
use common\behaviors\BlameableBehavior;
use common\behaviors\DeleteBehavior;

/**
 * This is the model class for table "ubux_referesi".
 *
 * @property integer $id
 * @property string $status
 *
 * @property PemakaianKendaraanMhs[] $pemakaianKendaraanMahasiswas
 * @property PemakaianKendaraanMhs[] $pemakaianKendaraanMahasiswas0
 */
class StatusRequest extends \yii\db\ActiveRecord
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
        return 'ubux_r_status_request';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'required'],
            [['status'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPemakaianKendaraanMahasiswas()
    {
        return $this->hasMany(PemakaianKendaraanMhs::className(), ['status_request_sekertaris_rektorat' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPemakaianKendaraanMahasiswas0()
    {
        return $this->hasMany(PemakaianKendaraanMhs::className(), ['status_request_kemahasiswaan' => 'id']);
    }
}
