<?php

namespace backend\modules\baak\controllers;

use Yii;
use backend\modules\baak\models\DataSurat;
use backend\modules\baak\models\search\DataSuratSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DataSuratController implements the CRUD actions for DataSurat model.
 * controller-id: data-surat
 * controller-desc: Controller untuk me-manage Data Surat untuk kop surat
 */
class DataSuratController extends Controller
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
     * Lists all DataSurat models.
     * action-id: index
     * action-desc: Display all data
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DataSuratSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('view', [
            'model' => $this->findModel(1),
        ]); 
    }

    /**
     * Displays a single DataSurat model.
     * action-id: view
     * action-desc: Display all data
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
     * Creates a new DataSurat model.
<<<<<<< HEAD
     * action-id: add
     * action-desc: Tambah data
=======
>>>>>>> e99397fc9673110771750070eeb23e474fcda75f
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    // public function actionAdd()
    // {
    //     $model = new DataSurat();

    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'id' => $model->data_surat_id]);
    //     } else {
    //         return $this->render('create', [
    //             'model' => $model,
    //         ]);
    //     }
    // }

    /**
     * Updates an existing DataSurat model.
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
            return $this->redirect(['view', 'id' => $model->data_surat_id]);
        } else {
            return $this->render('edit', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing DataSurat model.
     * action-id: del
     * action-desc: Menghapus data
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DataSurat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DataSurat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DataSurat::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
