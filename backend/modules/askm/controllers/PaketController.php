<?php

namespace backend\modules\askm\controllers;

use Yii;
use backend\modules\askm\models\Paket;
use backend\modules\askm\models\search\PaketSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PaketController implements the CRUD actions for Paket model.
 */
class PaketController extends Controller
{
    public function behaviors()
    {
        return [
            //TODO: crud controller actions are bypassed by default, set the appropriate privilege
            /*'privilege' => [
                 'class' => \Yii::$app->privilegeControl->getAppPrivilegeControlClass(),
                 'skipActions' => ['*'],
                ],
              */
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Paket models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PaketSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * action-id: index-by-admin
     * action-desc: Index paket untuk Admin
     */


    public function actionIndexByAdmin(){
        $searchModel = new PaketSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //$paket = Paket::find()->where('deleted!=1')->ALL();
        return $this->render('indexByAdmin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * action-id: index-by-user
     * action-desc: Index paket untuk User
     */

    public function actionIndexByUser(){
        $searchModel = new PaketSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('indexByUser', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }



    /**
     * Displays a single Paket model.
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
     * Creates a new Paket model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*
    public function actionCreate()
    {
        $model = new Paket();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->data_paket_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    */

    /**
     * action-id : paket-add
     * action-desc : menambah paket
     */
    public function actionPaketAdd()
    {
        $model = new Paket();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->data_paket_id]);
        } else {
            return $this->render('paketAdd', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Paket model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    /*
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->data_paket_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    */

    /**
     * action-id : paket-edit
     * action-desc : mengedit data paket
     */

    public function actionPaketEdit($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->data_paket_id]);
        } else {
            return $this->render('paketEdit', [
                'model' => $model,
            ]);
        }
    }

    /**
     * action-id : paket-ambil
     * action-desc : mengambil paket
     */
    public function actionPaketAmbil($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->data_paket_id]);
        } else {
            return $this->render('paketAmbil', [
                'model' => $model,
            ]);
        }
    }


    /**
     * Deletes an existing Paket model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->softDelete();

        return $this->redirect(['index-by-admin']);
    }

    /**
     * Finds the Paket model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Paket the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Paket::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
