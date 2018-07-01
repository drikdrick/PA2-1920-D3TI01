<?php

namespace backend\modules\baak\controllers;

use Yii;
use backend\modules\baak\models\KaosDel;
use backend\modules\baak\models\Pegawai;
use backend\modules\baak\models\search\KaosDelSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * KaosDelController implements the CRUD actions for KaosDel model.
   * controller-id: kaos-del
 * controller-desc: Controller untuk me-manage data Kaos Del untuk Mahasiswa
 */
class KaosDelController extends Controller
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
     * Lists all KaosDel models.
     * action-id: index
     * action-desc: Display all data
     * @return mixed
     */


    public function actionIndex(){
        $searchModel = new KaosDelSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index',[
            'searchModel'=>$searchModel,
            'dataProvider'=>$dataProvider,
            ]);

    }

    /*
    * action-id: index-admin
     * action-desc: Display all data by admin
    */
    public function actionIndexAdmin(){
        $searchModel = new KaosDelSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('indexAdmin',[
            'searchModel'=>$searchModel,
            'dataProvider'=>$dataProvider,
            ]);

    }

    /**
     * Displays a single KaosDel model.
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
     * Creates a new KaosDel model.
     * action-id: add
     * action-desc: Tambah data
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAdd()
    {
        $model = new KaosDel();

        if($model->load(Yii::$app->request->post())){
              $user_id = Yii::$app->user->identity->id;
            $user_pegawai = Pegawai::find()->where(['user_id'=> $user_id])->one();
            $pegawai = $user_pegawai->pegawai_id;
            $model->pegawai_id = $pegawai;
            $model->save();

            return $this->redirect(['index-admin', 'id' => $model->kaos_del_id]);
        } else {
            return $this->render('add', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Updates an existing KaosDel model.
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
            return $this->redirect(['index-admin', 'id' => $model->kaos_del_id]);
        } else {
            return $this->render('edit', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing KaosDel model.
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
     * Finds the KaosDel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return KaosDel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = KaosDel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
