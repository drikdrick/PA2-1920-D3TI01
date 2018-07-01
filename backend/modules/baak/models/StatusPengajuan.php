<?php

namespace backend\modules\baak\models;

use Yii;

use common\behaviors\TimestampBehavior;
use common\behaviors\BlameableBehavior;
use common\behaviors\DeleteBehavior;

/**
 * This is the model class for table "baak_r_status_pengajuan".
 *
 * @property integer $id_status
 * @property string $status
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 * @property integer $deleted
 * @property string $deleted_at
 * @property string $deleted_by
 *
 * @property BaakKtm[] $baakKtms
 * @property BaakSuratLomba[] $baakSuratLombas
 * @property BaakSuratMagang[] $baakSuratMagangs
 * @property BaakSuratMahasiswaAktif[] $baakSuratMahasiswaAktifs
 * @property BaakSuratPengantarPa[] $baakSuratPengantarPas
 * @property BaakSuratPengantarTa[] $baakSuratPengantarTas
 */
class StatusPengajuan extends \yii\db\ActiveRecord
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
        return 'baak_r_status_pengajuan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status_pengajuan_id'], 'required'],
            [['status_pengajuan_id', 'deleted'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['status_pengajuan_id', 'created_by', 'updated_by', 'deleted_by'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'status_pengajuan_id' => 'Id Status',
            'name' => 'Status Pengajuan',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'deleted' => 'Deleted',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKtm()
    {
        return $this->hasMany(Ktm::className(), ['status_pengajuan_id' => 'status_pengajuan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuratLomba()
    {
        return $this->hasMany(SuratLomba::className(), ['status_pengajuan_id' => 'status_pengajuan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuratMagang()
    {
        return $this->hasMany(SuratMagang::className(), ['status_pengajuan_id' => 'status_pengajuan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuratMahasiswaAktif()
    {
        return $this->hasMany(SuratMahasiswaAktif::className(), ['status_pengajuan_id' => 'status_pengajuan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuratPengantarPa()
    {
        return $this->hasMany(SuratPengantarPa::className(), ['status_pengajuan_id' => 'status_pengajuan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuratPengantarTa()
    {
        return $this->hasMany(SuratPengantarTa::className(), ['status_pengajuan_id' => 'status_pengajuan_id']);
    }
}
