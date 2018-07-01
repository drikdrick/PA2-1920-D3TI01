<?php

namespace backend\modules\ubux\controllers;

use backend\modules\ubux\models\Kendaraan;
use backend\modules\ubux\models\Supir;
use Yii;
use backend\modules\ubux\models\PemakaianKendaraan;
use backend\modules\ubux\models\search\PemakaianKendaraanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;
use yii\bootstrap\Alert;
use mPDF;
use backend\modules\ubux\models\PemakaianKendaraanMhs;
use backend\modules\ubux\models\Pegawai;

/**
 * PemakaianKendaraanController implements the CRUD actions for PemakaianKendaraan model.
 * controller-id: pemakaian-kendaraan
 * controller-desc: Controller untuk me-manage data request pemakaian kendaraan
 */
class PemakaianKendaraanController extends Controller
{
    // ====================== FILTER =======================
    public $pegawai_id;

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
        $pegawai = Pegawai::find()->where('deleted != 1')->andWhere(['user_id' => Yii::$app->user->identity->user_id])->one();
        $this->pegawai_id = $pegawai->pegawai_id;
        return true;
    }

    /**
    * action-id: index
     * action-desc: Display all data
     * Lists all PemakaianKendaraan models.
     * @return mixed
     */

    public function actionIndex()
    {
        $searchModel = new PemakaianKendaraanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('indexBySekretarisRektorat', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
    * action-id: view
     * action-desc: Display a data
     * Displays a single PemakaianKendaraan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
    * action-id: add
     * action-desc: Menambah Data
     * Creates a new PemakaianKendaraan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAdd()
    {
        $model = new PemakaianKendaraan();

        if ($model->load(Yii::$app->request->post())) {

            // get the instance of the uploaded file
            $id = $model->pemakaian_kendaraan_id;
            $proposalName = $model->pegawai->nama;
            $model->file = UploadedFile::getInstance($model, 'file');
            $model->file->saveAs('proposal/'.$id.'. Proposal '.$proposalName.'.'.$model->file->extension);

            // save the path in the db column
            $model->proposal = 'proposal/'.$id.'. Proposal '.$proposalName.'.'.$model->file->extension;
            $model->save();
            //Yii::$app->messenger->addSuccessFlash("Message flash berhasil dibuat!!");
            return $this->redirect(['view', 'id' => $model->pemakaian_kendaraan_id]);
        } else {
            return $this->render('add', [
                'model' => $model,
            ]);
        }
    }

    /**
    * action-id: edit
     * action-desc: Memperbaharui data
     * Updates an existing PemakaianKendaraan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionEdit($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pemakaian_kendaraan_id]);
        } else {
            return $this->render('edit', [
                'model' => $model,
            ]);
        }
    }

    /**
    * action-id: del
     * action-desc: Menghapus data
     * Deletes an existing PemakaianKendaraan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDel($id)
    {
        $model = $this->findModel($id);
        $this->findModel($id)->softDelete();

        if($model->jenis_keperluan_id == 2){
            return $this->actionIndexByPegawai();
        }elseif ($model->jenis_keperluan_id == 3){
            return $this->actionIndexByPribadi();
        }
    }

    /**
     * Finds the PemakaianKendaraan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PemakaianKendaraan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PemakaianKendaraan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /*
    * action-id: pop-up
     * action-desc: Menampilkan halaman pop-up
    */
    public function actionPopUp(){
        return $this->render('PopUp.php');
    }

    // Untuk Kemahasiswaan !!---------------------------------------------------------------!!

    /*
    * action-id: index-by-kemahasiswaan
    * action-desc: Display all data by kemahasiswaan view
    */
    public function actionIndexByKemahasiswaan()
    {
        $searchModel = new PemakaianKendaraanSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => PemakaianKendaraan::find()->where(['jenis_keperluan_id' => 1])->andWhere('deleted!=1'),
        ]);

        return $this->render('indexByKemahasiswaan', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /*
    * action-id: accept
    * action-desc: Menyetujui request
    */
    public function actionAccept($id){
        $model = PemakaianKendaraan::findOne($id);

        $model->status_request_kemahasiswaan = 2;
        $model->save();

        $searchModel = new PemakaianKendaraanSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => PemakaianKendaraan::find()->where(['jenis_keperluan_id' => 1])->andWhere('deleted!=1'),
        ]);

        return $this->render('indexByKemahasiswaan', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /*
    * action-id: reject
    * action-desc: Menolak request
    */
    public function actionReject($id){
        $model = PemakaianKendaraan::findOne($id);
        $model->status_request_kemahasiswaan = 3;
        $model->status_req_sekretaris_rektorat = 3;
        $model->save();

        $searchModel = new PemakaianKendaraanSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => PemakaianKendaraan::find()->where(['jenis_keperluan_id' => 1])->andWhere('deleted!=1'),
            'sort' => ['defaultOrder' => ['updated_at' => SORT_DESC, 'created_at' => SORT_DESC]],
        ]);

        return $this->render('indexByKemahasiswaan', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /*
    * action-id: view-by-kemahasiswaan
    * action-desc: Display a data by kemahasiswaan view
    */
    public function actionViewByKemahasiswaan($id)
    {
        return $this->render('viewByKemahasiswaan', [
            'model' => $this->findModel($id),
        ]);
    }

    // Untuk Sekretaris Rektorat !!---------------------------------------------------------------!!

    /*
    * action-id: index-all
    * action-desc: Display all data by rektorat view
    */
    public function actionIndexAll()
    {
        $searchModel = new PemakaianKendaraanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('indexBySekretarisRektorat', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /*
    * action-id: view-by-sekretaris-rektorat
    * action-desc: Display a data by rektorat view
    */
    public function actionViewBySekretarisRektorat($id)
    {
        return $this->render('viewBySekretarisRektorat', [
            'model' => $this->findModel($id),
        ]);
    }

    /*
    * action-id: accept-by-sekretaris-rektorat
    * action-desc: Menyetujui request oleh sekretaris rektorat
    */
    public function actionAcceptBySekretarisRektorat($id){
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->status_request_kemahasiswaan = 2;
            $model->status_req_sekretaris_rektorat = 2;
//            $model->no_hp_supir = $model->supir->no_telepon_supir;

            if($model->supir != null){
                $supir = Supir::findOne($model->supir_id);
                $supir->status = 1;
                $supir->save();
            }

            if($model->kendaraan_id != null){
                $kendaraan = Kendaraan::findOne($model->kendaraan_id);
                $kendaraan->status = 1;
                $kendaraan->save();
            }

            if($model->jenis_keperluan_id == 1){
                $mahasiswa = PemakaianKendaraanMhs::findOne(['pemakaian_kendaraan_mhs_id' => $model->pemakaian_kendaraan_mhs_id]);
                $mahasiswa->status_req_sekretaris_rektorat = 2;
                $mahasiswa->kendaraan_id = $model->kendaraan_id;
                $mahasiswa->supir_id = $model->supir_id;
                $mahasiswa->no_hp_supir = $model->no_hp_supir;
                $mahasiswa->save();
            }

            if($model->save()){
                $searchModel = new PemakaianKendaraanSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('viewBySekretarisRektorat', [
                    'model' => $this->findModel($id),
                ]);
            }
        } else {
            return $this->render('_formBySekretarisRektorat', [
                'model' => $model,
            ]);
        }
    }

    public function actionEditBySekretarisRektorat($id){
        $model = $this->findModel($id);
        $supirLama = Supir::findOne($model->supir_id);
        $kendaraanLama = Kendaraan::findOne($model->kendaraan_id);

        if ($model->load(Yii::$app->request->post())) {
            $model->status_request_kemahasiswaan = 2;
            $model->status_req_sekretaris_rektorat = 2;
//            $model->no_hp_supir = $model->supir->no_telepon_supir;

            if($model->supir_id != null){
                if($supirLama != null){
                    $supirLama->status = 0;
                    $supirLama->save();
                }

                $supir = Supir::findOne($model->supir_id);
                $supir->status = 1;
                $supir->save();
            }

            if($model->kendaraan_id != null){
                if($kendaraanLama != null){
                    $kendaraanLama->status = 0;
                    $kendaraanLama->save();
                }

                $kendaraan = Kendaraan::findOne($model->kendaraan_id);
                $kendaraan->status = 1;
                $kendaraan->save();
            }

            if($model->jenis_keperluan_id == 1){
                $mahasiswa = PemakaianKendaraanMhs::findOne(['pemakaian_kendaraan_mhs_id' => $model->pemakaian_kendaraan_mhs_id]);
                $mahasiswa->status_req_sekretaris_rektorat = 2;
                $mahasiswa->kendaraan_id = $model->kendaraan_id;
                $mahasiswa->supir_id = $model->supir_id;
                $mahasiswa->no_hp_supir = $model->no_hp_supir;
                $mahasiswa->save();
            }

            if($model->save()){
                $searchModel = new PemakaianKendaraanSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('viewBySekretarisRektorat', [
                    'model' => $this->findModel($id),
                ]);
            }
        } else {
            return $this->render('_formEditBySekretarisRektorat', [
                'model' => $model,
            ]);
        }
    }

    /*
    * action-id: reject-by-sekretaris-rektorat
    * action-desc: Menolak request oleh sekretaris rektorat
    */
    public function actionRejectBySekretarisRektorat($id){
        $model = PemakaianKendaraan::findOne($id);
        $model->status_request_kemahasiswaan = 3;
        $model->status_req_sekretaris_rektorat = 3;

        if($model->supir_id != null){
            $supir = Supir::findOne($model->supir_id);
            $supir->status = 0;
            $supir->save();

            $model->supir_id = null;
        }

        if($model->kendaraan_id != null){
            $kendaraan = Kendaraan::findOne($model->kendaraan_id);
            $kendaraan->status = 0;
            $kendaraan->save();

            $model->kendaraan_id = null;
        }

        if($model->jenis_keperluan_id == 1){
            $mahasiswa = PemakaianKendaraanMhs::findOne(['pemakaian_kendaraan_mhs_id' => $model->pemakaian_kendaraan_mhs_id]);
            $mahasiswa->status_req_sekretaris_rektorat = 3;
            $mahasiswa->status_request_kemahasiswaan = 3;
            $mahasiswa->kendaraan_id = $model->kendaraan_id;
            $mahasiswa->supir_id = $model->supir_id;
            $mahasiswa->no_hp_supir = $model->no_hp_supir;
            $mahasiswa->save();
        }

        if($model->save()){
            $searchModel = new PemakaianKendaraanSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('indexBySekretarisRektorat', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    // Untuk Pegawai !!---------------------------------------------------------------!!

    /*
    * action-id: index-by-pegawai
    * action-desc: Display all data by pegawai view
    */
    public function actionIndexByPegawai()
    {
        $searchModel = new PemakaianKendaraanSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => PemakaianKendaraan::find()->where(['jenis_keperluan_id' => 2, 'pegawai_id' => $this->pegawai_id])->andWhere('deleted!=1'),
            'sort' => ['defaultOrder' => ['updated_at' => SORT_DESC, 'created_at' => SORT_DESC]],
        ]);

        return $this->render('indexByPegawai', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /*
    * action-id: add-by-pegawai
    * action-desc: Menambahkan request
    */
    public function actionAddByPegawai()
    {
        $model = new PemakaianKendaraan();
        $modelPegawai = Pegawai::findOne($this->pegawai_id);
        if ($model->load(Yii::$app->request->post())) {
            $model->pegawai_id = $this->pegawai_id;
            $model->jenis_keperluan_id = 2;
            $model->save();
            //Yii::$app->messenger->addSuccessFlash("Message flash berhasil dibuat!!");
            return $this->redirect(['view-by-pegawai', 'id' => $model->pemakaian_kendaraan_id]);
        } else {
            return $this->render('_formByPegawai', [
                'model' => $model,
            ]);
        }
    }

    /*
    * action-id: view-by-pegawai
    * action-desc: Display a data by pegawai view
    */
    public function actionViewByPegawai($id)
    {
        return $this->render('viewByPegawai', [
            'model' => $this->findModel($id),
        ]);
    }

    /*
    * action-id: edit-by-pegawai
    * action-desc: Memperbaharui request
    */
    public function actionEditByPegawai($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view-by-pegawai', 'id' => $model->pemakaian_kendaraan_id]);
        } else {
            return $this->render('_formByPegawai', [
                'model' => $model,
            ]);
        }
    }

    /*
    * action-id: pop-up-pegawai
    * action-desc: Menampilkan halaman pop-up
    */
    public function actionPopUpPegawai(){
        $searchModel = new PemakaianKendaraanSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => PemakaianKendaraan::find()->where(['jenis_keperluan_id' => 2])->andWhere('deleted!=1'),
        ]);
        Yii::$app->messenger->addErrorFlash("Tidak bisa diubah");
        return $this->render('indexByPegawai', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
//        return $this->render('PopUpPegawai.php');
    }

    // Untuk Pribadi !!---------------------------------------------------------------!!

    /*
    * action-id: index-by-pribadi
    * action-desc: Display all data by self view
    */
    public function actionIndexByPribadi()
    {
        $searchModel = new PemakaianKendaraanSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => PemakaianKendaraan::find()->where(['jenis_keperluan_id' => 3])->andWhere('deleted!=1'),
        ]);

        return $this->render('indexByPribadi', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /*
    * action-id: add-by-pribadi
    * action-desc: Menambahkan request
    */
    public function actionAddByPribadi()
    {
        $model = new PemakaianKendaraan();

        if ($model->load(Yii::$app->request->post())) {
            $model->pegawai_id = $this->pegawai_id;
            $model->jenis_keperluan_id = 3;
            $model->save();
            //Yii::$app->messenger->addSuccessFlash("Message flash berhasil dibuat!!");
            return $this->redirect(['view-by-pribadi', 'id' => $model->pemakaian_kendaraan_id]);
        } else {
            return $this->render('_formByPribadi', [
                'model' => $model,
            ]);
        }
    }

    /*
    * action-id: view-by-pribadi
    * action-desc: Menampilkan data oleh pribadi
    */
    public function actionViewByPribadi($id)
    {
        return $this->render('viewByPribadi', [
            'model' => $this->findModel($id),
        ]);
    }

    /*
    * action-id: edit-by-pribadi
    * action-desc: Memperbaharui request
    */
    public function actionEditByPribadi($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view-by-pribadi', 'id' => $model->pemakaian_kendaraan_id]);
        } else {
            return $this->render('_formByPribadi', [
                'model' => $model,
            ]);
        }
    }

    /*
    * action-id: pop-up-pribadi
    * action-desc: Menampilkan halaman pop-up
    */
    public function actionPopUpPribadi(){
        $searchModel = new PemakaianKendaraanSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => PemakaianKendaraan::find()->where(['jenis_keperluan_id' => 3])->andWhere('deleted!=1'),
        ]);
        Yii::$app->messenger->addErrorFlash("Tidak bisa diubah");
        return $this->render('indexByPegawai', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    // Untuk Kabiro KSD !!---------------------------------------------------------------!!

    /*
    * action-id: index-by-kabiro-ksd
    * action-desc: Display all data by Kabiro KSD view
    */
    public function actionIndexByKabiroKsd()
    {
        $searchModel = new PemakaianKendaraanSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => PemakaianKendaraan::find()->where(['jenis_keperluan_id' => 3])->andWhere('deleted!=1'),
        ]);

        return $this->render('indexByKabiroKsd', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /*
    * action-id: view-by-kabiro-ksd
    * action-desc: Display a data by Kabiro KSD view
    */
    public function actionViewByKabiroKsd($id)
    {
        return $this->render('viewByKabiroKsd', [
            'model' => $this->findModel($id),
        ]);
    }

    /*
    * action-id: accept-by-kabiro-ksd
    * action-desc: Menyetujui request oleh Kabiro KSD
    */
    public function actionAcceptByKabiroKsd($id){
        $model = PemakaianKendaraan::findOne($id);
        $model->status_request_kabiro_KSD = 2;
        $model->save();

        $searchModel = new PemakaianKendaraanSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => PemakaianKendaraan::find()->where(['jenis_keperluan_id' => 3])->andWhere('deleted!=1'),
        ]);

        return $this->render('indexByKabiroKsd', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /*
    * action-id: reject-by-kabiro-ksd
    * action-desc: Menolak request sebagai Kabiro KSD
    */
    public function actionRejectByKabiroKsd($id){
        $model = PemakaianKendaraan::findOne($id);
        $model->status_request_kabiro_KSD = 3;
        $model->save();

        $searchModel = new PemakaianKendaraanSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => PemakaianKendaraan::find()->where(['jenis_keperluan_id' => 3])->andWhere('deleted!=1'),
        ]);

        return $this->render('indexByKabiroKsd', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    // Untuk HRD !!---------------------------------------------------------------!!

    /*
    * action-id: index-by-hrd
    * action-desc: Display all data by HRD view
    */
    public function actionIndexByHrd()
    {
        $searchModel = new PemakaianKendaraanSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => PemakaianKendaraan::find()->where(['jenis_keperluan_id' => 3])->andWhere('deleted!=1'),
        ]);

        return $this->render('indexByHrd', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /*
    * action-id: view-by-hrd
    * action-desc: Display a data by HRD view
    */
    public function actionViewByHrd($id)
    {
        return $this->render('viewByHrd', [
            'model' => $this->findModel($id),
        ]);
    }

    /*
    * action-id: accept-by-hrd
    * action-desc: Menyetujui request oleh HRD
    */
    public function actionAcceptByHrd($id){
        $model = PemakaianKendaraan::findOne($id);
        $model->status_request_hrd = 2;
        $model->save();

        $searchModel = new PemakaianKendaraanSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => PemakaianKendaraan::find()->where(['jenis_keperluan_id' => 3])->andWhere('deleted!=1'),
        ]);

        return $this->render('indexByHrd', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /*
    * action-id: reject-by-hrd
    * action-desc: Menolak request oleh HRD
    */
    public function actionRejectByHrd($id){
        $model = PemakaianKendaraan::findOne($id);
        $model->status_request_hrd = 3;
        $model->save();

        $searchModel = new PemakaianKendaraanSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => PemakaianKendaraan::find()->where(['jenis_keperluan_id' => 3])->andWhere('deleted!=1'),
        ]);

        return $this->render('indexByHrd', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    // Untuk Keuangan !!---------------------------------------------------------------!!

    /*
    * action-id: index-by-keuangan
    * action-desc: Display all data by Keuangan view
    */
    public function actionIndexByKeuangan()
    {
        $searchModel = new PemakaianKendaraanSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => PemakaianKendaraan::find()->where(['jenis_keperluan_id' => 3])->andWhere('deleted!=1'),
        ]);

        return $this->render('indexByKeuangan', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /*
    * action-id: view-by-keuangan
    * action-desc: Display a data by Keuangan view
    */
    public function actionViewByKeuangan($id)
    {
        return $this->render('viewByKeuangan', [
            'model' => $this->findModel($id),
        ]);
    }

    /*
    * action-id: accept-by-keuangan
    * action-desc: Menyetujui request sebagai Keuangan
    */
    public function actionAcceptByKeuangan($id){
        $model = PemakaianKendaraan::findOne($id);
        $model->status_request_keuangan = 2;
        $model->save();

        $searchModel = new PemakaianKendaraanSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => PemakaianKendaraan::find()->where(['jenis_keperluan_id' => 3])->andWhere('deleted!=1'),
        ]);

        return $this->render('indexByKeuangan', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /*
    * action-id: reject-by-keuangan
    * action-desc: Menolak request sebagai keuangan
    */
    public function actionRejectByKeuangan($id){
        $model = PemakaianKendaraan::findOne($id);
        $model->status_request_keuangan = 3;
        $model->save();

        $searchModel = new PemakaianKendaraanSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => PemakaianKendaraan::find()->where(['jenis_keperluan_id' => 3])->andWhere('deleted!=1'),
        ]);

        return $this->render('indexByKeuangan', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    // Untuk WR2 !!---------------------------------------------------------------!!

    /*
    * action-id: index-by-wr2
    * action-desc: Display all data by WR2 view
    */
    public function actionIndexByWr2()
    {
        $searchModel = new PemakaianKendaraanSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => PemakaianKendaraan::find()->where(['jenis_keperluan_id' => 3])->andWhere('deleted!=1'),
        ]);

        return $this->render('indexByWr2', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /*
    * action-id: view-by-wr2
    * action-desc: Display a data by WR2 view
    */
    public function actionViewByWr2($id)
    {
        return $this->render('viewByWr2', [
            'model' => $this->findModel($id),
        ]);
    }

    /*
    * action-id: accept-by-wr2
    * action-desc: Menyetujui request sebagai WR 2
    */
    public function actionAcceptByWr2($id){
        $model = PemakaianKendaraan::findOne($id);
        $model->status_request_wr2 = 2;
        $model->save();

        $searchModel = new PemakaianKendaraanSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => PemakaianKendaraan::find()->where(['jenis_keperluan_id' => 3])->andWhere('deleted!=1'),
        ]);

        return $this->render('indexByWr2', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /*
    * action-id: reject-by-wr2
    * action-desc: Menolak request sebagai WR 2
    */
    public function actionRejectByWr2($id){
        $model = PemakaianKendaraan::findOne($id);
        $model->status_request_wr2 = 3;
        $model->save();

        $searchModel = new PemakaianKendaraanSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => PemakaianKendaraan::find()->where(['jenis_keperluan_id' => 3])->andWhere('deleted!=1'),
        ]);

        return $this->render('indexByWr2', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    // PDF
    /*
    * action-id: sample-pdf
    * action-desc: Mencetak dalam bentuk dokumen
    */
    public function actionSamplePdf($id)
    {
        $pdf = $this->renderPartial('viewPdf', [
            'model' => $this->findModel($id),
        ]);
        $mpdf = new mPDF;
        $mpdf->WriteHTML($pdf);
        $mpdf->Output();
        exit;
    }

    /*
    * action-id: kemahasiswaan-pdf
    * action-desc: Mencetak dalam bentuk dokumen sebagai kemahasiswaan
    */
    public function actionKemahasiswaanPdf($id)
    {
        $pdf = $this->renderPartial('viewByKemahasiswaanPdf', [
            'model' => $this->findModel($id),
        ]);
        $mpdf = new mPDF;
        $mpdf->WriteHTML($pdf);
        $mpdf->Output();
        exit;
    }

    /*
    * action-id: pegawai-pdf
    * action-desc: Mencetak dalam bentuk dokumen sebagai pegawai
    */
    public function actionPegawaiPdf($id)
    {
        $pdf = $this->renderPartial('viewByPegawaiPdf', [
            'model' => $this->findModel($id),
        ]);
        $mpdf = new mPDF;
        $mpdf->WriteHTML($pdf);
        $mpdf->Output();
        exit;
    }

    /*
    * action-id: pribadi-pdf
    * action-desc: Mencetak dalam bentuk dokumen sebagai pribadi
    */
    public function actionPribadiPdf($id)
    {
        $pdf = $this->renderPartial('viewByPribadiPdf', [
            'model' => $this->findModel($id),
        ]);
        $mpdf = new mPDF;
        $mpdf->WriteHTML($pdf);
        $mpdf->Output();
        exit;
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
            $this->render('download404');
        }
    }
}
