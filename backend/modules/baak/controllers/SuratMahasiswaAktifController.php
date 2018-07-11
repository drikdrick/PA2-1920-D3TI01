<?php

namespace backend\modules\baak\controllers;

use Yii;
use mPDF;
use backend\modules\baak\models\SuratMahasiswaAktif;
use backend\modules\baak\models\search\SuratMahasiswaAktifSearch;
use backend\modules\baak\models\Dim;
use backend\modules\baak\models\Prodi;
use backend\modules\baak\models\NomorSuratTerakhir;
use backend\modules\baak\models\Pegawai;
use backend\modules\baak\models\DataSurat;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SuratMahasiswaAktifController implements the CRUD actions for SuratMahasiswaAktif model.
   * controller-id: surat-mahasiswa-aktif
 * controller-desc: Controller untuk me-manage data Surat Mahasiswa Aktif
 */
class SuratMahasiswaAktifController extends Controller
{
    public function behaviors()
    {
        return [
            //TODO: crud controller actions are bypassed by default, set the appropriate privilege
            'privilege' => [
                 'class' => \Yii::$app->privilegeControl->getAppPrivilegeControlClass(),
                 'skipActions' => [],
                ],
                
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all SuratMahasiswaAktif models.
     * action-id: index
     * action-desc: Display all data
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SuratMahasiswaAktifSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $user_id = Yii::$app->user->identity->id;
        $user_dim = Dim::find()->where(['user_id'=> $user_id])->one();
        $pemohon = $user_dim->dim_id;
        $dataProvider->query->andWhere("pemohon_id = '$pemohon'");

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /*
    * action-id: index-admin
     * action-desc: Display all data by admin
    */
    public function actionIndexAdmin()
    {
        $searchModel = new SuratMahasiswaAktifSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('indexAdmin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SuratMahasiswaAktif model.
     * action-id: view
     * action-desc: Display a data
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /*
    * action-id: view-admin
     * action-desc: Display a data by admin
    */
    public function actionViewAdmin($id)
    {
        return $this->render('viewAdmin', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SuratMahasiswaAktif model.
     * action-id: add
     * action-desc: Tambah data
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAdd()
    {
        $model = new SuratMahasiswaAktif();

        if ($model->load(Yii::$app->request->post())) {
            $user_id = Yii::$app->user->identity->id;
            $dim = Dim::find()->where(['user_id'=> $user_id])->one();
            $pemohon = $dim->dim_id;
            $model->pemohon_id = $pemohon;
            $model->save();

            return $this->redirect(['index']);
        } else {
            return $this->render('add', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing SuratMahasiswaAktif model.
     * action-id: edit
     * action-desc: Memperbaharui data
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionEdit($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->surat_mahasiswa_aktif_id]);
        } else {
            return $this->render('edit', [
                'model' => $model,
            ]);
        }
    }

    /*
    * action-id: edit-accept
     * action-desc: Menyetujui permohonan
    */
    public function actionEditAccept($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $user_id = Yii::$app->user->identity->id;
            $user_pegawai = Pegawai::find()->where(['user_id'=> $user_id])->one();
            $pegawai = $user_pegawai->pegawai_id;
            $model->pegawai_id = $pegawai;

            $model->save();

            return $this->redirect(['view-admin', 'id' => $model->surat_mahasiswa_aktif_id]);
        }
        else {
            $model->status_pengajuan_id = 2;
            $user_id = Yii::$app->user->identity->id;
            $user_pegawai = Pegawai::find()->where(['user_id'=> $user_id])->one();
            $pegawai = $user_pegawai->pegawai_id;
            $model->pegawai_id = $pegawai;
            $model->save();

            return $this->redirect(\Yii::$app->request->referrer);
        }
    }

    /*
    * action-id: edit-done
     * action-desc: Memperbaharu status permohonan menjadi done
    */
    public function actionEditDone($id)
    {
        $model = $this->findModel($id);

        if($model->load(Yii::$app->request->post()))
        {
            $user_id = Yii::$app->user->identity->id;
            $user_pegawai = Pegawai::find()->where(['user_id'=>$user_id])->one();
            $pegawai = $user_pegawai->pegawai_id;
            $model->pegawai_id = $pegawai;
            $model->save();

            return $this->redirect(['view-admin','id' => $model->surat_mahasiswa_aktif_id]);
        }
        else{
            $model->status_pengajuan_id = 5;
            $user_id = Yii::$app->user->identity->id;
            $user_pegawai = Pegawai::find()->where(['user_id'=>$user_id])->one();
            $pegawai = $user_pegawai->pegawai_id;
            $model->pegawai_id = $pegawai;
            $model->save();

            return $this->redirect('index-admin');

        }   
    }

    /*
    * action-id: edit-ready
     * action-desc: Memperbaharu status permohonan menjadi ready
    */
    public function actionEditReady($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if($model->waktu_pengambilan == NULL)
            {
                \Yii::$app->messenger->addWarningFlash('Harap Mengisi Waktu Pengambilan.');
                return $this->redirect(\Yii::$app->request->referrer);
            }
            $user_id = Yii::$app->user->identity->id;
            $user_pegawai = Pegawai::find()->where(['user_id'=> $user_id])->one();
            $pegawai = $user_pegawai->pegawai_id;
            $model->pegawai_id = $pegawai;
            $model->status_pengajuan_id=4;
            $model->save();

            return $this->redirect(['view-admin', 'id' => $model->surat_mahasiswa_aktif_id]);
        }
        else {
            $user_id = Yii::$app->user->identity->id;
            $user_pegawai = Pegawai::find()->where(['user_id'=> $user_id])->one();
            $pegawai = $user_pegawai->pegawai_id;
            $model->pegawai_id = $pegawai;
            $model->save();

            return $this->render('editReady', [
                'model' => $model,
            ]);
        }
    }

    /*
    * action-id: edit-decline
     * action-desc: Menolak permohonan
    */
    public function actionEditDecline($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            if($model->alasan_penolakan == NULL)
            {
                \Yii::$app->messenger->addWarningFlash('Anda Harus Mengisi Alasan Penolakan');
                    return $this->redirect(\Yii::$app->request->referrer);

            }

            $user_id = Yii::$app->user->identity->id;
            $user_pegawai = Pegawai::find()->where(['user_id'=> $user_id])->one();
            $pegawai = $user_pegawai->pegawai_id;
            $model->pegawai_id = $pegawai;
            $model->status_pengajuan_id=3;
            $model->save();

            return $this->redirect(['view-admin', 'id' => $model->surat_mahasiswa_aktif_id]);
        }
        else {
            $user_id = Yii::$app->user->identity->id;
            $user_pegawai = Pegawai::find()->where(['user_id'=> $user_id])->one();
            $pegawai = $user_pegawai->pegawai_id;
            $model->pegawai_id = $pegawai;
            $model->save();

            return $this->render('editDecline', [
                'model' => $model,
            ]);
        }
    }

    /*
    * action-id: add-pdf
     * action-desc: Tambah data lampiran
    */
    public function actionAddPdf($id)
    {
        $model = SuratMahasiswaAktif::find()->where(['surat_mahasiswa_aktif_id' => $id])->one();
        $dim = Dim::find()->where(['dim_id' => $model->pemohon_id])->one();
        $prodi = Prodi::find()->where(['ref_kbk_id' => $dim->ref_kbk_id])->one();
        $header = DataSurat::find()->one();
        $mPDF = new mPDF('utf-8','A4',12,'serif');
        $mPDF->WriteHTML($this->renderPartial('mpdf',
            ['model' => $model,
            'dim' => $dim,
            'prodi' => $prodi,
            'header' => $header,
        ]));
        $mPDF->debug = true;
        $mPDF->Output();
        exit;
    }

    /*
    * action-id: edit-pdf
     * action-desc: Memperbaharui data lampiran
    */
    public function actionEditPdf($id)
    {
        $model = $this->findModel($id);
        $model_nomor_surat = NomorSuratTerakhir::find()->one();

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->nomor_surat == NULL)
            {
                \Yii::$app->messenger->addWarningFlash('Ada Form Yang Belum Anda isi');
                    return $this->redirect(\Yii::$app->request->referrer);

            }

            if($model->nomor_surat_lengkap == NULL)
            {
                $model_nomor_surat->nomor_surat = $model->nomor_surat;
                $model_nomor_surat->save();
                $nomor_surat->nomor_surat = $model->nomor_surat;
                $nomor_surat->save();
            }


            $dateToday = date('Y-m-d');
            $model->tanggal_surat = $dateToday;

            $getMonth = array('I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII');
            
            $month = $getMonth[date('n', strtotime($dateToday))-1];

            $year = date('y', strtotime($dateToday));
            $nomor = $model->nomor_surat;
            $n = '';  
            if($nomor < 10){
                $n = '00'.$nomor.'';
            }  
            else if($nomor < 100){
                $n = '0'.$nomor.'';
            }
            else if($nomor >= 100){
                $n = $nomor;
            }
            $nomor_surat_lengkap = $n.'/ITDel/SKet/BAAK/'.$month.'/'.$year;
          
            $user_id = Yii::$app->user->identity->id;
            $user_pegawai = Pegawai::find()->where(['user_id'=> $user_id])->one();
            $pegawai = $user_pegawai->pegawai_id;
            $model->pegawai_id = $pegawai;
            $model->nomor_surat_lengkap = $nomor_surat_lengkap;
            $model->save();

          

            return $this->redirect(['add-pdf', 'id' => $model->surat_mahasiswa_aktif_id]);
        }
        else {
            $user_id = Yii::$app->user->identity->id;
            $user_pegawai = Pegawai::find()->where(['user_id'=> $user_id])->one();
            $pegawai = $user_pegawai->pegawai_id;
            $model->pegawai_id = $pegawai;
            $model->save();

            return $this->render('editPdf', [
                'model' => $model,
                'model_nomor_surat' => $model_nomor_surat,
            ]);
        }
    }

    /**
     * Deletes an existing SuratMahasiswaAktif model.
     * action-id: del
     * action-desc: Menghapus data
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDel($id)
    {
        $this->findModel($id)->softDelete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SuratMahasiswaAktif model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SuratMahasiswaAktif the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SuratMahasiswaAktif::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
