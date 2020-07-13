<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mref_r_role_pengajar".
 *
 * @property integer $role_pengajar_id
 * @property string $nama
 * @property string $desc
 * @property integer $deleted
 * @property string $deleted_at
 * @property string $deleted_by
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 *
 * @property AdakPenugasanPengajaran[] $adakPenugasanPengajarans
 * @property RppxPengajuanPengajaran[] $rppxPengajuanPengajarans
 */
class MrefRRolePengajar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mref_r_role_pengajar';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama'], 'required'],
            [['desc'], 'string'],
            [['deleted'], 'integer'],
            [['deleted_at', 'created_at', 'updated_at'], 'safe'],
            [['nama'], 'string', 'max' => 45],
            [['deleted_by', 'created_by', 'updated_by'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'role_pengajar_id' => 'Role Pengajar ID',
            'nama' => 'Nama',
            'desc' => 'Desc',
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
    public function getAdakPenugasanPengajarans()
    {
        return $this->hasMany(AdakPenugasanPengajaran::className(), ['role_pengajar_id' => 'role_pengajar_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRppxPengajuanPengajarans()
    {
        return $this->hasMany(RppxPengajuanPengajaran::className(), ['role_pengajar_id' => 'role_pengajar_id']);
    }
}
