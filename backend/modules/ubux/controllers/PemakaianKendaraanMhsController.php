<?php

namespace backend\modules\ubux\controllers;

use Yii;
use backend\modules\ubux\models\PemakaianKendaraanMhs;
use backend\modules\ubux\models\search\PemakaianKendaraanMhsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;
use backend\modules\ubux\models\Dim;
use mPDF;
use backend\modules\ubux\models\PemakaianKendaraan;

/**
 * PemakaianKendaraanMhsController implements the CRUD actions for PemakaianKendaraanMhs model.
 * controller-id: pemakaian-kendaraan-mhs
 * controller-desc: Controller untuk me-manage data request pemakaian kendaraan oleh mahasiswa
 */
class PemakaianKendaraanMhsController extends Controller
{
    // ================= FILTER ==================
    public $dim_id;

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

    public function beforeAction($action)
    {
        $dim = Dim::find()->where('deleted != 1')->andWhere(['user_id' => Yii::$app->user->identity->user_id])->one();
        $this->dim_id = $dim->dim_id;
        return true;
    }

    /**
    * action-id: index
     * action-desc: Display all data
     * Lists all PemakaianKendaraanMhs models.
     * @return mixed
     */

    public function actionIndex()
    {
        $searchModel = new PemakaianKendaraanMhsSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => PemakaianKendaraanMhs::find()->where(['dim_id' => $this->dim_id])->andWhere('deleted!=1'),
            'sort' => ['defaultOrder' => ['updated_at' => SORT_DESC, 'created_at' => SORT_DESC]],
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
    * action-id: view
     * action-desc: Display a data
     * Displays a single PemakaianKendaraanMhs model.
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
    * action-id: view-by-kemahasiswaan
     * action-desc: Display a data as kemahasiswaan
    */
    public function actionViewByKemahasiswaan($id)
    {
        return $this->render('viewByKemahasiswaan', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
    * action-id: add
     * action-desc: Menambah data request
     * Creates a new PemakaianKendaraanMhs model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAdd()
    {
        $model = new PemakaianKendaraanMhs();

        if ($model->load(Yii::$app->request->post())) {

            $dimModel = Dim::findOne($this->dim_id);

            $model->dim_id = $dimModel->dim_id;
            $model->save();

//            get the instance of the uploaded file
            $id = $model->pemakaian_kendaraan_mhs_id;

            $proposalName = $model->mahasiswa->nama;
            $model->file = UploadedFile::getInstance($model, 'file');
            $model->file->saveAs('proposal/'.$id.' Proposal '.$proposalName.'.'.$model->file->extension);

//            save the path in the db column
            $model->proposal = 'proposal/'.$id.'. Proposal '.$proposalName.'.'.$model->file->extension;

//            if(isset($_FILES['PemakaianKendaraanMhs']['name'])){
//
//                $result = \Yii::$app->fileManager->saveUploadedFiles();
//                if(isset($result)){
//                    if($result->status == 'success'){
//                        $model->kode_proposal = $result->fileinfo[0]->id;
//                        $model->proposal = $result->fileinfo[0]->name;
//                    }
//                    else{
//                        \Yii::$app->messenger->addErrorFlash('Error while uploading file !');
//                        return $this->redirect(\Yii::$app->request->referrer);
//                    }
//                }else{
//                         \Yii::$app->messenger->addErrorFlash('Error while uploading file !');
//                         return $this->redirect(\Yii::$app->request->referrer);
//                     }
//            }

            // ==================== Variabel Hard Code ==========================//
            // $userId = $model->dim_id;
            // $subject = "Permohonan Pemakaian Kendaraan";
            // $body = "Permohonan Pemakaian Kendaraan";

            // ==================== Email ==========================//
            // Yii::$app->messenger->sendEmailToUser($userId, $subject, $body);
            //Yii::$app->messenger->addSuccessFlash("Permohonan Pemakaian Kendaraan Berhasil Dibuat");
            // Yii::$app->messenger->addSuccessFlash("Email Terkirim");

            if($model->save()){
                Yii::$app->messenger->addSuccessFlash("Permohonan Pemakaian Kendaraan Berhasil Dibuat");
                return $this->redirect(['view', 'id' => $model->pemakaian_kendaraan_mhs_id]);
            }
        } else {
            return $this->render('add', [
                'model' => $model,
            ]);
        }
    }

    /**
    * action-id: edit
     * action-desc: Memeperbaharui data request
     * Updates an existing PemakaianKendaraanMhs model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionEdit($id)
    {
        $model = $this->findModel($id);
        if($model->status_request_kemahasiswaan == 2 || $model->status_request_kemahasiswaan == 3){
            $searchModel = new PemakaianKendaraanMhsSearch();
            $dataProvider = new ActiveDataProvider([
                'query' => PemakaianKendaraanMhs::find()->where(['dim_id' => $this->dim_id])->andWhere('deleted!=1'),
                'sort' => ['defaultOrder' => ['updated_at' => SORT_DESC, 'created_at' => SORT_DESC]],
            ]);
            Yii::$app->messenger->addErrorFlash("Tidak bisa mengubah, Sudah di setujui/ditolak Kemahasiswaan");
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pemakaian_kendaraan_mhs_id]);
        } else {
            return $this->render('edit', [
                'model' => $model,
            ]);
        }
    }

    /**
    * action-id: del
     * action-desc: Menghapus data request
     * Deletes an existing PemakaianKendaraanMhs model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDel($id)
    {
        $model = $this->findModel($id);
        if($model->status_request_kemahasiswaan == 2 || $model->status_request_kemahasiswaan == 3){
            $searchModel = new PemakaianKendaraanMhsSearch();
            $dataProvider = new ActiveDataProvider([
                'query' => PemakaianKendaraanMhs::find()->where(['dim_id' => $this->dim_id])->andWhere('deleted!=1'),
                'sort' => ['defaultOrder' => ['updated_at' => SORT_DESC, 'created_at' => SORT_DESC]],
            ]);
            Yii::$app->messenger->addErrorFlash("Tidak bisa menghapus, Sudah di setujui Kemahasiswaan");
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
        $this->findModel($id)->softDelete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PemakaianKendaraanMhs model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PemakaianKendaraanMhs the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PemakaianKendaraanMhs::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    // Download Proposal ------------------------------------!!
    /*
    * action-id: download
    * action-desc: Men-download dokumen
    */
    public function actionDownload($id){
        $model = $this->findModel($id);
        $file = $model->proposal;
        $path = Yii::getAlias('@webroot').'/'.$file;
        if(file_exists($path)){
            Yii::$app->response->sendFile($path);
        }else{
            echo 'Error';
            echo 'File Tidak Ditemukan';
        }
    }

/*
    * action-id: pop-up
     * action-desc: Menampilakn halaman pop-up
*/
    public function actionPopUp(){
        return $this->render('PopUp');
    }

    /*
    * action-id: cetak
     * action-desc: Mencetak dokumen
*/
    public function actionCetak($id)
    {
        $pdf = $this->renderPartial('viewPdf', [
            'model' => $this->findModel($id),
        ]);
        $mpdf = new mPDF;
        $mpdf->WriteHTML($pdf);
        $mpdf->Output();
        exit;
    }

    // Kemahasiswaan -----------------------------------------------------------------
    /*
    * action-id: index-by-kemahasiswaan
     * action-desc: Display all data as kemahasiswaan
*/
    public function actionIndexByKemahasiswaan()
    {
        $searchModel = new PemakaianKendaraanMhsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('indexByKemahasiswaan', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

/*
    * action-id: accept
     * action-desc: Menyetujui request
*/
    public function actionAccept($id)
    {
        $model = $this->findModel($id);
        if($model->status_request_kemahasiswaan == 1){
            $modelBaru = new PemakaianKendaraan();
            $modelBaru->pemakaian_kendaraan_mhs_id = $model->pemakaian_kendaraan_mhs_id;
            $modelBaru->desc = $model->desc;
            $modelBaru->tujuan = $model->tujuan;
            $modelBaru->jumlah_penumpang_kendaraan = $model->jumlah_penumpang_kendaraan;
            $modelBaru->rencana_waktu_keberangkatan = $model->rencana_waktu_keberangkatan;
            $modelBaru->rencana_waktu_kembali = $model->rencana_waktu_kembali;
            $modelBaru->status_req_sekretaris_rektorat = 1;
            $modelBaru->status_request_kemahasiswaan = $model->status_request_kemahasiswaan;
            $modelBaru->jenis_keperluan_id = 1;
            $modelBaru->proposal = $model->proposal;
            $modelBaru->no_telepon = $model->no_telepon;

            if($modelBaru->save()){
                $model->status_request_kemahasiswaan = 2;
                $model->save();

                Yii::$app->messenger->addSuccessFlash("Berhasil");
                return $this->redirect('index-by-kemahasiswaan');
            }
        }else{
            $searchModel = new PemakaianKendaraanMhsSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            Yii::$app->messenger->addErrorFlash("Sudah disetujui/ditolak");
            return $this->render('indexByKemahasiswaan', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /*
    * action-id: reject
     * action-desc: Menolak request
*/
    public function actionReject($id)
    {
        $model = $this->findModel($id);
        $model->status_request_kemahasiswaan = 3;
        $model->save();

        $searchModel = new PemakaianKendaraanMhsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->redirect('index-by-kemahasiswaan');
    }

}
