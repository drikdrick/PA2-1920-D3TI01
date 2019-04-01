<?php

namespace backend\modules\askm\controllers;

use Yii;
use backend\modules\askm\models\DimPelanggaran;
use backend\modules\askm\models\DimPenilaian;
use backend\modules\askm\models\PoinPelanggaran;
use backend\modules\askm\models\Asrama;
use backend\modules\askm\models\search\DimPelanggaranSearch;
use backend\modules\askm\models\search\PelanggaranBrowseSearch;
use yii\web\Response;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DimPelanggaranController implements the CRUD actions for DimPelanggaran model.
 * controller-id: dim-pelanggaran
 * controller-desc: Controller untuk me-manage data pelanggaran mahasiswa
 */
class DimPelanggaranController extends Controller
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
     * Lists all DimPelanggaran models.
     * action-id: index
     * action-desc: Display all data
     * Lists all DimPelanggaran models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DimPelanggaranSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

     /**
     * browse DimPelanggaran models.
     * action-id: browse
     * action-desc: Browse all data
     * Lists all DimPelanggaran models.
     * @return mixed
     */
    public function actionBrowse($tanggal_awal=null, $tanggal_akhir = null, $asrama_id = null){
        $searchModel = new PelanggaranBrowseSearch();
        $dataProvider = null;
        $_post = Yii::$app->request->get();

        if(isset($_post['PelanggaranBrowseSearch']))
        {
            if($_post['PelanggaranBrowseSearch']['tanggal_awal']!="")
            {
                $searchModel->tanggal_awal = $_post['PelanggaranBrowseSearch']['tanggal_awal'];
                $tanggal_awal = $searchModel->tanggal_awal;
            }
            if($_post['PelanggaranBrowseSearch']['tanggal_akhir']!="")
            {
                $searchModel->tanggal_akhir = $_post['PelanggaranBrowseSearch']['tanggal_akhir'];
                $tanggal_akhir = $searchModel->tanggal_akhir;
            }
            if($_post['PelanggaranBrowseSearch']['asrama_id']!="")
            {
                $searchModel->asrama_id = $_post['PelanggaranBrowseSearch']['asrama_id'];
                $asrama_id = $searchModel->asrama_id;
            }
            $dataProvider = $searchModel->search(null,null,null,Yii::$app->request->queryParams);
        }
        
        if (Yii::$app->request->get('export') == 1) {
            $dataProvider = $searchModel->search($tanggal_awal,$tanggal_akhir,$asrama_id,null);
            $dataProvider->pagination->pageSize = false;
            return $this->render('exportPelanggaran', [
                'dataProvider' => $dataProvider,
            ]);
        }

        if(strtotime($tanggal_akhir)<=strtotime($tanggal_awal)){
            $dataProvider =null;
        }

        $dataAsrama = Asrama::find()->where('deleted!=1')->all();

        return $this->render('browse', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataAsrama' => $dataAsrama,
            'asrama_id'=> $asrama_id,
            'tanggal_awal' => $tanggal_awal,
            'tanggal_akhir' => $tanggal_akhir,
        ]);
    }

    /**
     * Lists single DimPelanggaran models.
     * @return mixed
     */
    /*
    * action-id: view
    * action-desc: Display Single Data
    */
    public function actionView($id, $penilaian_id)
    {
        $total = DimPenilaian::find()->where('deleted!=1')->andWhere(['penilaian_id' => $penilaian_id])->one();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'dim' => $total->dim->nama,
        ]);
    }

    /**
     * Add new DimPelanggaran models.
     * @return mixed
     */
    /*
    * action-id: add
    * action-desc: Add Single Data
    */
    public function actionAdd($id)
    {
        $model = new DimPelanggaran();
        $total = DimPenilaian::find()->where('deleted!=1')->andWhere(['penilaian_id' => $id])->one();
        $count_skor = DimPelanggaran::find()->where('deleted!=1')->andWhere(['penilaian_id' => $id])->andWhere('status_pelanggaran!=1')->all();

        if ($model->load(Yii::$app->request->post())) {
            // poin id harus required
            if (!Yii::$app->request->post()['DimPelanggaran']['poin_id']){
                 Yii::$app->messenger->addWarningFlash('Poin Pelanggaran Harus Diisi!');
                    return $this->render('add', [
                      'model' => $model,
                      'dim' => $total->dim->nama,
                    ]);
            }

            $poin = PoinPelanggaran::find()->where('deleted!=1')->andWhere(['poin_id' => $model->poin_id])->one();
            $akumulasi_skor = 0;
            foreach ($count_skor as $skor) {
                $akumulasi_skor = $akumulasi_skor + $skor->poin->poin;
            }

            $total->akumulasi_skor = $akumulasi_skor + $poin->poin;
            $total->save();
            $model->penilaian_id = $id;
            $model->save();

            return $this->redirect(['dim-penilaian/view', 'id' => $id]);
        } else {
            $model->tanggal = date('Y-m-d');
            return $this->render('add', [
                'model' => $model,
                'dim' => $total->dim->nama,
            ]);
        }
    }

    /**
     * Edit existing DimPelanggaran models.
     * @return mixed
     */
    /*
    * action-id: edit
    * action-desc: Edit single existing data
    */
    public function actionEdit($id, $penilaian_id)
    {
        $model = $this->findModel($id);
        $pelanggaran = DimPelanggaran::find()->where('deleted!=1')->andWhere(['pelanggaran_id' => $id])->andWhere(['penilaian_id' => $penilaian_id])->one();
        $total = DimPenilaian::find()->where('deleted!=1')->andWhere(['penilaian_id' => $penilaian_id])->one();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $poin = PoinPelanggaran::find()->where('deleted!=1')->andWhere(['poin_id' => $model->poin_id])->one();
            $current_poin = 0;
            $current_poin = $pelanggaran->poin->poin;
            $total->akumulasi_skor = $total->akumulasi_skor - $current_poin;
            $total->save();

            $total->akumulasi_skor = $total->akumulasi_skor + $poin->poin;
            $total->save();
            return $this->redirect(['dim-penilaian/view', 'id' => $model->penilaian_id]);
        } else {
            return $this->render('edit', [
                'model' => $model,
                'dim' => $total->dim->nama,
            ]);
        }
    }

    /**
     * Deletes an existing DimPelanggaran model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    /*
    * action-id: del
    * action-desc: Menghapus dim pelanggaran
    */
    public function actionDel($id)
    {
        $model = $this->findModel($id);
        $penilaian_id = $model->penilaian_id;

        $pelanggaran = DimPelanggaran::find()->where('deleted!=1')->andWhere(['pelanggaran_id' => $id])->andWhere(['penilaian_id' => $penilaian_id])->one();
        $total = DimPenilaian::find()->where('deleted!=1')->andWhere(['penilaian_id' => $penilaian_id])->one();

        $current_poin = 0;
        $current_poin = $pelanggaran->poin->poin;
        $total->akumulasi_skor = $total->akumulasi_skor - $current_poin;
        
        if($total->save()){
            if($model->softDelete()){
                \Yii::$app->messenger->addSuccessFlash("Berhasil Menghapus Pelanggaran");
                return $this->redirect(['dim-penilaian/view', 'id' => $penilaian_id]);
            }
        }
        \Yii::$app->messenger->addWarningFlash("Gagal Menghapus Pelanggaran");
        return $this->redirect(['dim-penilaian/view', 'id' => $penilaian_id]);
    }

    /**
     * Finds the DimPelanggaran model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DimPelanggaran the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DimPelanggaran::findOne($id)) !== null) {
            return $model;
        }else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
