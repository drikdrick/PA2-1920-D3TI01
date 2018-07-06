<?php

namespace backend\modules\ubux\controllers;

use Yii;
use backend\modules\ubux\models\PosisiPaket;
use backend\modules\ubux\models\search\PosisiPaketSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PosisiPaketController implements the CRUD actions for PosisiPaket model.
 * controller-id: posisi-paket
 * controller-desc: Controller untuk me-manage posisi dari paket
 */
class PosisiPaketController extends Controller
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
     * Lists all PosisiPaket models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PosisiPaketSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
    * action-id: posisi-paket-add
     * action-desc: Menambahkan data posisi paket
     * Creates a new PosisiPaket model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionPosisiPaketAdd()
    {
        $model = new PosisiPaket();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->messenger->addSuccessFlash("Posisi Paket Berhasil ditambahkan");
            return $this->redirect(['index']);
        } else {
            return $this->render('PosisiPaketAdd', [
                'model' => $model,
            ]);
        }
    }

    /**
    * action-id: posisi-paket-edit
     * action-desc: Memperbaharui data posisi paket
     * Updates an existing PosisiPaket model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionPosisiPaketEdit($id)
    {
         $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->messenger->addSuccessFlash("Posisi Paket Berhasil diedit");
            return $this->redirect(['index']);
        } else {
            return $this->render('PosisiPaketAdd', [
                'model' => $model,
            ]);
        }
    }

    /**
    * action-id: posisi-paket-del
     * action-desc: Menghapus data posisi paket
     * Deletes an existing PosisiPaket model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionPosisiPaketDel($id)
    {
        $this->findModel($id)->softDelete();
        \Yii::$app->messenger->addSuccessFlash("Posisi Paket Berhasil dihapus");
        return $this->redirect(['index']);
    }

    /**
     * Finds the PosisiPaket model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PosisiPaket the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PosisiPaket::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
