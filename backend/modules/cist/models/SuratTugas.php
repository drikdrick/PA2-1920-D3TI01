<?php

namespace backend\modules\cist\models;

use Yii;

use common\behaviors\TimestampBehavior;
use common\behaviors\BlameableBehavior;
use common\behaviors\DeleteBehavior;
use backend\modules\cist\models\AtasanSuratTugas;
use backend\modules\inst\models\InstApiModel;

/**
 * This is the model class for table "cist_surat_tugas".
 *
 * @property integer $surat_tugas_id
 * @property integer $perequest
 * @property string $no_surat
 * @property string $tempat
 * @property string $tanggal_berangkat
 * @property string $tanggal_kembali
 *  * @property string $tanggal_mulai
 * @property string $tanggal_selesai
 * @property string $agenda
 * @property string $review_surat
 * @property string $desc_surat_tugas
 * @property string $pengalihan_tugas
 * @property integer $jenis_surat_id
 * @property integer $surat_tugas_file_id
 * @property integer $name
 * @property integer $deleted
 * @property string $deleted_at
 * @property string $deleted_by
 * @property string $updated_at
 * @property string $updated_by
 * @property string $created_at
 * @property string $created_by
 *
 * @property CistLaporanSuratTugas[] $laporanSuratTugas
 * @property HrdxPegawai $atasan0
 * @property CistStatus $statusName
 * @property CistSuratTugasFile $idSuratTugasFile
 * @property CistJenisSurat $idJenisSurat
 * @property HrdxPegawai $pengalihanTugas
 * @property SysxUser $perequest0
 * @property CistSuratTugasAssignee[] $suratTugasAssignees
 */
class SuratTugas extends \yii\db\ActiveRecord
{
    public $files, $atasan;

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
        return 'cist_surat_tugas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['perequest'], 'required'],
            [['perequest', 'jenis_surat_id', 'status_id', 'deleted'], 'integer'],
            [['tanggal_berangkat', 'tanggal_kembali', 'tanggal_mulai', 'tanggal_selesai', 'deleted_at', 'updated_at', 'created_at'], 'safe'],
            [['review_surat', 'desc_surat_tugas', 'pengalihan_tugas', 'transportasi', 'catatan'], 'string'],
            [['no_surat'], 'string', 'max' => 45],
            [['tempat', 'agenda'], 'string', 'max' => 100],
            [['deleted_by', 'updated_by', 'created_by'], 'string', 'max' => 32],
            [['files'], 'file', 'maxFiles' => 0],
            [['atasan'], 'each', 'rule' => ['integer']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['status_id' => 'status_id']],
            [['jenis_surat_id'], 'exist', 'skipOnError' => true, 'targetClass' => JenisSurat::className(), 'targetAttribute' => ['jenis_surat_id' => 'jenis_surat_id']],
            [['perequest'], 'exist', 'skipOnError' => true, 'targetClass' => Pegawai::className(), 'targetAttribute' => ['perequest' => 'pegawai_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'surat_tugas_id' => 'Id Surat Tugas',
            'perequest' => 'Perequest',
            'no_surat' => 'No Surat',
            'tempat' => 'Alamat',
            'tanggal_berangkat' => 'Tanggal Berangkat',
            'tanggal_kembali' => 'Tanggal Kembali',
            'tanggal_mulai' => 'Tanggal Mulai Kegiatan',
            'tanggal_selesai' => 'Tanggal Selesai Kegiatan',
            'agenda' => 'Agenda',
            'review_surat' => 'Review Surat',
            'desc_surat_tugas' => 'Keterangan',
            'pengalihan_tugas' => 'Pengalihan Tugas',
            'atasan' => 'Tambah Atasan',
            'files' => 'Tambah Lampiran',
            'transportasi' => 'Transportasi',
            'catatan' => 'Catatan',
            'jenis_surat_id' => 'Id Jenis Surat',
            'status_id' => 'Status',
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
    public function getLaporanSuratTugas()
    {
        return $this->hasMany(LaporanSuratTugas::className(), ['surat_tugas_id' => 'surat_tugas_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatusName()
    {
        return $this->hasOne(Status::className(), ['status_id' => 'status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdJenisSurat()
    {
        return $this->hasOne(JenisSurat::className(), ['jenis_surat_id' => 'jenis_surat_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerequest0()
    {
        return $this->hasOne(Pegawai::className(), ['pegawai_id' => 'perequest']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuratTugasAssignees()
    {
        return $this->hasMany(SuratTugasAssignee::className(), ['surat_tugas_id' => 'surat_tugas_id']);
    }

    public function getAtasanSuratTugas()
    {
        return $this->hasMany(AtasanSuratTugas::className(), ['surat_tugas_id' => 'surat_tugas_id']);
    }

    public function getAssignedAtasan($id){
        $arrayId= array();
        $model = AtasanSuratTugas::find()->select(['id_pegawai'])->where(['surat_tugas_id' => $id])->all();
        foreach ($model as $key) {
            array_push($arrayId, $key['id_pegawai']);
        }

        return $arrayId;
    } 

    public function getSuratTugas($id){
        $arraySuratTugasId = array(); 
        $pegawai = Pegawai::find()->where(['user_id' => $id])->one();
        $modelSuratTugas = SuratTugasAssignee::find()->where(['id_pegawai' => $pegawai->pegawai_id])->all();
        foreach($modelSuratTugas as $data){
            array_push($arraySuratTugasId, $data['surat_tugas_id']);
        }

        return $arraySuratTugasId;
    }

    public function getSuratTugasBawahan($id){
        $modelSurat = AtasanSuratTugas::find()->where(['id_pegawai' => $id])->all();
        $arrayIdSurat = array();
        foreach($modelSurat as $data){
            array_push($arrayIdSurat, $data['surat_tugas_id']);
        }
        $modelSuratTugas = SuratTugas::find()->where(['in', 'surat_tugas_id', $arrayIdSurat])->andWhere(['!=', 'jenis_surat_id', 3])->all();
       
        return $modelSuratTugas;
    }

    public function getStatus($id){
        $model = Status::find()->where(['status_id' => $id])->one();

        return $model->status_id;
    }

    public function getNama($id){
        $model = Pegawai::find()->where(['pegawai_id' => $id])->one();
        
        return $model->nama;
    }

    public function getLaporan($id){
        $model = LaporanSuratTugas::find()->where(['surat_tugas_id' => $id])->one();

        return $model;
    }

    public function getStatusLaporan($id){
        $laporan = SuratTugas::getLaporan($id);
        $status = Status::find()->where(['status_id' => $laporan['status_id']])->one();
        
        return $status['name'];
    }

    public function getAssignee($id){
        $suratTugasAssignee = SuratTugasAssignee::find()->select('id_pegawai')->where(['surat_tugas_id' => $id])->all();
        $arrayAssignee = array();
        foreach($suratTugasAssignee as $data){
            array_push($arrayAssignee, $data['id_pegawai']);
        }
        $pegawais = Pegawai::find()->where(['in', 'pegawai_id', $arrayAssignee])->asArray()->all();

        return $pegawais;
    }

    public function getAtasan($id){
        $atasanSuratTugas = AtasanSuratTugas::find()->select('id_pegawai')->where(['surat_tugas_id' => $id])->all();
        $arrayAtasan = array();
        foreach($atasanSuratTugas as $data){
            array_push($arrayAtasan, $data['id_pegawai']);
        }
        $pegawais = Pegawai::find()->where(['in', 'pegawai_id', $arrayAtasan])->asArray()->all();

        return $pegawais;
    }

}
