<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rppx_pengajuan_pengajaran".
 *
 * @property integer $pengajuan_id
 * @property integer $pengajaran_id
 * @property integer $pegawai_id
 * @property integer $role_pengajar_id
 * @property integer $is_fulltime
 * @property string $start_date
 * @property string $end_date
 * @property string $alasan_penolakan
 * @property integer $load_detail_id
 * @property integer $status_request
 * @property integer $deleted
 * @property string $deleted_at
 * @property string $deleted_by
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 *
 * @property RppxDetailKuliah $loadDetail
 * @property HrdxPegawai $pegawai
 * @property AdakPengajaran $pengajaran
 * @property MrefRRolePengajar $rolePengajar
 */
class RppxPengajuanPengajaran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rppx_pengajuan_pengajaran';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengajaran_id', 'pegawai_id', 'role_pengajar_id', 'is_fulltime', 'load_detail_id', 'status_request', 'deleted'], 'integer'],
            [['start_date', 'end_date', 'deleted_at', 'created_at', 'updated_at'], 'safe'],
            [['alasan_penolakan'], 'string'],
            [['deleted_by', 'created_by', 'updated_by'], 'string', 'max' => 32],
            [['load_detail_id'], 'exist', 'skipOnError' => true, 'targetClass' => RppxDetailKuliah::className(), 'targetAttribute' => ['load_detail_id' => 'load_detail_id']],
            [['pegawai_id'], 'exist', 'skipOnError' => true, 'targetClass' => HrdxPegawai::className(), 'targetAttribute' => ['pegawai_id' => 'pegawai_id']],
            [['pengajaran_id'], 'exist', 'skipOnError' => true, 'targetClass' => AdakPengajaran::className(), 'targetAttribute' => ['pengajaran_id' => 'pengajaran_id']],
            [['role_pengajar_id'], 'exist', 'skipOnError' => true, 'targetClass' => MrefRRolePengajar::className(), 'targetAttribute' => ['role_pengajar_id' => 'role_pengajar_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengajuan_id' => 'Pengajuan ID',
            'pengajaran_id' => 'Pengajaran ID',
            'pegawai_id' => 'Pegawai ID',
            'role_pengajar_id' => 'Role Pengajar ID',
            'is_fulltime' => 'Is Fulltime',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'alasan_penolakan' => 'Alasan Penolakan',
            'load_detail_id' => 'Load Detail ID',
            'status_request' => 'Status Request',
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
    public function getLoadDetail()
    {
        return $this->hasOne(RppxDetailKuliah::className(), ['load_detail_id' => 'load_detail_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPegawai()
    {
        return $this->hasOne(HrdxPegawai::className(), ['pegawai_id' => 'pegawai_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPengajaran()
    {
        return $this->hasOne(AdakPengajaran::className(), ['pengajaran_id' => 'pengajaran_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRolePengajar()
    {
        return $this->hasOne(MrefRRolePengajar::className(), ['role_pengajar_id' => 'role_pengajar_id']);
    }
}
