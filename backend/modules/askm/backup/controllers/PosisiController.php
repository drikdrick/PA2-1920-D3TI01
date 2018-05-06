<?php

namespace backend\modules\askm\controllers;

use Yii;
use backend\modules\askm\models\Posisi;
use backend\modules\askm\models\search\PosisiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PosisiController implements the CRUD actions for Posisi model.
 */
class PosisiController extends Controller
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
     * Lists all Posisi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PosisiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Posisi model.
     * @param integer $id
     * @return mixed
     */
    public function actionPosisiView($id)
    {
        return $this->render('PosisiView', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Posisi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionPosisiAdd()
    {
        $model = new Posisi();
        $model->deleted = 0;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['posisi-view', 'id' => $model->posisi_id]);
        } else {
            return $this->render('PosisiAdd', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Posisi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionPosisiEdit($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['posisi-view', 'id' => $model->posisi_id]);
        } else {
            return $this->render('PosisiEdit', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Posisi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionPosisiDel($id)
    {
        $this->findModel($id)->SoftDelete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Posisi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Posisi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Posisi::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
