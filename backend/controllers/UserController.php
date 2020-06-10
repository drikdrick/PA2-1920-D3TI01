<?php

namespace backend\controllers;

use app\models\HrdxPegawai;
use app\models\HrdxPengajar;
use app\models\InstProdi;
use app\models\KrkmKuliah;
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


        return $this->render('request',[
            'model' => $model,
            'list_prodi' => $list_prodi,
            'list_pengajar' => $list_pengajar,
            'pegawai' => $pegawai,
            'krkm_kuliah' => $krkm_kuliah
            ]);
    }

    public function getPengajarAndPegawai(){
        $query = new Query;
        $query->select('*')->from('{{%hrdx_pegawai}} pg');
        $query->join('INNER JOIN', '{{%hrdx_pengajar}} pn','pg.pegawai_id = pn.pegawai_id');
        $result = $query->all();
        return $result;
    }

    public function actionPenugasanDosen()
    {
        // $krkm_kuliah = new KrkmKuliah; 
        $krkm_kuliah = KrkmKuliah::find()->all();
        $pengajar= new HrdxPengajar();
        $list_pengajar = HrdxPengajar::find()->all(); 
        $model = new InstProdi();
        $prodi = InstProdi::find()->all();
        $list_prodi = ArrayHelper::map($prodi,'singkatan_prodi','singkatan_prodi');
        //$list_pengajar = ArrayHelper::map($list_pengajar,'pegawai_id','pegawai_id');
        $pegawai = HrdxPengajar::find()->innerJoinWith('pegawai')->all();
        // $pegawai = $pegawai = HrdxPengajar::find()->all();

        $query = new Query;
        $query->select('*')->from('{{%hrdx_pegawai}} pg');
        $query->join('INNER JOIN', '{{%hrdx_pengajar}} pn','pg.pegawai_id = pn.pegawai_id');
        $pegawaiAndPengajar = $query->all();        


        return $this->render(
            'penugasan-dosen',
            [
                'model' => $model,
                'list_prodi' => $list_prodi,
                'list_pengajar' => $list_pengajar,
                'model_pengajar' => $pengajar,
                'krkm_kuliah' => $krkm_kuliah,
                'model_pegawai' => $pegawai,
                'pegawai_pengajar' => $pegawaiAndPengajar,
            ]
        );
    }
    public function actionApproval()
    {
        return $this->render('approval');
    }
    
}
