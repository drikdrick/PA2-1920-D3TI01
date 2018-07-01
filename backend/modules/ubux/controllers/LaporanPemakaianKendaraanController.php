<?php

namespace backend\modules\ubux\controllers;

use backend\modules\ubux\models\Kendaraan;
use backend\modules\ubux\models\PemakaianKendaraan;
use backend\modules\ubux\models\Supir;
use Yii;
use backend\modules\ubux\models\LaporanPemakaianKendaraan;
use backend\modules\ubux\models\search\LaporanPemakaianKendaraanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use mPDF;
use yii\helpers\Url;

/**
 * LaporanPemakaianKendaraanController implements the CRUD actions for LaporanPemakaianKendaraan model.
 * controller-id: laporan-pemakaian-kendaraan
 * controller-desc: Controller untuk me-manage data laporan pemakaian kendaraan
 */
class LaporanPemakaianKendaraanController extends Controller
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
     * Lists all LaporanPemakaianKendaraan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LaporanPemakaianKendaraanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
    * action-id: view
     * action-desc: Display a data
     * Displays a single LaporanPemakaianKendaraan model.
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
     * action-desc: Pembuatan Laporan Kendaraan
     * Creates a new LaporanPemakaianKendaraan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAdd()
    {
        $model = new LaporanPemakaianKendaraan();

        if ($model->load(Yii::$app->request->post())) {
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->laporan_pemakaian_kendaraan_id]);
            }
        } else {
            return $this->render('add', [
                'model' => $model,
            ]);
        }
    }

    public function actionAddLaporanPemakaian($id)
    {
        $model = new LaporanPemakaianKendaraan();
        $pemakaian_kendaraan = PemakaianKendaraan::findOne($id);

        if($pemakaian_kendaraan->laporan == 1){
            Yii::$app->messenger->addErrorFlash("Laporan Sudah Dibuat");
            return $this->redirect(Url::toRoute(['pemakaian-kendaraan/index', 'id' => $id]));
        }

        if ($model->load(Yii::$app->request->post())) {
            if($pemakaian_kendaraan->supir_id != null){
                $supir = Supir::findOne($pemakaian_kendaraan->supir_id);
                $supir->status = 0;
                $supir->save();
            }

            if($pemakaian_kendaraan->kendaraan_id != null){
                $kendaraan = Kendaraan::findOne($pemakaian_kendaraan->kendaraan_id);
                $kendaraan->status = 0;
                $kendaraan->save();
            }

            $pemakaian_kendaraan->laporan = 1;
            $pemakaian_kendaraan->save();

            if($model->save()){
                return $this->redirect(['view', 'id' => $model->laporan_pemakaian_kendaraan_id]);
            }
        } else {
            return $this->render('_formLaporanPemakaianKendaraan', [
                'model' => $model,
            ]);
        }
    }

    /**
    * action-id: edit
     * action-desc: Memperbaharui data laporan
     * Updates an existing LaporanPemakaianKendaraan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionEdit($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->laporan_pemakaian_kendaraan_id]);
        } else {
            return $this->render('edit', [
                'model' => $model,
            ]);
        }
    }

    /**
    * action-id: del
     * action-desc: Menghapus data
     * Deletes an existing LaporanPemakaianKendaraan model.
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
     * Finds the LaporanPemakaianKendaraan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LaporanPemakaianKendaraan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LaporanPemakaianKendaraan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /*
    * action-id: sample-pdf
    * action-desc: Mencetak kedalam bentuk dokumen
    */
    public function actionSamplePdf($id)
    {
        $pdf = $this->renderPartial('viewPdf', [
            'model' => $this->findModel($id),
        ]);
        $mpdf = new mPDF;
        $mpdf->WriteHTML($pdf);
        $mpdf->Output();
        exit;
    }

    /*
    * action-id: lihat-pdf
     * action-desc: Preview tampilan dokumen
    */
    public function actionLihatPdf($id){
        return $this->renderPartial('viewPdf', [
            'model' => $this->findModel($id),
        ]);
    }
}
