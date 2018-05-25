<?php

namespace backend\modules\ubux\controllers;

use Yii;
use backend\modules\ubux\models\DataPaket;
use backend\modules\ubux\models\search\DataPaketSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DataPaketController implements the CRUD actions for DataPaket model.
 * controller-id: data-paket
 * controller-desc: Controller untuk me-manage data paket di pos satpam
 */
class DataPaketController extends Controller
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
     * action-id: index-by-admin
     * action-desc: Display all data by admin view
     * Lists all DataPaket models.
     * @return mixed
     */
    public function actionIndexByAdmin()
    {
        $searchModel = new DataPaketSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('indexByAdmin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
    * action-id: index-by-mahasiswa
     * action-desc: Display all data by student view
     * Lists all DataPaket mahasiswa & Unknown DataPaket.
     * @return mixed
     */
    public function actionIndexByMahasiswa()
    {
        $searchModel = new DataPaketSearch();
        $dataProvider = $searchModel->searchUserMahasiswa(Yii::$app->request->queryParams);

        return $this->render('indexByMahasiswa', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
    * action-id: index-by-pegawai
     * action-desc: Display all data by employees view
     * Lists all DataPaket Pegawai & Unknown DataPaket.
     * @return mixed
     */
    public function actionIndexByPegawai()
    {
        $searchModel = new DataPaketSearch();
        $dataProvider = $searchModel->searchUserPegawai(Yii::$app->request->queryParams);

        return $this->render('indexByPegawai', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
    * action-id: data-paket-view
     * action-desc: Display a package data
     * Displays a single DataPaket model.
     * @param integer $id
     * @return mixed
     */
    public function actionDataPaketView($id)
    {
        return $this->render('DataPaketView', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
    * action-id: data-paket-add
     * action-desc: Menambahkan data paket yang datang
     * Creates a new DataPaket model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionDataPaketAdd()
    {
        $model = new DataPaket();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['data-paket-view', 'id' => $model->data_paket_id]);
        } else {
            return $this->render('DataPaketAdd', [
                'model' => $model,
            ]);
        }
    }

    /**
    * action-id: data-paket-edit
     * action-desc: Memperbaharui data paket
     * Updates an existing DataPaket model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDataPaketEdit($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['data-paket-view', 'id' => $model->data_paket_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
    * action-id: data-paket-del
     * action-desc: Menghapus data paket
     * Deletes an existing DataPaket model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDataPaketDel($id)
    {
        $this->findModel($id)->softDelete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DataPaket model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DataPaket the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DataPaket::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
