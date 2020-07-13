<?php

namespace backend\controllers;

use app\models\AdakPenugasanPengajaran;
use app\models\HrdxPegawai;
use app\models\AdakPengajaran;
use app\models\HrdxPengajar;
use app\models\InstProdi;
use app\models\KrkmKuliah;
use app\models\KrkmKurikulumProdi;
use app\models\RppxDetailKuliah;
use app\models\RppxLoadPengajaran;
use app\models\RppxRequestDosen;
use app\models\RppxPengajuanPengajaran;
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
        $krkm_kuliah = AdakPenugasanPengajaran::find()->alias('app')
        ->select('kk.kode_mk, kk.nama_kul_ind, kk.sks, rdp.sks_teori,ap.kuliah_id,
                  rdp.sks_praktikum, rdp.kelas_tatap_muka, rdp.kelas_praktikum,
                  rdp.kelas_riil, hp.alias, rdp.persentasi_beban')
        ->innerJoin('adak_pengajaran ap', 'app.pengajaran_id = ap.pengajaran_id')
        ->innerJoin('hrdx_pegawai hp', 'app.pegawai_id = hp.pegawai_id')
        ->innerJoin('krkm_kuliah kk', 'ap.kuliah_id=kk.kuliah_id')
        ->innerJoin('rppx_detail_kuliah rdp', 'kk.kuliah_id = rdp.kuliah_id')
        ->where('ap.ta = 1920')->asArray()->all(); //TA masih harus diganti

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
    public function actionReqDosen(){
        $prodi = InstProdi::find()->all();
        $list_prodi = ArrayHelper::map($prodi,'singkatan_prodi','singkatan_prodi');
        $selectedProdi = Yii::$app->request->post('selectedProdi');
        $krkm_kuliah = KrkmKuliah::find()->alias('kk')
        ->select('kk.kode_mk, kk.nama_kul_ind, kk.sks')
        ->innerJoin('adak_pengajaran ap', 'kk.kuliah_id = ap.kuliah_id')
        ->where('ap.ta = 1920')->asArray()->all(); //TA masih harus diganti

        $dataProvider = new \yii\data\ArrayDataProvider([
            'key'=>'kode_mk',
            'allModels' => $krkm_kuliah,
        ]);

        return $this->render(
            'req-dosen',
            [
                'list_prodi' => $list_prodi,
                'selectedProdi' => $selectedProdi,
                'list_matkul' => $krkm_kuliah,
                'dataProvider' => $dataProvider
            ]
        );
    }

    public function actionApproves($id){
        $model = RppxPengajuanPengajaran::findOne($id);
        $data_load = KrkmKuliah::find()->alias('kk')
        ->select('ap.pengajaran_id,kk.sks, rdk.kelas_tatap_muka, rdk.kelas_riil,
                  rdk.persentasi_beban,rpp.pegawai_id')
        ->innerJoin('rppx_detail_kuliah rdk','kk.kuliah_id = rdk.kuliah_id')
        ->innerJoin('rppx_pengajuan_pengajaran rpp','rpp.load_detail_id = rdk.load_detail_id')
        ->innerJoin('adak_pengajaran ap','rpp.pengajaran_id = ap.pengajaran_id')
        ->where(['rpp.pengajuan_id' => $id])->asArray()->all();
        foreach($data_load as $info){
            $sks = $info['sks'];
            $tatap_muka = $info['kelas_tatap_muka'];
            $kelas_riil = $info['kelas_riil'];
            $persentase = $info['persentasi_beban'];
            $pengajaran_id = $info['pengajaran_id'];
            $pegawai_id = $info['pegawai_id'];
        }
        $jlh_load = ((($sks*1)
                      +($sks*$tatap_muka)
                      +($sks*$kelas_riil))/3)
                      *($persentase/100);
        $model->status_request=1;
        $load_terpilih = RppxLoadPengajaran::find()->where(['pengajaran_id' => $pengajaran_id])->andWhere(['pegawai_id' => $pegawai_id])->asArray()->all();
        foreach($load_terpilih as $data){
            $load_pengajaran_id = $data['load_pengajaran_id'];
        }
        $load_dosen = RppxLoadPengajaran::findOne(['load_pengajaran_id' => $load_pengajaran_id]);
        $load_dosen->load += $jlh_load;
        $load_dosen->save();
        if($model->save()){
            Yii::$app->session->setFlash('msgSuccess', 'Berhasi menyetujui!'
    );
        }else{
            Yii::$app->session->setFlash('msgFailed', 'Gagal!'
    );
            
        }
        return $this->redirect(['approval']);
    }

    public function actionFormRequest($id){
        $dosen = HrdxPegawai::find()->all();
        $list_dosen = ArrayHelper::map($dosen,'alias','alias');
        $data_post = Yii::$app->request->post();
        // echo sizeof($data_post);
        $matkul = AdakPengajaran::find()->alias('ap')
        ->select('kk.kode_mk, kk.nama_kul_ind, kk.sks,rdk.sks_teori,
                  rdk.sks_praktikum,  rdk.kelas_tatap_muka,ap.kuliah_id,
                  rdk.kelas_riil,rdk.kelas_praktikum, ap.pengajaran_id,')
        ->innerJoin('krkm_kuliah kk', 'kk.kuliah_id = ap.kuliah_id')
        ->innerJoin('rppx_detail_kuliah rdk','kk.kuliah_id = rdk.kuliah_id')
        ->where('ap.ta = 1920')->andWhere(['kode_mk' => $id])
        ->asArray()->all();

        $load_dosen = RppxLoadPengajaran::find()->alias('rlp')
        ->select('hp.alias,hp.nip,rlp.load,ap.pengajaran_id')->distinct()
        ->innerJoin('adak_penugasan_pengajaran app', 'rlp.pegawai_id = app.pegawai_id')
        ->innerJoin('hrdx_pegawai hp', 'app.pegawai_id = hp.pegawai_id')
        ->innerJoin('adak_pengajaran ap', 'ap.pengajaran_id = rlp.pengajaran_id')
        ->where('ap.ta = 2021') //periode nya nanti dinamis
        ->andWhere('hp.ref_kbk_id = 1') // ref_kbk_id nya nanti dinamis
        ->asArray()->all();
        
        $data = Yii::$app->request->post();
            

        if(Yii::$app->request->post()){
            
            if(empty($data_post)){
                return $this->render(
                    'form-request',
                    [
                        'list_dosen' => $list_dosen,
                        'matkul' => $matkul,
                        'load_dosen' => $load_dosen,
                        'data_post' => $data_post
                    ]
                );
            }else{
                var_dump($data);
                if($data_post['koordinator'] != NULL){
                    $load_detail = new RppxDetailKuliah();
                    $load_detail->kuliah_id = $data_post['kuliah_id'];
                    $load_detail->pegawai_id = $data_post['koordinator'];
                    $load_detail->kelas_riil = $data_post['kelas_riil'];
                    $load_detail->kelas_tatap_muka = $data_post['kelas_tatap_muka'];
                    $load_detail->kelas_praktikum = $data_post['kelas_praktikum'];
                    $load_detail->persentasi_beban = $data_post['beban_koordinator'];
                    $load_detail->save();

                    $model_rpp = new RppxPengajuanPengajaran();
                    $model_rpp->pengajaran_id = $data_post['pengajaran_id'];
                    $model_rpp->pegawai_id = $data_post['koordinator'];
                    $model_rpp->role_pengajar_id = 1;
                    $model_rpp->is_fulltime = 1;
                    $model_rpp->status_request = -1;
                    $model_rpp->load_detail_id = $load_detail->load_detail_id;
                    $model_rpp->save();

                for($i = 1;$i<=6;$i++){

                    if($data_post['dosen'.$i] != null){
                        $load_detail = new RppxDetailKuliah();
                        $load_detail->kuliah_id = $data_post['kuliah_id'];
                        $load_detail->pegawai_id = $data_post['dosen'.$i];
                        $load_detail->kelas_riil = $data_post['kelas_riil'];
                        $load_detail->kelas_tatap_muka = $data_post['kelas_tatap_muka'];
                        $load_detail->kelas_praktikum = $data_post['kelas_praktikum'];
                        $load_detail->persentasi_beban = $data_post['beban_dosen'.$i];
                        $load_detail->save();
    
                        $model_rpp = new RppxPengajuanPengajaran();
                        $model_rpp->pengajaran_id = $data_post['pengajaran_id'];
                        $model_rpp->pegawai_id = $data_post['dosen'.$i];
                        $model_rpp->role_pengajar_id = 1;
                        $model_rpp->is_fulltime = 1;
                        $model_rpp->status_request = -1;
                        $model_rpp->load_detail_id = $load_detail->load_detail_id;
                        $model_rpp->save();
                    }
                }
            }
            return $this->redirect(['req-dosen']);
            }
        }
    }
}
    

