<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "adak_penugasan_pengajaran".
 *
 * @property integer $penugasan_pengajaran_id
 * @property integer $pengajaran_id
 * @property integer $pegawai_id
 * @property integer $role_pengajar_id
 * @property integer $is_fulltime
 * @property string $start_date
 * @property string $end_date
 * @property integer $deleted
 * @property string $deleted_at
 * @property string $deleted_by
 * @property string $updated_at
 * @property string $updated_by
 * @property string $created_at
 * @property string $created_by
 *
 * @property AbsnKelasAbsensi[] $absnKelasAbsensis
 * @property AbsnSesiKuliah[] $absnSesiKuliahs
 * @property AdakPengajaran $pengajaran
 * @property HrdxPegawai $pegawai
 * @property MrefRRolePengajar $rolePengajar
 */
class AdakPenugasanPengajaran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'adak_penugasan_pengajaran';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengajaran_id', 'pegawai_id', 'role_pengajar_id', 'is_fulltime', 'deleted'], 'integer'],
            [['role_pengajar_id'], 'required'],
            [['start_date', 'end_date', 'deleted_at', 'updated_at', 'created_at'], 'safe'],
            [['deleted_by', 'updated_by', 'created_by'], 'string', 'max' => 32],
            [['pengajaran_id'], 'exist', 'skipOnError' => true, 'targetClass' => AdakPengajaran::className(), 'targetAttribute' => ['pengajaran_id' => 'pengajaran_id']],
            [['pegawai_id'], 'exist', 'skipOnError' => true, 'targetClass' => HrdxPegawai::className(), 'targetAttribute' => ['pegawai_id' => 'pegawai_id']],
            [['role_pengajar_id'], 'exist', 'skipOnError' => true, 'targetClass' => MrefRRolePengajar::className(), 'targetAttribute' => ['role_pengajar_id' => 'role_pengajar_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'penugasan_pengajaran_id' => 'Penugasan Pengajaran ID',
            'pengajaran_id' => 'Pengajaran ID',
            'pegawai_id' => 'Pegawai ID',
            'role_pengajar_id' => 'Role Pengajar ID',
            'is_fulltime' => 'Is Fulltime',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'deleted' => 'Deleted',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAbsnKelasAbsensis()
    {
        return $this->hasMany(AbsnKelasAbsensi::className(), ['penugasan_pengajaran_id' => 'penugasan_pengajaran_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAbsnSesiKuliahs()
    {
        return $this->hasMany(AbsnSesiKuliah::className(), ['penugasan_pengajaran_id' => 'penugasan_pengajaran_id']);
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
    public function getPegawai()
    {
        return $this->hasOne(HrdxPegawai::className(), ['pegawai_id' => 'pegawai_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRolePengajar()
    {
        return $this->hasOne(MrefRRolePengajar::className(), ['role_pengajar_id' => 'role_pengajar_id']);
    }
}
