<?php

namespace backend\modules\askm\controllers;

use Yii;
use backend\modules\askm\models\Paket;
use backend\modules\askm\models\search\PaketSearch;
use backend\modules\askm\models\User;
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
     * Lists all Paket Models
     */
    public function actionIndexByAdmin(){
        $searchModel = new PaketSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('IndexByAdmin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    
    /**
     * Lists spesific paket as user
     */
    public function actionIndexByUser(){
        $searchModel = new PaketSearch();
        $userProvider = $searchModel->searchUser(Yii::$app->request->queryParams);

        return $this->render('indexByUser', [
            'searchModel' => $searchModel,
            'userProvider' => $userProvider,
        ]);
    }

    /**
     * Displays a single Paket model.
     * @param integer $id
     * @return mixed
     */
    public function actionPaketView($id)
    {
        return $this->render('PaketView', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Displays a single Paket model.
     * @param integer $id
     * @return mixed
     */
    public function actionPaketViewUser($id)
    {
        return $this->render('PaketViewUser', [
            'model' => $this->findModel($id),
        ]);
    }    
    

    /**
     * Creates a new Paket model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionPaketAdd()
    {
        $model = new Paket();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['PaketView', 'id' => $model->data_paket_id]);
        } else {
            return $this->render('PaketAdd', [
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
    public function actionPaketEdit($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['PaketView', 'id' => $model->data_paket_id]);
        } else {
            return $this->render('PaketEdit', [
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
    public function actionPaketDel($id)
    {
        $this->findModel($id)->SoftDelete();

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
