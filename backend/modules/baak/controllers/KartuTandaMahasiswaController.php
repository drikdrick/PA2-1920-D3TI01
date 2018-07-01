<?php

namespace backend\modules\baak\controllers;

use Yii;
use backend\modules\baak\models\KartuTandaMahasiswa;
use backend\modules\baak\models\search\KartuTandaMahasiswaSearch;
use backend\modules\baak\models\Dim;
use backend\modules\baak\models\Pegawai;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * KtmController implements the CRUD actions for Ktm model.
   * controller-id: kartu-tanda-mahasiswa
 * controller-desc: Controller untuk me-manage data KTM
 */
class KartuTandaMahasiswaController extends Controller
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
     * Lists all Ktm models.
     * action-id: index
     * action-desc: Display all data
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KartuTandaMahasiswaSearch();
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
        $searchModel = new KartuTandaMahasiswaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('indexAdmin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single KartuTandaMahasiswa model.
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
     * Creates a new Ktm model.
     * action-id: add
     * action-desc: Tambah data
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAdd()
    {
        $model = new KartuTandaMahasiswa();

        if ($model->load(Yii::$app->request->post())) {
            $user_id = Yii::$app->user->identity->id;
            $user_dim = Dim::find()->where(['user_id'=> $user_id])->one();
            $pemohon = $user_dim->dim_id;
            $model->pemohon_id = $pemohon;
            $model->dim_id = $pemohon;
            $model->save();

            return $this->redirect(['view', 'id' => $model->kartu_tanda_mahasiswa_id]);
        } else {
            return $this->render('add', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing KartuTandaMahasiswa model.
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
            return $this->redirect(['view', 'id' => $model->kartu_tanda_mahasiswa_id]);
        } else {
            return $this->render('edit', [
                'model' => $model,
            ]);
        }
    }

    /*
    * action-id: edit-accept
     * action-desc: Memperbaharui status data menjadi disetujui
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

            return $this->redirect(['view-admin', 'id' => $model->kartu_tanda_mahasiswa_id]);
        }
        else {
            $model->status_pengajuan_id = 2;
            $user_id = Yii::$app->user->identity->id;
            $user_pegawai = Pegawai::find()->where(['user_id'=> $user_id])->one();
            $pegawai = $user_pegawai->pegawai_id;
            $model->pegawai_id = $pegawai;
            $model->save();

            return $this->redirect('index-admin');
        }
    }

    /*
    * action-id: edit-ready
     * action-desc: Memperbaharui status data menjadi ready
    */
    public function actionEditReady($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {            
            $user_id = Yii::$app->user->identity->id;
            $user_pegawai = Pegawai::find()->where(['user_id'=> $user_id])->one();
            $pegawai = $user_pegawai->pegawai_id;
            $model->pegawai_id = $pegawai;
            $model->status_pengajuan_id=4;
            $model->save();

            return $this->redirect(['index-admin', 'id' => $model->kartu_tanda_mahasiswa_id]);
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
     * action-desc: Menolak permohonan penggantian KTM
    */
    public function actionEditDecline($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $user_id = Yii::$app->user->identity->id;
            $user_pegawai = Pegawai::find()->where(['user_id'=> $user_id])->one();
            $pegawai = $user_pegawai->pegawai_id;
            $model->pegawai_id = $pegawai;

            $model->save();

            return $this->redirect(['view-admin', 'id' => $model->kartu_tanda_mahasiswa_id]);
        } else {
            $model->status_pengajuan_id = 3;
            $user_id = Yii::$app->user->identity->id;
            $user_pegawai = Pegawai::find()->where(['user_id'=> $user_id])->one();
            $pegawai = $user_pegawai->pegawai_id;
            $model->pegawai_id = $pegawai;
            $model->save();

            return $this->redirect('index-admin');
        }
    }

    /**
     * Deletes an existing Ktm model.
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
     * Finds the Ktm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ktm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = KartuTandaMahasiswa::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
