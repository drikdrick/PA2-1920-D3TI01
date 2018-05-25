<?php

namespace backend\modules\askm\controllers;

use Yii;
use backend\modules\askm\models\Asrama;
use backend\modules\askm\models\Kamar;
use backend\modules\askm\models\search\AsramaSearch;
use backend\modules\askm\models\search\KamarSearch;
use backend\modules\askm\models\search\DimKamarSearch;
use backend\modules\askm\models\search\KeasramaanSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use PHPExcel;
use PHPExcel_Writer_Excel2007;
use PHPExcel_IOFactory;

/**
 * AsramaController implements the CRUD actions for Asrama model.
  * controller-id: asrama
 * controller-desc: Controller untuk me-manage data asrama
 */
class AsramaController extends Controller
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
     * Lists all Asrama models.
     * @return mixed
     */
     public function actionIndex()
    {
        $searchModel = new AsramaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere('askm_asrama.deleted != 1');
        
        $dataProvider->setSort([
            'defaultOrder' => [
                'asrama_id' => SORT_DESC,
            ],
        ]);
        
        $dataProvider->pagination = ['pageSize' => 8];
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
    * action-id: view
     * action-desc: Display a data asrama by specified id
     * Displays a single Asrama model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $searchModel = new KeasramaanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where('deleted != 1')->andWhere(['asrama_id' => $id]);

        return $this->render('view-detail-asrama', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'model' => $this->findModel($id),
        ]);
    }

    /**
    * action-id: view-detail-asrama
     * action-desc: Display a detail data asrama by specified id
     * Displays a single Asrama model.
     * @param integer $id
     * @return mixed
     */
    public function actionViewDetailAsrama($id)
    {
        $searchModel = new KeasramaanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where('deleted != 1')->andWhere(['asrama_id' => $id]);

        return $this->render('view-detail-asrama', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'model' => $this->findModel($id),
        ]);
    }

    /*
    * action-id: view-kamar
     * action-desc: Display all kamar by specified asrama
    */
    public function actionViewKamar($asrama_id){
        // $searchModel = new KamarSearch;
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        // $dataProvider->query->where('askm_kamar.deleted != 1')->andWhere(['askm_kamar.asrama_id' => $asrama_id]);
        
        // $dataProvider = new ActiveDataProvider([
            // 'query' => Kamar::find()->andWhere(['asrama_id'=>$asrama_id]),
            // 'pagination' => [
                // 'pageSize' => 10,    
            // ],       
        // ]);
        
        // return $this->render('view-kamar',[
            // 'searchModel'=>$searchModel,
            // 'dataProvider'=>$dataProvider,
            // 'model'=>Kamar::find()->where(['asrama_id'=>$asrama_id])->one(),
        // ]);
        
        
        return $this->redirect(['kamar/index', 'KamarSearch[asrama_id]' => $asrama_id]);
    }

    /*
    * action-id: del-asrama
     * action-desc: Delete a specified asrama
    */
    public function actionDelAsrama($asrama_id){
        $model = $this->findModel($asrama_id);
        $model['deleted']=1;
        $model->save();
        
        \Yii::$app->messenger->addInfoFlash("Asrama".$model['name']." telah dihapus");
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
    * action-id: add
     * action-desc: Menambahkan data asrama
     * Creates a new Asrama model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAdd()
    {
        $model = new Asrama();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('add', [
                'model' => $model,
            ]);
        }
    }

    /**
    * action-id: edit
     * action-desc: Memperbaharui data asrama
     * Updates an existing Asrama model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionEdit($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('edit', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Asrama model.
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
     * Finds the Asrama model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Asrama the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Asrama::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /*
    * action-id: excel
    * action-desc: Meng-ekspor data asrama spesifik ke excel
    */
    public function actionExcel($asrama_id)
    {
            $model = new DimKamarSearch();
          
                $_PHPExcel = new PHPExcel();
                $_PHPExcel->setActiveSheetIndex(0)->mergeCells('A1:D1');
                $_PHPExcel->getActiveSheet()->getStyle('A1:D1')->applyFromArray(array('font' => array('size' => 15,'bold' => true,'color' => array('rgb' => '542109'))));
                $_PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,1,'Data Asrama');
                $thead = 3;
                $digit = 1000;
                $_PHPExcel->getActiveSheet()->getStyle('A3:AP3')->applyFromArray(array('font' => array('size' => 11,'bold' => true,'color' => array('rgb' => '000000'))));
                
                $_PHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(false);
                $_PHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(false);
                $_PHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(false);
                $_PHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(false);
                $_PHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(false);
                $_PHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(false);
                $_PHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(false);
                $_PHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(false);
                $_PHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth("50");
                $_PHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth("10");
                $_PHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth("14");
                $_PHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth("12");  
                $_PHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth("8");
                $_PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,$thead,'Nama');
                $_PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1,$thead,'Angkatan');
                $_PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2,$thead,'Program Studi');
                $_PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3,$thead,'Asrama');
                $_PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4,$thead,'Kamar');
                foreach(range('A','AP') as $columnID)
                    {
                        $_PHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);

                    }
                
                $data = $model->find()->from('askm_dim_kamar t1')->innerJoin('askm_kamar t2', 't2.kamar_id = t1.kamar_id')->andWhere('t2.asrama_id = '.$asrama_id)->all();
                $no = 1;

                foreach($data as $d){
                    
                     
                    $_PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,$thead+$no,$d->dim['nama']);
                    $_PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1,$thead+$no,$d->dim['thn_masuk']);
                    $_PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2,$thead+$no,$d->dim->refKbk['singkatan_prodi']);
                    $_PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3,$thead+$no,$d->kamar->asrama['name']);
                    $_PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4,$thead+$no,$d->kamar['nomor_kamar']);
                    $no++;
                 }
                $_objWriter = PHPExcel_IOFactory::createWriter($_PHPExcel,'Excel2007');
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment;filename="Data Asrama.xlsx"');
                $_objWriter->save('php://output');
    }
}
