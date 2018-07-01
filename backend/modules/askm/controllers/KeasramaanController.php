<?php

namespace backend\modules\askm\controllers;

use Yii;
use backend\modules\askm\models\Keasramaan;
use backend\modules\askm\models\search\KeasramaanSearch;
use backend\modules\askm\models\Pegawai;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

/**
 * KeasramaanController implements the CRUD actions for Keasramaan model.
 * controller-id: keasramaan
 * controller-desc: Controller untuk me-manage data pengurus asrama
 */
class KeasramaanController extends Controller
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
     * Lists all Keasramaan models.
     * @return mixed
     */
    /*
    * action-id: index
    * action-desc: Display All Data
    */
    public function actionIndex()
    {
        $searchModel = new KeasramaanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Keasramaan model.
     * @param integer $id
     * @return mixed
     */
    /*
    * action-id: view
    * action-desc: Menampilkan keasramaan
    */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Keasramaan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*
    * action-id: add-pengurus
    * action-desc: Menambahkan pengurus keasramaan
    */
    public function actionAddPengurus()
    {
    
        $model = new Keasramaan();
        
        if ($model->load(Yii::$app->request->post())) {
            
            $model->save();
            return $this->redirect(['/askm/asrama/view-detail-asrama', 'id' => $_GET['id_asrama']]);
        } else {
            return $this->render('addPengurus', [
                'model' => $model, 
            ]);
        }
    }
    
    /*
    * action-id: list-keasramaan
    * action-desc: Mengambil daftar pegawai keasramaan
    */
    public function actionListKeasramaan($query){
        $data = [];
        $asramas = Pegawai::find()
                    ->select('pegawai_id,nama')
                    ->where('deleted != 1')
                    ->andWhere(['in', 'status_aktif_pegawai_id', [1,2]])
                    ->andWhere('nama LIKE :query')
                    ->addParams([':query' => '%'.$query.'%'])
                    ->limit(5)
                    ->asArray()
                    ->all();
        foreach ($asramas as $asrama) {
            
            $dataValue = $asrama['nama'];
            $data []  = [
                            'value' => $asrama['pegawai_id'],
                            'data' => $dataValue,
                          
                        ];
        }
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        echo Json::encode($data);
    }

    /*
    * action-id: del-pengurus
    * action-desc: Menghapus pengurus asrama
    */
    public function actionDelPengurus($id)
    {
        $this->findModel($id)->softDelete();
        \Yii::$app->messenger->addInfoFlash("Keasramaan telah dihapus");
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Updates an existing Keasramaan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    /*
    * action-id: edit
    * action-desc: Memperbaharui pengurus asrama
    */
    public function actionEdit($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->keasramaan_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Keasramaan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    /*
    * action-id: del
    * action-desc: Menghapus pengurus asrama
    */
    public function actionDel($id, $id_asrama)
    {
        $this->findModel($id)->softDelete();
        \Yii::$app->messenger->addSuccessFlash("Pengurus telah dihapus");
        
        return $this->redirect(['asrama/view', 'id' => $id_asrama]);
    }

    /**
     * Finds the Keasramaan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Keasramaan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Keasramaan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
