<?php

namespace backend\modules\askm\controllers;

use Yii;
use backend\modules\askm\models\DimKamar;
use backend\modules\askm\models\Dim;
use backend\modules\askm\models\search\DimKamar as DimKamarSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;


/**
 * DimKamarController implements the CRUD actions for DimKamar model.
  * controller-id: dim-kamar
 * controller-desc: Controller untuk me-manage data penghuni kamar asrama
 */
class DimKamarController extends Controller
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
     * Lists all DimKamar models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DimKamarSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
    * action-id: view
     * action-desc: Display a data
     * Displays a single DimKamar model.
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
    * action-id: add-penghuni-kamar
     * action-desc: Menambahkan data penghuni kamar 
     * addPenghuniKamars a new DimKamar model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAddPenghuniKamar()
    {
        $model = new DimKamar();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['kamar/view', 'id' => $_GET['id']]);
        } else {
            return $this->render('addPenghuniKamar', [
                'model' => $model,
            ]);
        }
    }

/*
    * action-id: del-penghuni
     * action-desc: Menghapus data penghuni kamar
*/
    public function actionDelPenghuni($d_k_m){
        $model  = DimKamar::find()->where(['dim_kamar_id'=>$d_k_m])->one();
        $model->forceDelete();
        //$model->save();
        return $this->redirect(['/askm/kamar/view', 'id' => $_GET['kamar_id']]);
        
    }

    /**
    * action-id: edit-penghuni-kamar
     * action-desc: Memperbaharui data penghuni kamar
     * Edits an existing DimKamar model.
     * If Edit is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionEditPenghuniKamar($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->dim_kamar_id]);
        } else {
            return $this->render('editPenghuniKamar', [
                'model' => $model,
            ]);
        }
    }

    /**
    * action-id: del
     * action-desc: Menghapus data penghuni kamar
     * Deletes an existing DimKamar model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDel($id, $id_kamar)
    {
        $this->findModel($id)->forceDelete();
        \Yii::$app->messenger->addSuccessFlash("Penghuni telah dihapus");

        return $this->redirect(['kamar/view', 'id' => $id_kamar]);
    }

    /*
    * action-id: list-mahasiswa
     * action-desc: Mengambil daftar mahasiswa aktif
    */
    public function actionListMahasiswa($query){
        $data = [];
        $dims = Dim::find()
                    ->select('dim_id,nim,nama')
                    ->where('deleted!=1')
                    ->andWhere(['status_akhir' => 'Aktif'])
                    ->andWhere('nama LIKE :query')
                    ->orWhere('nim LIKE :query')
                    ->addParams([':query' => '%'.$query.'%'])
                    ->limit(10)
                    ->asArray()
                    ->all();
        foreach ($dims as $dim) {
            $dataValue = $dim['nama'] .' ('. $dim['nim'].')';
            $data []  = [
                            'value' => $dim['dim_id'],
                            'data' => $dataValue
                          
                        ];
        }
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        echo Json::encode($data);
    }

    /**
     * Finds the DimKamar model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DimKamar the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DimKamar::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
