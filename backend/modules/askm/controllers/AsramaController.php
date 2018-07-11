<?php

namespace backend\modules\askm\controllers;

use Yii;
use backend\modules\askm\models\Asrama;
use backend\modules\askm\models\Kamar;
use backend\modules\dimx\models\Dim;
use backend\modules\askm\models\DimKamar;
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
 * controller-desc: Controller untuk me-manage data Asrama
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

    public function actionImportExcel()
    {
        $modelImport = new \yii\base\DynamicModel([
                    'fileImport'=>'File Import',
                ]);
        $modelImport->addRule(['fileImport'],'required');
        $modelImport->addRule(['fileImport'],'file',['extensions'=>'xls,xlsx']);

        if(Yii::$app->request->post()){
            ini_set('max_execution_time', 1500);

            $modelImport->fileImport = \yii\web\UploadedFile::getInstance($modelImport,'fileImport');
            if($modelImport->fileImport && $modelImport->validate()){
                $inputFileType = \PHPExcel_IOFactory::identify($modelImport->fileImport->tempName);
                $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
                $objReader->setLoadAllSheets();
                $objPHPExcel = $objReader->load($modelImport->fileImport->tempName);
                $count = 0;
                $temp_novalid = array();
                do{
                    //echo $objPHPExcel->getSheetNames()[$count];
                    //print_r($objPHPExcel->getSheetNames()[$count]);
                    $sheetData = $objPHPExcel->getSheet($count)->toArray(null,true,true,true);
                    $temp_asrama = $objPHPExcel->getSheetNames()[$count];
                    $baseRow = 3;
                    $temp_kamar = 1;
                    while(!empty($sheetData[$baseRow]['A']) && $sheetData[$baseRow]['A']!=''){
                        if(!is_null($sheetData[$baseRow]['B']))
                            $temp_kamar = $sheetData[$baseRow]['B'];
                        $temp_name = $sheetData[$baseRow]['C'];
                        $temp_dim = Dim::find()->where('deleted!=1');
                        $temp_name_explode = explode(' ', $temp_name);
                        foreach($temp_name_explode as $tne){
                            $temp_dim = $temp_dim->andWhere(['like', 'nama', $tne]);
                        }
                        $temp_dim = $temp_dim->one();
                        if(empty($temp_dim)){
                            $temp_novalid[] = [$objPHPExcel->getSheetNames()[$count], $temp_kamar, $temp_name];
                        }else{
                            $dim_kamar = new DimKamar();
                            $dim = Dim::find()->where(['like', 'nama', $tne])->one();
                            $asrama = Asrama::find()->where(['name' => $temp_asrama])->one();
                            $kamar = Kamar::find()->where(['asrama_id' => $asrama->asrama_id])->andWhere(['nomor_kamar' => $temp_kamar, 'deleted' => 0])->one();
                            if (empty($kamar)) {
                                $new_kamar = new Kamar();
                                $new_kamar->asrama_id = $asrama->asrama_id;
                                $new_kamar->nomor_kamar = (string) $temp_kamar;
                                if ($new_kamar->save()) {
                                    $kamar = $new_kamar;
                                }
                                else{
                                    echo "<pre>";
                                    print_r($new_kamar->errors);
                                    die();
                                }
                            }

                            $dim_kamar->kamar_id = $kamar->kamar_id;
                            $dim_kamar->dim_id = $dim->dim_id;
                            $dim_kamar->save();
                        }
                        // echo $temp_dim->nama;
                        // die;
                        $baseRow++;
                    }
                    $count++;
                }while($count<$objPHPExcel->getSheetCount());
                ini_set('max_execution_time', 30);
                \Yii::$app->messenger->addSuccessFlash("Data Mahasiswa berhasil ditambahkan");
                echo '<pre>';
                print_r($temp_novalid);
                die;
            }
        }

        return $this->render('ImportExcel',[
                'modelImport' => $modelImport,
            ]);
    }

    /**
     * Lists all Asrama models.
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
    public function actionDel($asrama_id, $confirm=false)
    {
        $model = $this->findModel($asrama_id);
        if ($model->jumlah_mahasiswa == 0) {
            if ($confirm) {
                $this->findModel($asrama_id)->softDelete();
                \Yii::$app->messenger->addInfoFlash("Asrama telah dihapus");
                return $this->redirect(['index']);
            }
            return $this->render('confirmDelete', ['id' => $asrama_id]);
        } else {
            return $this->render('cannotDelete');
        }
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
    * action-id: export-excel
    * action-desc: Meng-ekspor data asrama spesifik ke excel
    */
    public function actionExportExcel($asrama_id)
    {
        $model = new DimKamarSearch();
        $asrama = Asrama::find()->where(['asrama_id' => $id_asrama])->one();
      
        $_PHPExcel = new PHPExcel();

        $year = date('Y');

        $_PHPExcel->getActiveSheet()->getCell('B1')->setValue('Institut Teknologi Del')->getStyle()->applyFromArray(
            array(
                'font' => array(
                    'size' => 11,'bold' => true,'color' => array(
                        'rgb' => '000000')
                ),
                'alignment' => array(
                    'horizontal' => 'left',
                )
            )
        );

        $_PHPExcel->getActiveSheet()->getCell('B2')->setValue('Daftar Penghuni Asrama Tahun Ajaran '.$year.'/'.date('Y', strtotime('+ 365 days')))->getStyle()->applyFromArray(
            array(
                'font' => array(
                    'size' => 11,'bold' => true,'color' => array(
                        'rgb' => '000000')
                ),
                'alignment' => array(
                    'horizontal' => 'left',
                )
            )
        );

        $thead = 5;
        $digit = 1000;

        $_PHPExcel->getActiveSheet()->setAutoFilter('A5:F5');

        $_PHPExcel->getActiveSheet()->getStyle('A5:AP5')->applyFromArray(
            array(
                'font' => array(
                    'size' => 11,'bold' => true,'color' => array(
                        'rgb' => '000000')
                ),
                'alignment' => array(
                    'horizontal' => 'left',
                )
            )
        );
        
        $_PHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(false);
        $_PHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(false);
        $_PHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(false);
        $_PHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(false);
        $_PHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(false);
        $_PHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(false);
        $_PHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth("6");
        $_PHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth("45");
        $_PHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth("14");
        $_PHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth("12");  
        $_PHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth("16");
        $_PHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth("12");
        $_PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,$thead,'No');
        $_PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1,$thead,'Nama Mahasiswa');
        $_PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2,$thead,'NIM');
        $_PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3,$thead,'Angkatan');
        $_PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4,$thead,'Program Studi');
        $_PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5,$thead,'Kamar');

        foreach(range('A','AP') as $columnID)
        {
            $_PHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }
        
        $data = $model->find()->from('askm_dim_kamar t1')->innerJoin('askm_kamar t2', 't2.kamar_id = t1.kamar_id')->where('t1.deleted!=1')->andWhere('t2.asrama_id = '.$asrama_id)->all();
        $no = 1;
        $i = 1;

        foreach($data as $d){
            
            $_PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,$thead+$no,$i)->getDefaultStyle()->getAlignment()->applyFromArray(
                array(
                    'horizontal' => 'center',
                    'rotation'   => 0,
                    'wrap'       => TRUE
                )
            );
            $_PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1,$thead+$no,$d->dim['nama'])->getDefaultStyle()->getAlignment()->applyFromArray(
                array(
                    'horizontal' => 'center',
                    'rotation'   => 0,
                    'wrap'          => TRUE
                )
            );
            $_PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2,$thead+$no,$d->dim['nim'])->getDefaultStyle()->getAlignment()->applyFromArray(
                array(
                    'horizontal' => 'center',
                    'rotation'   => 0,
                    'wrap'          => TRUE
                )
            );
            $_PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3,$thead+$no,$d->dim['thn_masuk'])->getDefaultStyle()->getAlignment()->applyFromArray(
            array(
                    'horizontal' => 'center',
                    'rotation'   => 0,
                    'wrap'          => TRUE
                )
            );
            $_PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4,$thead+$no,$d->dim->refKbk['singkatan_prodi'])->getDefaultStyle()->getAlignment()->applyFromArray(
            array(
                    'horizontal' => 'center',
                    'rotation'   => 0,
                    'wrap'          => TRUE
                )
            );
            $_PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5,$thead+$no,$d->kamar['nomor_kamar'])->getDefaultStyle()->getAlignment()->applyFromArray(
            array(
                    'horizontal' => 'center',
                    'rotation'   => 0,
                    'wrap'          => TRUE
                )
            );
            $no++;
            $i++;

        }

        $_PHPExcel->getActiveSheet()->getCell('B3')->setValue('Asrama : '.$asrama->name)->getStyle()->applyFromArray(
            array(
                'font' => array(
                    'size' => 11,'bold' => true,'color' => array(
                        'rgb' => '000000')
                ),
                'alignment' => array(
                    'horizontal' => 'left',
                )
            )
        );

        $_objWriter = PHPExcel_IOFactory::createWriter($_PHPExcel,'Excel2007');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Data_Penghuni_Asrama_'.$asrama->name.'.xlsx"');
        $_objWriter->save('php://output');

    }


    /*
    * action-id: template-excel
    * action-desc: Mengunduh template data penghuni dalam bentuk excel
    */
    public function actionTemplateExcel()
    {
  
        $model = new DimKamarSearch();
      
        $_PHPExcel = new PHPExcel();

        $year = date('Y');

        $_PHPExcel->getActiveSheet()->getCell('B1')->setValue('Institut Teknologi Del')->getStyle()->applyFromArray(
            array(
                'font' => array(
                    'size' => 11,'bold' => true,'color' => array(
                        'rgb' => '000000')
                ),
                'alignment' => array(
                    'horizontal' => 'left',
                )
            )
        );

        $_PHPExcel->getActiveSheet()->getCell('B2')->setValue('Daftar Penghuni Asrama Tahun Ajaran '.$year.'/'.date('Y', strtotime('+ 365 days')))->getStyle()->applyFromArray(
            array(
                'font' => array(
                    'size' => 11,'bold' => true,'color' => array(
                        'rgb' => '000000')
                ),
                'alignment' => array(
                    'horizontal' => 'left',
                )
            )
        );

        $thead = 5;
        $digit = 1000;

        $_PHPExcel->getActiveSheet()->setAutoFilter('A5:F5');

        $_PHPExcel->getActiveSheet()->getStyle('A5:AP5')->applyFromArray(
            array(
                'font' => array(
                    'size' => 11,'bold' => true,'color' => array(
                        'rgb' => '000000')
                ),
                'alignment' => array(
                    'horizontal' => 'left',
                )
            )
        );
        
        $_PHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(false);
        $_PHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(false);
        $_PHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(false);
        $_PHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(false);
        $_PHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(false);
        $_PHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(false);
        $_PHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth("6");
        $_PHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth("45");
        $_PHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth("14");
        $_PHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth("12");  
        $_PHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth("16");
        $_PHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth("12");
        $_PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,$thead,'No');
        $_PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1,$thead,'Nama Mahasiswa');
        $_PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2,$thead,'NIM');
        $_PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3,$thead,'Angkatan');
        $_PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4,$thead,'Program Studi');
        $_PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5,$thead,'Kamar');

        $_PHPExcel->getActiveSheet()->getCell('B3')->setValue('Asrama : ')->getStyle()->applyFromArray(
            array(
                'font' => array(
                    'size' => 11,'bold' => true,'color' => array(
                        'rgb' => '000000')
                ),
                'alignment' => array(
                    'horizontal' => 'left',
                )
            )
        );

        $_objWriter = PHPExcel_IOFactory::createWriter($_PHPExcel,'Excel2007');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Template_Penghuni_Asrama.xlsx"');
        $_objWriter->save('php://output');
    }
}
