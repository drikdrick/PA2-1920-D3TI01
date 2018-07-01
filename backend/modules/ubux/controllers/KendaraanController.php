<?php

namespace backend\modules\ubux\controllers;

use Yii;
use backend\modules\ubux\models\Kendaraan;
use backend\modules\ubux\models\search\KendaraanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * KendaraanController implements the CRUD actions for Kendaraan model.
  * controller-id: kendaraan
 * controller-desc: Controller untuk me-manage data kendaraan
 */
class KendaraanController extends Controller
{
    public function behaviors()
    {
        return [
//            //TODO: crud controller actions are bypassed by default, set the appropriate privilege
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
     * Lists all Kendaraan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KendaraanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
    * action-id: view
     * action-desc: Display a data
     * Displays a single Kendaraan model.
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
     * action-desc: Menambah kendaraan
     * Creates a new Kendaraan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAdd()
    {
        $model = new Kendaraan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->kendaraan_id]);
        } else {
            return $this->render('add', [
                'model' => $model,
            ]);
        }
    }

    /**
    * action-id: edit
     * action-desc: Memperbaharui data kendaraan
     * Updates an existing Kendaraan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionEdit($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->kendaraan_id]);
        } else {
            return $this->render('edit', [
                'model' => $model,
            ]);
        }
    }

    /**
    * action-id: del
     * action-desc: Menghapus data
     * Deletes an existing Kendaraan model.
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
     * Finds the Kendaraan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Kendaraan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Kendaraan::findOne($id))) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
