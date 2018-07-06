<?php

namespace backend\modules\baak\controllers;

use Yii;
use mPDF;
use backend\modules\baak\models\SuratMagang;
use backend\modules\baak\models\search\SuratMagangSearch;
use backend\modules\baak\models\DimHasSuratMagang;
use backend\modules\baak\models\Dim;
use backend\modules\baak\models\NomorSuratTerakhir;
use backend\modules\baak\models\Pegawai;
use backend\modules\baak\models\DataSurat;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

/**
 * SuratMagangController implements the CRUD actions for SuratMagang model.
   * controller-id: surat-magang
 * controller-desc: Controller untuk me-manage data Surat Magang
 */
class SuratMagangController extends Controller
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

    /*
    * action-id: index
     * action-desc: Display all data
    */
    public function actionIndex()
    {
        $searchModel = new SuratMagangSearch();
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
        $searchModel = new SuratMagangSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('indexAdmin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SuratMagang model.
     * action-id: view
     * action-desc: Display a data
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $model->dims = '';
        foreach($model->dimHasSuratMagang as $s){
            $model->dims .= $s->dim->nama.', ';
        }
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /*
    * action-id: view-admin
     * action-desc: Display a data by admin
    */
    public function actionViewAdmin($id)
    {
        $model = $this->findModel($id);
        $model->dims = '';
        foreach($model->dimHasSuratMagang as $s){
            $model->dims .= $s->dim->nama.', ';
        }
        return $this->render('viewAdmin', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new SuratMagang model.
     * action-id: add
     * action-desc: Tambah data
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAdd()
    {
        $model = new SuratMagang();
        $dim = new DimHasSuratMagang();

        if ($model->load(Yii::$app->request->post())) {
            $today = time();
            $validDate =strtotime("+1 days", $today);

            if(strtotime($model->waktu_awal_magang) < $validDate || strtotime($model->waktu_akhir_magang) < $validDate){
                \Yii::$app->messenger->addWarningFlash('Tanggal sudah lewat.');
                return $this->redirect(\Yii::$app->request->referrer);
            }

            else if(strtotime($model->waktu_akhir_magang) < strtotime($model->waktu_awal_magang)){
                \Yii::$app->messenger->addWarningFlash('Waktu awal dan waktu akhir tidak sesuai.');
                return $this->redirect(\Yii::$app->request->referrer);
            }

            $user_id = Yii::$app->user->identity->id;
            $user_dim = Dim::find()->where(['user_id'=> $user_id])->one();
            $pemohon = $user_dim->dim_id;
            $model->pemohon_id = $pemohon;

            return $this->redirect(['view', 'id' => $model->surat_magang_id]);
        } else {
            return $this->render('add', [
                'model' => $model,
                'dim' => $dim,
            ]);
        }
    }

    /*
    * action-id: add-mahasiswa
     * action-desc: Tambah data mahasiswa pada surat
    */
    public function actionAddMahasiswa($query)
    {
        $data = [];
        $dims = Dim::find()
                    ->select('dim_id, nim, nama')
                    ->where('nim LIKE :query')
                    ->orWhere('nama LIKE :query')
                    ->andWhere('deleted!=1')
                    ->andWhere(['status_akhir'=>'Aktif'])
                    ->addParams([':query' => '%'.$query.'%'])
                    ->limit(10)
                    ->asArray()
                    ->all();
        foreach ($dims as $dim) {
            $dataValue = $dim['nim'] .' '. $dim['nama'];
            $data []  = [
                            'value' => $dim['dim_id'],
                            'data' => $dataValue
                        ];
        }
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        echo Json::encode($data);
    }

    /**
     * Updates an existing SuratMagang model.
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
            $today = time();
            $validDate =strtotime("+1 days", $today);

            if(strtotime($model->waktu_awal_magang) < $validDate || strtotime($model->waktu_akhir_magang) < $validDate){
                \Yii::$app->messenger->addWarningFlash('Tanggal sudah lewat.');
                return $this->redirect(\Yii::$app->request->referrer);
            }

            else if(strtotime($model->waktu_akhir_magang) < strtotime($model->waktu_awal_magang)){
                \Yii::$app->messenger->addWarningFlash('Waktu awal dan waktu akhir tidak sesuai.');
                return $this->redirect(\Yii::$app->request->referrer);
            }
            return $this->redirect(['view', 'id' => $model->surat_magang_id]);
        } else {
            return $this->render('edit', [
                'model' => $model,
            ]);
        }
    }

    /*
    * action-id: edit-dim
     * action-desc: Memperbaharui data mahasiswa pada surat
    */
    public function actionEditDim($id)
    {
        $model = $this->findModel($id);
        $dim = new DimHasSuratMagang();
        $model->dims = '';
        foreach($model->dimHasSuratMagang as $s){
            $model->dims .= $s->dim->nama.', ';
        }

        if ($dim->load(Yii::$app->request->post())) {
            if(DimHasSuratMagang::find()->where(['surat_magang_id' => $model->surat_magang_id])->andWhere(['dim_id' => $dim->dim_id])->exists()){
                \Yii::$app->messenger->addWarningFlash('Mahasiswa telah terdaftar.');
                return $this->redirect(\Yii::$app->request->referrer);
            }            
            else if($dim->dim_id == null)
            {
                \Yii::$app->messenger->addWarningFlash('Data Mahasiswa tidak sesuai.');
                return $this->redirect(\Yii::$app->request->referrer);
            }
            $model->save();
            $dim->surat_magang_id = $id;
            $dim->save();

            return $this->redirect(['view', 'id' => $model->surat_magang_id]);
        } else {
            return $this->render('editDim', [
                'model' => $model,
                'dim' => $dim,
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

            return $this->redirect(['view-admin', 'id' => $model->surat_magang_id]);
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
    * action-id: edit-ready
     * action-desc: Mengubah status permohonan menjadi ready
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

            return $this->redirect(['view-admin', 'id' => $model->surat_magang_id]);
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
                \Yii::$app->messenger->addWarningFlash('Harap Mengisi Alasan Penolakan.');
                return $this->redirect(\Yii::$app->request->referrer);
            }
            $user_id = Yii::$app->user->identity->id;
            $user_pegawai = Pegawai::find()->where(['user_id'=> $user_id])->one();
            $pegawai = $user_pegawai->pegawai_id;
            $model->pegawai_id = $pegawai;
            $model->status_pengajuan_id=3;
            $model->save();

            return $this->redirect(['view-admin', 'id' => $model->surat_magang_id]);
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
    * action-id: edit-done
     * action-desc: Mengubah status menjadi done
    */
    public function actionEditDone($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $user_id = Yii::$app->user->identity->id;
            $user_pegawai = Pegawai::find()->where(['user_id'=> $user_id])->one();
            $pegawai = $user_pegawai->pegawai_id;
            $model->pegawai_id = $pegawai;

            $model->save();

            return $this->redirect(['view-admin', 'id' => $model->surat_magang_id]);
        }
        else {
            $model->status_pengajuan_id = 5;
            $user_id = Yii::$app->user->identity->id;
            $user_pegawai = Pegawai::find()->where(['user_id'=> $user_id])->one();
            $pegawai = $user_pegawai->pegawai_id;
            $model->pegawai_id = $pegawai;
            $model->save();

            return $this->redirect(\Yii::$app->request->referrer);
        }
    }

    /*
    * action-id: add-pdf
     * action-desc: Tambah data lampiran
    */
    public function actionAddPdf($id)
    {
        $idx = 1;
        $query = DimHasSuratMagang::find()->where(['surat_magang_id' => $id])->all();
        $header = DataSurat::find()->one();
        $mPDF = new mPDF('utf-8','A4',11,'serif');
        $mPDF->WriteHTML($this->renderPartial('mpdf',
            ['model' => $this->findModel($id), 
            'idx' => $idx,
            'query' => $query,
            'header' => $header,]));
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
        $nomor_surat = NomorSuratTerakhir::find()->one();

        if ($model->load(Yii::$app->request->post())) {
            if($model->nomor_surat_lengkap == null){
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
            $nomor_surat_lengkap = $n.'/ITD/SPer/Magang/BAAK/'.$month.'/'.$year;
          
            $user_id = Yii::$app->user->identity->id;
            $user_pegawai = Pegawai::find()->where(['user_id'=> $user_id])->one();
            $pegawai = $user_pegawai->pegawai_id;
            $model->pegawai_id = $pegawai;
            $model->nomor_surat_lengkap = $nomor_surat_lengkap;
            $model->save();

            return $this->redirect(['add-pdf', 'id' => $model->surat_magang_id]);
        }
        else {
            $user_id = Yii::$app->user->identity->id;
            $user_pegawai = Pegawai::find()->where(['user_id'=> $user_id])->one();
            $pegawai = $user_pegawai->pegawai_id;
            $model->pegawai_id = $pegawai;
            $model->save();

            return $this->render('editPdf', [
                'model' => $model,
                'nomor_surat' => $nomor_surat,
            ]);
        }
    }

    /**
     * Deletes an existing SuratMagang model.
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
     * Finds the SuratMagang model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SuratMagang the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SuratMagang::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}