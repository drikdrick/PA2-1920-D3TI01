<?php

namespace backend\modules\ubux\controllers;

use Yii;
use backend\modules\ubux\models\DataTamu;
use backend\modules\ubux\models\search\DataTamuSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DataTamuController implements the CRUD actions for DataTamu model.
 * controller-id: data-tamu
 * controller-desc: Controller untuk me-manage data tamu
 */
class DataTamuController extends Controller
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
    * action-id: index
     * action-desc: Display all data
     * Lists all DataTamu models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DataTamuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
    * action-id: tamu-view
     * action-desc: Display a data
     * Displays a single DataTamu model.
     * @param integer $id
     * @return mixed
     */
    public function actionTamuView($id)
    {
        return $this->render('TamuView', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
    * action-id: tamu-del
     * action-desc: Menghapus data tamu
     * Deletes an existing DataTamu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionTamuDel($id)
    {
        $this->findModel($id)->softDelete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DataTamu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DataTamu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DataTamu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
