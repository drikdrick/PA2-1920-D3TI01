<?php

namespace backend\controllers;

use app\models\HrdxPegawai;
use app\models\HrdxPengajar;
use app\models\InstProdi;
use app\models\KrkmKuliah;
use app\models\KrkmKurikulumProdi;
use app\models\RppxLoadPengajaran;
use app\models\RppxRequestDosen;
use Yii;
use yii\helpers\Url;
use common\models\LoginForm;
use backend\modules\admin\models\User;
use backend\modules\admin\models\Application;
use backend\modules\admin\models\Profile;
use backend\modules\admin\models\TelkomSsoUser;
use backend\modules\admin\models\UserConfig;
use backend\modules\admin\models\form\TelkomSsoUserResetForm;

use yii\web\ForbiddenHttpException;
/**
 * Needed for AJAX
 */

use common\components\SwitchHandler;

use yii\web\Response;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\db\Query;

class UserController extends \yii\web\Controller
{
    
    public $menuGroup = 'user-profile';
    
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * display user profile
     * @return [type] [description]
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        $this->layout = 'login';

        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(\Yii::$app->request->post()) && $model->login()) {

            return $this->goHome();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        \Yii::$app->user->logout(true);
        
        return $this->goHome();
    }

    public function actionReset()
    {
        return $this->render('reset');
    }

    public function actionChpass()
    {
        return $this->render('chpass');
    }

    public function actionSemester(){
        return $this->render('semester');
    }

    public function actionRequest(){
        $model = new InstProdi();
        $prodi = InstProdi::find()->all();
        $list_prodi = ArrayHelper::map($prodi,'singkatan_prodi','singkatan_prodi');
        $list_pengajar = HrdxPengajar::find()->all();
        $pegawai = HrdxPengajar::find()->innerJoinWith('pegawai')->all();
        $krkm_kuliah = KrkmKuliah::find()->all();
        
        $list_dosen = HrdxPengajar::find()->alias('a')
        ->select('nama as nama_pegawai, pengajar_id, kode_mk')->distinct()
        ->innerJoin('hrdx_pegawai j', 'a.pegawai_id = j.pegawai_id')
        ->asArray()->all();

        // $list_dosen = HrdxPegawai::find()->all();
        $data = Yii::$app->request->post();

        $jlh_data = sizeof($data)-1;
        $jlh_data /= 2;

        for($i = 1;$i<=$jlh_data;$i++){

            $model_request[$i] = new RppxRequestDosen;    
            $id_pengajar =  Yii::$app->request->post('nama_dosen_'.$i);
            $kode_mk = Yii::$app->request->post('matkul_'.$i);
            $ref_kbk = Yii::$app->request->post('prodi_'.$i);

            $model_request[$i]->pengajar_id = $id_pengajar;
            $model_request[$i]->kode_mk = $kode_mk;
            // $model_request[$i]->id_pemohon = 3;
            $model_request[$i]->status_request = 0;
            $model_request[$i]->ref_kbk_id = $ref_kbk;
            $model_request[$i]->save();
        }
        return $this->render('request',[
            'model' => $model,
            'all_prodi' => $prodi,
            'list_prodi' => $list_prodi,
            'list_pengajar' => $list_pengajar,
            'pegawai' => $pegawai,
            'krkm_kuliah' => $krkm_kuliah,
            'list_dosen' => $list_dosen,
            'data_dosen' => $data,
            ]);
    }
    public function getPengajarAndPegawai(){
        $query = new Query;
        $query->select('*')->from('{{%hrdx_pegawai}} pg');
        $query->join('INNER JOIN', '{{%hrdx_pengajar}} pn','pg.pegawai_id = pn.pegawai_id');
        $result = $query->all();
        return $result;
    }

    public function actionViewPenugasanByTa()
    {
        $selectedProdi = Yii::$app->request->post('selectedProdi');
        $krkm_kuliah = KrkmKuliah::find()->alias('kk')
        ->select('kk.kode_mk, kk.nama_kul_ind, kk.sks, rdp.sks_teori, 
                  rdp.sks_praktikum, rdp.kelas_tatap_muka, rdp.kelas_praktikum,
                  rdp.kelas_riil')
        ->innerJoin('rppx_detail_kuliah rdp', 'kk.kuliah_id = rdp.kuliah_id')
        ->asArray()->all(); 

        foreach($krkm_kuliah as $matkul){
        }

        return $this->render(
            'view-penugasan-by-ta',
            [
                'selectedProdi' => $selectedProdi,
                'list_matkul' => $krkm_kuliah
            ]
        );
    }

    public function actionViewPenugasanByBaak()
    {
        $prodi = InstProdi::find()->all();
        $list_prodi = ArrayHelper::map($prodi,'singkatan_prodi','singkatan_prodi');
        $selectedProdi = Yii::$app->request->post('selectedProdi');
        $krkm_kuliah = KrkmKuliah::find()->alias('kk')
        ->select('kk.kode_mk, kk.nama_kul_ind, kk.sks, rdp.sks_teori, 
                  rdp.sks_praktikum, rdp.kelas_tatap_muka, rdp.kelas_praktikum,
                  rdp.kelas_riil')
        ->innerJoin('rppx_detail_kuliah rdp', 'kk.kuliah_id = rdp.kuliah_id')
        ->asArray()->all();

        foreach($krkm_kuliah as $matkul){
        }

        return $this->render(
            'view-penugasan-by-baak',
            [
                'list_prodi' => $list_prodi,
                'selectedProdi' => $selectedProdi,
                'list_matkul' => $krkm_kuliah
            ]
        );
    }

    public function actionViewPenugasanByDosen()
    {
        $selectedProdi = Yii::$app->request->post('selectedProdi');
        $krkm_kuliah = KrkmKuliah::find()->alias('kk')
        ->select('app.penugasan_pengajaran_id,ap.pengajaran_id, kk.kode_mk, 
                  kk.nama_kul_ind, kk.sks, rdp.sks_teori,ap.kuliah_id,
                  rdp.sks_praktikum, rdp.kelas_tatap_muka, rdp.kelas_praktikum,
                  rdp.kelas_riil, hp.alias')
        ->innerJoin('adak_pengajaran ap', 'ap.kuliah_id = kk.kuliah_id')
        ->innerJoin('rppx_detail_kuliah rdp', 'ap.kuliah_id = rdp.kuliah_id')
        ->innerJoin('adak_penugasan_pengajaran app', 'app.pegawai_id = rdp.pegawai_id')
        ->innerJoin('hrdx_pegawai hp', 'hp.pegawai_id = app.pegawai_id')
        ->where('ap.ta = 1920')
        ->asArray()->all(); 


        foreach($krkm_kuliah as $matkul){

        }

        return $this->render(
            'view-penugasan-by-dosen',
            [
                'selectedProdi' => $selectedProdi,
                'list_matkul' => $krkm_kuliah
            ]
        );
    }

    public function actionRequestPenugasanDosen()
    {
        $prodi = InstProdi::find()->all();
        $list_prodi = ArrayHelper::map($prodi,'singkatan_prodi','singkatan_prodi');
        $selectedProdi = Yii::$app->request->post('selectedProdi');
        $krkm_kuliah = KrkmKuliah::find()->alias('kk')
        ->select('kk.kode_mk, kk.nama_kul_ind, kk.sks')
        ->asArray()->all(); 

        $load_dosen = RppxLoadPengajaran::find()->alias('rlp')
        ->select('hp.alias,hp.nip,rlp.load')->distinct()
        ->innerJoin('adak_penugasan_pengajaran app', 'rlp.pegawai_id = app.pegawai_id')
        ->innerJoin('hrdx_pegawai hp', 'app.pegawai_id = hp.pegawai_id')
        ->innerJoin('rppx_periode_pengajaran rrp', 'rrp.periode_pengajaran_id = rlp.periode_pengajaran_id')
        ->where('rrp.ta = 2021') //periode nya nanti dinamis
        ->andWhere('hp.ref_kbk_id = 1') // ref_kbk_id nya nanti dinamis
        ->asArray()->all();
        
        $semua_pegawai = HrdxPegawai::find()->asArray()->all();

        return $this->render(
            'request-penugasan-dosen',
            [
                'list_prodi' => $list_prodi,
                'selectedProdi' => $selectedProdi,
                'list_matkul' => $krkm_kuliah,
                'load_dosen' => $load_dosen,
                'list_pegawai' => $semua_pegawai
            ]
        );
    }

    public function actionApproval()
    {
        return $this->render('approval');
    }
    
}
