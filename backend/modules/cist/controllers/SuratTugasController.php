<?php

namespace backend\modules\cist\controllers;

use Yii;
use mPDF;
use backend\modules\cist\models\SuratTugas;
use backend\modules\cist\models\search\SuratTugasSearch;
use backend\modules\cist\models\Pegawai;
use backend\modules\cist\models\Pejabat;
use backend\modules\cist\models\SuratTugasFile;
use backend\modules\cist\models\SuratTugasAssignee;
use backend\modules\cist\models\LaporanSuratTugas;
use backend\modules\cist\models\AtasanSuratTugas;
use backend\modules\inst\models\InstApiModel;
use backend\modules\cist\models\StrukturJabatan;
use backend\modules\cist\models\JenisSurat;
use backend\modules\cist\models\Status;
use backend\modules\cist\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;

/**
 * SuratTugasController implements the CRUD actions for SuratTugas model.
 * controller-id: surat-tugas
 * controller-desc: Controller untuk me-manage data Surat Tugas untuk Pegawai
 */
class SuratTugasController extends Controller
{
    public $to = array("dosenstaff@del.ac.id");
    
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
     * action-id: dashboard-surat-tugas
     * action-desc: Show surat tugas module dashboard
     */
    public function actionDashboardSuratTugas(){
        $searchModel = new SuratTugasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('dashboard', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * action-id: index-pegawai
     * action-desc: Display all surat tugas of specific pegawai
     */
    public function actionIndexPegawai()
    {
        $arraySuratTugasId = SuratTugas::getSuratTugas(Yii::$app->user->identity->id);

        $searchModel = new SuratTugasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['in', 'surat_tugas_id', $arraySuratTugasId])->andWhere('deleted!=1');
        $status = Status::find()->where(['not in', 'status_id', [7, 8, 9, 10]])->andWhere('deleted!=1')->all();

        return $this->render('IndexPegawai', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'status' => $status,
        ]);
    }

    /**
     * action-id: index-hrd
     * action-desc: Display all surat tugas that have been confirmed or published
     */
    public function actionIndexHrd(){
        $searchModel = new SuratTugasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        // $dataProvider->query->where("name = 6 or name = 3")->orderBy(['created_at' => SORT_DESC]);
        $jenisSurat = JenisSurat::find()->all();
        $status = Status::find()->where(['in', 'status_id', [6, 3]])->andWhere('deleted!=1')->all();

        return $this->render('IndexHrd', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'jenisSurat' => $jenisSurat,
            'status' => $status,
        ]);
    }

    /**
     * action-id: index-wr
     * action-desc: Display all surat tugas that have been confirmed or published
     */
    public function actionIndexWr(){
        $searchModel = new SuratTugasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        // $dataProvider->query->where("name = 6 or name = 3")->orderBy(['created_at' => SORT_DESC]);
        $jenisSurat = JenisSurat::find()->all();
        $status = Status::find()->where(['in', 'status_id', [6, 3]])->all();

        return $this->render('IndexWr', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'jenisSurat' => $jenisSurat,
            'status' => $status,
        ]);
    }

    /**
     * action-id: index-surat-bawahan
     * action-desc: Display all subordinate surat tugas to superior
     */
    public function actionIndexSuratBawahan(){
        $searchModel = new SuratTugasSearch();
        $dataProvider = $searchModel->searchBawahan(Yii::$app->request->queryParams);
        $status = Status::find()->where(['not in', 'status_id', [7, 8, 9, 10]])->andWhere('deleted!=1')->all();

        return $this->render('IndexSuratBawahan', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'status' => $status,
        ]);
    }

    /**
     * action-id: view-profil-pegawai
     * action-desc: View specific pegawai profile
     */
    public function actionViewProfilPegawai($id, $suratId)
    {
        $model = Pegawai::find()->where(['pegawai_id' => $id])->one();
        $arraySuratTugasId = SuratTugas::getSuratTugas($model->user_id);
        $modelSuratTugas = SuratTugas::find();
        $modelSuratTugas->where(['YEAR(created_at)' => date('Y')])->andWhere(['in', 'surat_tugas_id', $arraySuratTugasId])->andWhere('deleted!=1')->all();
        $dataProvider = new ActiveDataProvider([
            'query' => $modelSuratTugas,
            'sort' => [
                'defaultOrder' => [
                    'updated_at' => SORT_DESC,
                    'created_at' => SORT_DESC,
                ]
            ],
            'pagination' => [
                'pageSize' => 7
            ]
        ]);

        return $this->render('ViewProfilPegawai', [
            'model' => $model,
            'dataProvider' => $dataProvider,
            'suratTugasId' => $suratId,
        ]);
    }

    /**
     * action-id: view-pegawai
     * action-desc: View specific surat tugas of specific pegawai
     */
    public function actionViewPegawai($id)
    {
        $modelFile = SuratTugasFile::find()->where(['surat_tugas_id' => $id])->all();
        $modelAssignee = SuratTugasAssignee::find()->where(['surat_tugas_id' => $id])->all();
        $modelAtasan = AtasanSuratTugas::find()->where(['surat_tugas_id' => $id])->all();
        $modelLaporan = LaporanSuratTugas::find()->where(['surat_tugas_id' => $id])->all();
        return $this->render('ViewPegawai', [
            'model' => $this->findModel($id),
            'modelAssignee' => $modelAssignee,
            'modelFile' => $modelFile,
            'modelLaporan' => $modelLaporan,
            'modelAtasan' => $modelAtasan,
        ]);
    }

    /**
     * action-id: view-hrd
     * action-desc: View specific surat tugas so HRD can either publish, change report submission date, give note, edit description
     */
    public function actionViewHrd($id)
    {
        $modelFile = SuratTugasFile::find()->where(['surat_tugas_id' => $id])->all();
        $modelAssignee = SuratTugasAssignee::find()->where(['surat_tugas_id' => $id])->all();
        $modelAtasan = AtasanSuratTugas::find()->where(['surat_tugas_id' => $id])->all();
        $modelLaporan = LaporanSuratTugas::find()->where(['surat_tugas_id' => $id])->all();
        return $this->render('ViewHrd', [
            'model' => $this->findModel($id),
            'modelAssignee' => $modelAssignee,
            'modelFile' => $modelFile,
            'modelLaporan' => $modelLaporan,
            'modelAtasan' => $modelAtasan,
        ]);
    }

    /**
     * action-id: view-wr
     * action-desc: View specific surat tugas so WR can either accept or reject surat tugas report
     */
    public function actionViewWr($id)
    {
        $modelFile = SuratTugasFile::find()->where(['surat_tugas_id' => $id])->all();
        $modelAssignee = SuratTugasAssignee::find()->where(['surat_tugas_id' => $id])->all();
        $modelAtasan = AtasanSuratTugas::find()->where(['surat_tugas_id' => $id])->all();
        $modelLaporan = LaporanSuratTugas::find()->where(['surat_tugas_id' => $id])->all();
        return $this->render('ViewWr', [
            'model' => $this->findModel($id),
            'modelAssignee' => $modelAssignee,
            'modelFile' => $modelFile,
            'modelLaporan' => $modelLaporan,
            'modelAtasan' => $modelAtasan,
        ]);
    }

    /**
     * action-id: view-surat-bawahan
     * action-desc: View specific surat tugas of subordinate so superior can either accept, reject, give review of surat tugas
     */
    public function actionViewSuratBawahan($id){
        $modelFile = SuratTugasFile::find()->where(['surat_tugas_id' => $id])->all();
        $modelAssignee = SuratTugasAssignee::find()->where(['surat_tugas_id' => $id])->all();
        $modelAtasan = AtasanSuratTugas::find()->where(['surat_tugas_id' => $id])->all();
        return $this->render('ViewSuratBawahan', [
            'model' => $this->findModel($id),
            'modelAssignee' => $modelAssignee,
            'modelFile' => $modelFile,
            'modelAtasan' => $modelAtasan,
        ]);
    }

    /**
     * action-id: add-luar-kampus
     * action-desc: If there are new post request, call the save function else render a _formLuarKampus
     */
    public function actionAddLuarKampus()
    {   
        $model = new SuratTugas();
        $modelPegawai = Pegawai::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
        $modelAtasan = InstApiModel::getAtasanByPegawaiId($modelPegawai->pegawai_id);

        // echo "<pre>"; print_r($this->to); die();

        if ($model->load(Yii::$app->request->post())) {
            //Set Default Information
            $model->perequest = $modelPegawai->pegawai_id;
            $model->jenis_surat_id = 1;
            $model->name = 1;

            //Get the date difference
            // $today = time();
            // $plan = strtotime($model->tanggal_berangkat);
            // $datediff = $plan - $today;

            // if(strtotime($model->tanggal_kembali) < $plan){
            //     \Yii::$app->messenger->addWarningFlash("Tanggal kembali tidak bisa sebelum tanggal berangkat");
            //     return $this->render('AddLuarKampus', [
            //         'model' => $model,
            //     ]);
            // }else if(strtotime($model->tanggal_selesai) < strtotime($model->tanggal_mulai)){
            //     \Yii::$app->messenger->addWarningFlash("Tanggal selesai tidak bisa sebelum tanggal mulai");
            //     return $this->render('AddLuarKampus', [
            //         'model' => $model,
            //     ]);
            // }else if(round($datediff / (60 * 60 * 24)) >= 2){
            if($model->validate()){
                $model->save();

                //Atasan Handler
                if($model->atasan != null){
                    foreach($model->atasan as $data){
                        $modelAtasanSuratTugas = new AtasanSuratTugas();
                        $modelAtasanSuratTugas->id_pegawai = $data;
                        $modelAtasanSuratTugas->surat_tugas_id = $model->surat_tugas_id;
                        $modelAtasanSuratTugas->perequest = $model->perequest;
                        $atasan = Pegawai::find()->where(['pegawai_id' => $modelAtasanSuratTugas->id_pegawai])->one();
                        if($modelAtasanSuratTugas->validate()){
                            $modelAtasanSuratTugas->save();
                            \Yii::$app->messenger->sendNotificationToUser((int) $atasan->user_id, "Ada request surat tugas dari bawahan");
                        }else{
                            $errors = $modelAtasanSuratTugas->errors;
                            print_r(array_values($errors));
                            die();
                        }
                    }
                }

                //Participants Handler
                foreach(Yii::$app->request->post()['Peserta'] as $data){
                    if($data['id_pegawai'] == "empty"){
                        continue;
                    }else{
                        $modelAssignee = new SuratTugasAssignee();
                        $modelAssignee->id_pegawai = $data['id_pegawai'];
                        $modelAssignee->surat_tugas_id = $model->surat_tugas_id;
                        $modelAssignee->deleted = 0;

                        $pegawai = Pegawai::find()->where(['pegawai_id' => $modelAssignee->id_pegawai])->one();
                        $from = $pegawai->email;
                        $subject = "";
                        $body = "";

                        if($modelAssignee->validate()){
                            $modelAssignee->save();
                            // \Yii::$app->messenger->sendEmail($from, $this->to, $subject, $body);
                        }else{
                            $errors = $modelAssignee->errors;
                            print_r(array_values($errors));
                            die();
                        }
                    }
                }

                //Files Handler
                
                    $status = \Yii::$app->fileManager->saveUploadedFiles();
                        if($status != null && $status->status == 'success'){
                            $total = count($status->fileinfo);
                            for ($i=0;$i<$total;$i++)
                            {
                                $modelFile = new SuratTugasFile();
                                $modelFile->surat_tugas_id = $model->surat_tugas_id;
                                $modelFile->nama_file = $status->fileinfo[$i]->name;
                                //$modelFile->lokasi_file = $fileDir;
                                $newFiles->kode_file = $status->fileinfo[$i]->id;
                                if($modelFile->validate()){
                                    //Save file to directory $fileDir
                                    //$file->saveAs($fileDir);

                                    $modelFile->save();
                                }else{
                                    $errors = $modelFile->errors;
                                    print_r(array_values($errors));
                                    die();
                                }
                            }
                        }
                
                // $model->files = UploadedFile::getInstances($model, 'files');
                // if($model->files != null){
                //     foreach($model->files as $file){
                //         $modelFile = new SuratTugasFile();
                //         $fileDir = 'uploads/attachments/' . $file->baseName . '.' . $file->extension;
                //         $modelFile->surat_tugas_id = $model->surat_tugas_id;
                //         $modelFile->nama_file = $file->baseName;
                //         $modelFile->lokasi_file = $fileDir;
                //         $modelFile->deleted = 0;
                //         if($modelFile->validate()){
                //             //Save file to directory $fileDir
                //             $file->saveAs($fileDir);

                //             $modelFile->save();
                //         }else{
                //             $errors = $modelFile->errors;
                //             print_r(array_values($errors));
                //             die();
                //         }
                //     }
                // }

                return $this->redirect(['view-pegawai', 'id' => $model->surat_tugas_id]);
            }else{
                $errors = $model->errors;
                print_r(array_values($errors));
            }
            // }else{
            //     \Yii::$app->messenger->addWarningFlash("Permohonan minimal 2 hari sebelum keberangkatan");
            //     return $this->render('AddLuarKampus', [
            //         'model' => $model,
            //     ]);
            // }
        } else {
            return $this->render('AddLuarKampus', [
                'model' => $model,
                'modelAtasan' => $modelAtasan,
                'pegawai' => $modelPegawai,
            ]);
        }
    }

    /**
     * action-id: add-dalam-kampus
     * action-desc: If there are new post, call save function else render _formDalamKampus
     */
    public function actionAddDalamKampus()
    {
        $model = new SuratTugas();
        $modelPegawai = Pegawai::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
        $modelAtasan = InstApiModel::getAtasanByPegawaiId($modelPegawai->pegawai_id);

        if ($model->load(Yii::$app->request->post())) {
            //Set Default Information
            $model->perequest = $modelPegawai->pegawai_id;
            $model->name = 1;
            $model->jenis_surat_id = 2;

            //Get the date difference
            // $today = time();
            // $plan = strtotime($model->tanggal_mulai);
            // $datediff = $plan - $today;

            // if(strtotime($model->tanggal_selesai) < $plan){
            //     \Yii::$app->messenger->addWarningFlash("Tanggal selesai tidak bisa sebelum tanggal mulai");
            //     return $this->render('AddDalamKampus', [
            //         'model' => $model,
            //     ]);
            // }else if(round($datediff / (60 * 60 * 24)) >= 2){
            if($model->validate()){
                $model->save();

                //Atasan Handler
                if($model->atasan != null){
                    foreach($model->atasan as $data){
                        $modelAtasanSuratTugas = new AtasanSuratTugas();
                        $modelAtasanSuratTugas->id_pegawai = $data;
                        $modelAtasanSuratTugas->surat_tugas_id = $model->surat_tugas_id;
                        if($modelAtasanSuratTugas->validate()){
                            $modelAtasanSuratTugas->save();
                        }else{
                            $errors = $modelAtasanSuratTugas->errors;
                            print_r(array_values($errors));
                            die();
                        }
                    }
                }

                //Participants Handler
                foreach(Yii::$app->request->post()['Peserta'] as $data){
                    if($data['id_pegawai'] == "empty"){
                        continue;
                    }else{
                        $modelAssignee = new SuratTugasAssignee();
                        $modelAssignee->id_pegawai = $data['id_pegawai'];
                        $modelAssignee->surat_tugas_id = $model->surat_tugas_id;
                        $modelAssignee->deleted = 0;
                        if($modelAssignee->validate()){
                            $modelAssignee->save();
                        }else{
                            $errors = $modelAssignee->errors;
                            print_r(array_values($errors));
                            die();
                        }
                    }
                }

                //Files Handler
                $status = \Yii::$app->fileManager->saveUploadedFiles();
                if($status != null && $status->status == 'success'){
                    $total = count($status->fileinfo);
                    for ($i=0;$i<$total;$i++)
                    {
                        $modelFile = new SuratTugasFile();
                        $modelFile->surat_tugas_id = $model->surat_tugas_id;
                        $modelFile->nama_file = $status->fileinfo[$i]->name;
                        //$modelFile->lokasi_file = $fileDir;
                        $newFiles->kode_file = $status->fileinfo[$i]->id;
                        if($modelFile->validate()){
                            //Save file to directory $fileDir
                            //$file->saveAs($fileDir);

                            $modelFile->save();
                        }else{
                            $errors = $modelFile->errors;
                            print_r(array_values($errors));
                            die();
                        }
                    }
                }
                //$model->files = UploadedFile::getInstances($model, 'files');
                // if($model->files != null){
                //     foreach($model->files as $file){
                //         $modelFile = new SuratTugasFile();
                //         $fileDir = 'uploads/attachments/' . $file->baseName . '.' . $file->extension;
                //         $modelFile->surat_tugas_id = $model->surat_tugas_id;
                //         $modelFile->nama_file = $file->baseName;
                //         $modelFile->lokasi_file = $fileDir;
                //         $modelFile->deleted = 0;
                //         if($modelFile->validate()){
                //             //Save file to directory $fileDir
                //             $file->saveAs($fileDir);

                //             $modelFile->save();
                //         }else{
                //             $errors = $modelFile->errors;
                //             print_r(array_values($errors));
                //             die();
                //         }
                //     }
                // }
                
                return $this->redirect(['view-pegawai', 'id' => $model->surat_tugas_id]);
            }else{
                $errors = $model->errors;
                print_r(array_values($errors));
            }
            // }else{
            //     \Yii::$app->messenger->addWarningFlash("Permohonan minimal 2 hari sebelum keberangkatan");
            //     return $this->render('AddDalamKampus', [
            //         'model' => $model,
            //     ]);
            // }
        } else {
            return $this->render('AddDalamKampus', [
                'model' => $model,
                'modelAtasan' => $modelAtasan,
            ]);
        }
    }

    /**
     * action-id: edit-dalam-kampus
     * action-desc: If there are post request, call the save function else render _formUpdateDalamKampus
     */
    public function actionEditDalamKampus($id)
    {
        $model = $this->findModel($id);
        $modelPegawai = Pegawai::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
        $modelAtasan = InstApiModel::getAtasanByPegawaiId($modelPegawai->pegawai_id);
        $modelAssigned = AtasanSuratTugas::find()->select(['id_pegawai'])->where(['surat_tugas_id' => $id])->all();
        $modelSisaAtasan = $this->getSisaAtasan($modelPegawai->pegawai_id, $id);
        $modelAssignee = SuratTugasAssignee::find()->where(['surat_tugas_id' => $id])->all();
        $modelLampiran = SuratTugasFile::find()->where(['surat_tugas_id' => $id])->all();

        if ($model->load(Yii::$app->request->post())) {
            if($model->validate()){
                $model->save();

                //Atasan Handler
                if($model->atasan != null){
                    foreach($model->atasan as $data){
                        $modelAtasanSuratTugas = new AtasanSuratTugas();
                        $modelAtasanSuratTugas->id_pegawai = $data;
                        $modelAtasanSuratTugas->surat_tugas_id = $model->surat_tugas_id;
                        if($modelAtasanSuratTugas->validate()){
                            $modelAtasanSuratTugas->save();
                        }else{
                            $errors = $modelAtasanSuratTugas->errors;
                            print_r(array_values($errors));
                            die();
                        }
                    }
                }

                //Participants Handler
                foreach(Yii::$app->request->post()['Peserta'] as $data){
                    if($data['id_pegawai'] == "empty"){
                        continue;
                    }else{
                        $modelAssignee = new SuratTugasAssignee();
                        $modelAssignee->id_pegawai = $data['id_pegawai'];
                        $modelAssignee->surat_tugas_id = $model->surat_tugas_id;
                        $modelAssignee->deleted = 0;
                        if($modelAssignee->validate()){
                            $modelAssignee->save();
                        }else{
                            $errors = $modelAssignee->errors;
                            print_r(array_values($errors));
                            die();
                        }
                    }
                }

                //Files Handler
                $status = \Yii::$app->fileManager->saveUploadedFiles();
                if($status != null && $status->status == 'success'){
                    $total = count($status->fileinfo);
                    for ($i=0;$i<$total;$i++)
                    {
                        $modelFile = new SuratTugasFile();
                        $modelFile->surat_tugas_id = $model->surat_tugas_id;
                        $modelFile->nama_file = $status->fileinfo[$i]->name;
                        //$modelFile->lokasi_file = $fileDir;
                        $newFiles->kode_file = $status->fileinfo[$i]->id;
                        if($modelFile->validate()){
                            //Save file to directory $fileDir
                            //$file->saveAs($fileDir);

                            $modelFile->save();
                        }else{
                            $errors = $modelFile->errors;
                            print_r(array_values($errors));
                            die();
                        }
                    }
                }
                // if($model->files != null){
                //     $model->files = UploadedFile::getInstances($model, 'files');
                //     foreach($model->files as $file){
                //         $modelFile = new SuratTugasFile();
                //         $fileDir = 'uploads/attachments/' . $file->baseName . '.' . $file->extension;
                //         $modelFile->surat_tugas_id = $model->surat_tugas_id;
                //         $modelFile->nama_file = $file->baseName;
                //         $modelFile->lokasi_file = $fileDir;
                //         $modelFile->deleted = 0;
                //         if($modelFile->validate()){
                //             //Save file to directory $fileDir
                //             $file->saveAs($fileDir);

                //             $modelFile->save();
                //         }else{
                //             $errors = $modelFile->errors;
                //             print_r(array_values($errors));
                //             die();
                //         }
                //     }
                // }

                return $this->redirect(['view-pegawai', 'id' => $model->surat_tugas_id]);
            }else{
                $errors = $model->errors;
                print_r(array_values($errors));
            }
        } else {
            return $this->render('EditDalamKampus', [
                'model' => $model,
                'modelAtasan' => $modelAtasan,
                'modelAssigned' => $modelAssigned,
                'modelSisaAtasan' => $modelSisaAtasan,
                'modelAssignee' => $modelAssignee,
                'modelLampiran' => $modelLampiran,
            ]);
        }
    }

    /**
     * action-id: edit-luar-kampus
     * action-desc: If there are post request, call the save function else render _formUpdateLuarKampus
     */
    public function actionEditLuarKampus($id)
    {
        $model = $this->findModel($id);
        $modelPegawai = Pegawai::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
        $modelAtasan = InstApiModel::getAtasanByPegawaiId($modelPegawai->pegawai_id);
        $modelAssigned = AtasanSuratTugas::find()->select(['id_pegawai'])->where(['surat_tugas_id' => $id])->all();
        $modelSisaAtasan = $this->getSisaAtasan($modelPegawai->pegawai_id, $id);
        $modelAssignee = SuratTugasAssignee::find()->where(['surat_tugas_id' => $id])->all();
        $modelLampiran = SuratTugasFile::find()->where(['surat_tugas_id' => $id])->all();

        if ($model->load(Yii::$app->request->post())) {
            // echo $coba;
            if($model->validate()){
                $model->save();

                //Atasan Handler
                if($model->atasan != null){
                    foreach($model->atasan as $data){
                        $modelAtasanSuratTugas = new AtasanSuratTugas();
                        $modelAtasanSuratTugas->id_pegawai = $data;
                        $modelAtasanSuratTugas->surat_tugas_id = $model->surat_tugas_id;
                        if($modelAtasanSuratTugas->validate()){
                            $modelAtasanSuratTugas->save();
                        }else{
                            $errors = $modelAtasanSuratTugas->errors;
                            print_r(array_values($errors));
                            die();
                        }
                    }
                }

                //Participants Handler
                foreach(Yii::$app->request->post()['Peserta'] as $data){
                    if($data['id_pegawai'] == "empty"){
                        continue;
                    }else{
                        $modelAssignee = new SuratTugasAssignee();
                        $modelAssignee->id_pegawai = $data['id_pegawai'];
                        $modelAssignee->surat_tugas_id = $model->surat_tugas_id;
                        $modelAssignee->deleted = 0;
                        if($modelAssignee->validate()){
                            $modelAssignee->save();
                        }else{
                            $errors = $modelAssignee->errors;
                            print_r(array_values($errors));
                            die();
                        }
                    }
                }

                //Files Handler
                $status = \Yii::$app->fileManager->saveUploadedFiles();
                if($status != null && $status->status == 'success'){
                    $total = count($status->fileinfo);
                    for ($i=0;$i<$total;$i++)
                    {
                        $modelFile = new SuratTugasFile();
                        $modelFile->surat_tugas_id = $model->surat_tugas_id;
                        $modelFile->nama_file = $status->fileinfo[$i]->name;
                        //$modelFile->lokasi_file = $fileDir;
                        $newFiles->kode_file = $status->fileinfo[$i]->id;
                        if($modelFile->validate()){
                            //Save file to directory $fileDir
                            //$file->saveAs($fileDir);

                            $modelFile->save();
                        }else{
                            $errors = $modelFile->errors;
                            print_r(array_values($errors));
                            die();
                        }
                    }
                }
                
                // $model->files = UploadedFile::getInstances($model, 'files');
                // if($model->files != null){
                //     foreach($model->files as $file){
                //         $modelFile = new SuratTugasFile();
                //         $fileDir = 'uploads/attachments/' . $file->baseName . '.' . $file->extension;
                //         $modelFile->surat_tugas_id = $model->surat_tugas_id;
                //         $modelFile->nama_file = $file->baseName;
                //         $modelFile->lokasi_file = $fileDir;
                //         $modelFile->deleted = 0;
                //         if($modelFile->validate()){
                //             //Save file to directory $fileDir
                //             $file->saveAs($fileDir);

                //             $modelFile->save();
                //         }else{
                //             $errors = $modelFile->errors;
                //             print_r(array_values($errors));
                //             die();
                //         }
                //     }
                // }
           
                return $this->redirect(['view-pegawai', 'id' => $model->surat_tugas_id]);
            }else{
                $errors = $model->errors;
                print_r(array_values($errors));
            }
        } else {
            return $this->render('EditLuarKampus', [
                'model' => $model,
                'modelAtasan' => $modelAtasan,
                'modelAssigned' => $modelAssigned,
                'modelSisaAtasan' => $modelSisaAtasan,
                'modelAssignee' => $modelAssignee,
                'modelLampiran' => $modelLampiran,
            ]);
        }
    }

    /**
     * action-id: -
     * action-desc: Find specific data from SuratTugas model
     */
    protected function findModel($id)
    {
        if (($model = SuratTugas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * action-id: pegawais
     * action-desc: return JSON format data of pegawai
     */
    public function actionPegawais()
    {
        if(null !== Yii::$app->request->post()){
            $pegawais = Pegawai::find()->where('deleted!=1')->andWhere(['in', 'status_aktif_pegawai_id', [1, 2]])->orderBy(['nama' => SORT_ASC])->asArray()->all();
            
            return json_encode($pegawais);
        }else{
            return "Ajax failed";
        }
    }

    /**
     * action-id: pegawais-bawahan
     * action-desc: Return JSON format data of subordinate
     */
    public function actionPegawaisBawahan($id){
        if(null !== Yii::$app->request->post()){
            $pegawais = InstApiModel::getBawahanByPegawaiId($id);
            $data = ArrayHelper::toArray($pegawais);
           
            return json_encode($data);
        }else{
            return "Ajax failed";
        }
    }

    // public function actionDownloadAttachments($id){
    //     $model = SuratTugasFile::find()->where(['surat_tugas_file_id' => $id])->one();
    //     $path = Yii::getAlias('@webroot').'/';
    //     $file = $path.$model->lokasi_file;
    //     if(file_exists($file)){
    //         Yii::$app->response->sendFile($file);
    //     }else{
    //         echo "File's missing";
    //     }
    // }

    // public function actionDownloadReports($id){
    //     $model = LaporanSuratTugas::find()->where(['laporan_surat_tugas_id' => $id])->one();
    //     $path = Yii::getAlias('@webroot').'/';
    //     $file = $path.$model->lokasi_file;
    //     if(file_exists($file)){
    //         Yii::$app->response->sendFile($file);
    //     }else{
    //         echo "File's missing";
    //     }
    // }

    /**
     * action-id: review
     * action-desc: Give review to specific surat tugas
     */
    public function actionReview($id){
        $model = $this->findModel($id);
        if($model->load(Yii::$app->request->post())){
            $model->name = 2;
            if($model->validate()){
                $model->save();
                return $this->redirect(['view-surat-bawahan', 'id' => $model->surat_tugas_id]);
            }else{
                $errors = $model->errors;
                print_r(array_values($errors));
            }
        }
    }

    /**
     * action-id: terbitkan
     * action-desc: Publish specific surat tugas
     */
    public function actionTerbitkan($id){
        $model = $this->findModel($id);
        $modelLaporan = new LaporanSuratTugas();

        if($model->load(Yii::$app->request->post())){
            $model->name = 3;
            $modelLaporan->surat_tugas_id = $id;
            $modelLaporan->status_id = 8;
            $modelLaporan->batas_submit = date('Y-m-d H:i:s', strtotime('+2 day', strtotime($model->tanggal_kembali)));
            if($modelLaporan->validate()){
                $modelLaporan->save();
                if($model->validate()){
                    $model->save();
                    return $this->redirect(['view-hrd', 'id' => $model->surat_tugas_id]);
                }else{
                    $errors = $model->errors;
                    print_r(array_values($errors));
                }
            }else{
                $errors = $modelLaporan->errors;
                print_r(array_values($errors));
            }
        }
    }

    /**
     * action-id: terima
     * action-desc: Accept specific surat tugas
     */
    public function actionTerima($id){
        $model = $this->findModel($id);
        if($model->name == 1 || $model->name == 2 || $model->name == 4 || $model->name == 6){
            $model->name = 6;
            if($model->validate()){
                $model->save();
                return $this->redirect(['view-surat-bawahan', 'id' => $model->surat_tugas_id]);
            }else{
                $errors = $model->errors;
                print_r(array_values($errors));
            }
        }else{
            \Yii::$app->messenger->addErrorFlash("Surat tugas telah diterbitkan");
            $this->redirect('index-surat-bawahan');
        }
    }

    /**
     * action-id: tolak
     * action-desc: Reject specific surat tugas
     */
    public function actionTolak($id){
        $model = $this->findModel($id);
        if($model->name == 1 || $model->name == 2 || $model->name == 4 || $model->name == 6){
            $model->name = 4;
            if($model->validate()){
                $model->save();
                return $this->redirect(['view-surat-bawahan', 'id' => $model->surat_tugas_id]);
            }else{
                $errors = $model->errors;
                print_r(array_values($errors));
            }
        }else{
            \Yii::$app->messenger->addErrorFlash("Surat tugas telah diterbitkan");
            $this->redirect('index-surat-bawahan');
        }
    }

    /**
     * action-id: buka-submission?id=
     * action-desc: Open report submission time for specific surat tugas
     */
    // public function actionBukaSubmission($id){
    //     $model = $this->findModel($id);
    //     $modelLaporan = new LaporanSuratTugas();
    //     if($modelLaporan->load(Yii::$app->request->post())){
    //         //Set default value
    //         $modelLaporan->surat_tugas_id = $model->surat_tugas_id;
    //         $modelLaporan->deleted = 0;

    //         if($model->jenis_surat_id == 1){
    //             //Get the date difference
    //             $datediff = strtotime($modelLaporan->batas_submit) - strtotime($model->tanggal_kembali);

    //             if(round($datediff / (60 * 60 * 24)) >= 2){
    //                 if($modelLaporan->validate()){
    //                     $modelLaporan->save();
    //                     return $this->redirect(['view-hrd', 'id' => $model->surat_tugas_id]);
    //                 }else{
    //                     $errors = $model->errors;
    //                     print_r(array_values($errors));
    //                 }
    //             }else{
    //                 \Yii::$app->messenger->addWarningFlash("Minimal pembukaan submission adalah 2 hari setelah kembali");
    //                 $modelFile = SuratTugasFile::find()->where(['surat_tugas_id' => $model->surat_tugas_id])->all();
    //                 $modelAssignee = SuratTugasAssignee::find()->where(['surat_tugas_id' => $model->surat_tugas_id])->all();
    //                 return $this->render('ViewHrd', [
    //                     'model' => $model,
    //                     'modelAssignee' => $modelAssignee,
    //                     'modelFile' => $modelFile,
    //                 ]);
    //             }
    //         }else{
    //             //Get the date difference
    //             $datediff = strtotime($modelLaporan->batas_submit) - strtotime($model->tanggal_selesai);

    //             if(round($datediff / (60 * 60 * 24)) >= 2){
    //                 if($modelLaporan->validate()){
    //                     $modelLaporan->save();
    //                     return $this->redirect(['view-hrd', 'id' => $model->surat_tugas_id]);
    //                 }else{
    //                     $errors = $model->errors;
    //                     print_r(array_values($errors));
    //                 }
    //             }else{
    //                 \Yii::$app->messenger->addWarningFlash("Minimal pembukaan submission adalah 2 hari setelah tugas selesai");
    //                 $modelFile = SuratTugasFile::find()->where(['surat_tugas_id' => $model->surat_tugas_id])->all();
    //                 $modelAssignee = SuratTugasAssignee::find()->where(['surat_tugas_id' => $model->surat_tugas_id])->all();
    //                 return $this->render('ViewHrd', [
    //                     'model' => $model,
    //                     'modelAssignee' => $modelAssignee,
    //                     'modelFile' => $modelFile,
    //                 ]);
    //             }
    //         }
    //     }
    // }

    /**
     * action-id: edit-submission
     * action-desc: Edit report submission time of specific surat tugas
     */
    public function actionEditSubmission($id){
        $model = $this->findModel($id);
        $modelLaporan = SuratTugas::getLaporan($id);
        if($modelLaporan->load(Yii::$app->request->post())){
            if($modelLaporan->validate()){
                $modelLaporan->save();
                return $this->redirect(['view-hrd', 'id' => $model->surat_tugas_id]);
            }else{
                $errors = $model->errors;
                print_r(array_values($errors));
            }
        }
    }

    /**
     * action-id: delete-peserta
     * action-desc: Remove assignee from specific surat tugas dalam kampus
     */
    public function actionDeletePeserta($id, $surattugas){
        $model = SuratTugasAssignee::find()->where(['id_pegawai' => $id])->andWhere(['surat_tugas_id' => $surattugas])->one();
        if($model->forceDelete())
            return $this->redirect(['edit-dalam-kampus', 'id' => $surattugas]);
    }

    /**
     * action-id: delete-peserta-luar
     * action-desc: Remove assignee from specific surat tugas luar kampus
     */
    public function actionDeletePesertaLuar($id, $surattugas){
        $model = SuratTugasAssignee::find()->where(['id_pegawai' => $id])->andWhere(['surat_tugas_id' => $surattugas])->one();
        if($model->forceDelete())
            return $this->redirect(['edit-luar-kampus', 'id' => $surattugas]);
    }

    /**
     * action-id: delete-file
     * action-desc: Remove specific attachment from specific surat tugas
     */
    public function actionDeleteFile($id, $surattugas){
        $modelSurat = $this->findModel($surattugas);
        $model = SuratTugasFile::find()->where(['surat_tugas_file_id' => $id])->andWhere(['surat_tugas_id' => $surattugas])->one();
        //$path = Yii::getAlias('@webroot').'/';
        //$file = $path.$model->lokasi_file;
        // if(file_exists($file)){
        //     unlink($file);
        if($model->forceDelete()){
        //}
            if($modelSurat->jenis_surat_id == 1){
                return $this->redirect(['edit-luar-kampus', 'id' => $surattugas]);
            }else if($modelSurat->jenis_surat_id == 2){
                return $this->redirect(['edit-dalam-kampus', 'id' => $surattugas]);
            }
        }
    }

    public function getSisaAtasan($pegawai_id, $surattugas, $instansi_id=null){
        $modelAssigned = SuratTugas::getAssignedAtasan($surattugas);

        $current_date = date('Y-m-d');

        $pejabat = Pejabat::find()->select('struktur_jabatan_id')->where(['pegawai_id' => $pegawai_id])->andWhere(['<=', 'awal_masa_kerja', $current_date])->andWhere(['>=', 'akhir_masa_kerja', $current_date])->andWhere(['status_aktif' => 1])->andWhere('deleted != 1')->all();

        $struktur = StrukturJabatan::find()->select('parent as struktur_jabatan_id')->where(['in', 'struktur_jabatan_id', $pejabat])->andWhere('deleted != 1')->all();
        if($instansi_id!=null)
            $struktur = StrukturJabatan::find()->select('parent as struktur_jabatan_id')->where(['instansi_id' => $instansi_id])->andWhere(['in', 'struktur_jabatan_id', $pejabat])->andWhere('deleted != 1')->all();

        $parent = Pejabat::find()->select('pegawai_id')->where(['in', 'struktur_jabatan_id', $struktur])->andWhere(['<=', 'awal_masa_kerja', $current_date])->andWhere(['>=', 'akhir_masa_kerja', $current_date])->andWhere(['status_aktif' => 1])->andWhere('deleted != 1')->all();

        $pegawai = Pegawai::find()->where(['not in', 'pegawai_id', $modelAssigned])->andWhere('deleted != 1')->andWhere(['in', 'pegawai_id', $parent])->all();

        return $pegawai;
    }

    /**
     * action-id: delete-atasan
     * action-desc: Remove superior from specific surat tugas
     */
    public function actionDeleteAtasan($id, $surattugas){
        $modelSurat = $this->findModel($surattugas);
        $modelAtasan = AtasanSuratTugas::find()->where(['id_pegawai' => $id])->andWhere(['surat_tugas_id' => $surattugas])->one();
        $modelAtasan->forceDelete();
        if($modelSurat->jenis_surat_id == 1){
            return $this->redirect(['edit-luar-kampus', 'id' => $surattugas]);
        }else if($modelSurat->jenis_surat_id == 2){
            return $this->redirect(['edit-dalam-kampus', 'id' => $surattugas]);
        }
    }

    /**
     * action-id: submit-laporan
     * action-desc: Submit report of specific surat tugas
     */
    public function actionSubmitLaporan($id){
        $model = $this->findModel($id);
        $modelLaporan = SuratTugas::getLaporan($id);
        $today = time();
        $datediff = strtotime($modelLaporan->batas_submit) - $today;
        $datediff2 = $today - strtotime($model->tanggal_kembali);

        if(round($datediff / (60 * 60 * 24)) >= 2 && round($datediff2 / (60 * 60 * 24)) > 0){
            //Files Handler
            $status = \Yii::$app->fileManager->saveUploadedFiles();
            if($status != null && $status->status == 'success'){
                $total = count($status->fileinfo);
                for ($i=0;$i<$total;$i++)
                {
                    $modelFile = new SuratTugasFile();
                    $modelFile->surat_tugas_id = $model->surat_tugas_id;
                    $modelFile->nama_file = $status->fileinfo[$i]->name;
                    $modelFile->kode_file = $status->fileinfo[$i]->id;
                    if($modelFile->validate()){
                        $modelFile->save();
                    }else{
                        $errors = $modelFile->errors;
                        print_r(array_values($errors));
                        die();
                    }
                }
            }
            
            // $model->files = UploadedFile::getInstances($model, 'files');
            // foreach($model->files as $file){
            //     $fileDir = 'uploads/reports/' . $file->baseName . '.' . $file->extension;
            //     $modelLaporan->status_id = 7;
            //     $modelLaporan->nama_file = $file->baseName;
            //     $modelLaporan->lokasi_file = $fileDir;
            //     if($modelLaporan->validate()){
            //         //Save file to directory $fileDir
            //         $file->saveAs($fileDir);

            //         $modelLaporan->save();
            //     }else{
            //         $errors = $modelFile->errors;
            //         print_r(array_values($errors));
            //         die();
            //     }
            // }

            return $this->redirect(['view-pegawai', 'id' => $id]);
        }else{
            \Yii::$app->messenger->addWarningFlash("Waktu submit laporan telah ditutup");
            return $this->redirect(['view-pegawai', 'id' => $id]);
        }
    }

    /**
     * action-id: create-pdf
     * action-desc: Print specific surat tugas
     */
    public function actionCreatePdf($id){
        $modelLaporan = SuratTugas::find()->where(['surat_tugas_id' => $id])->one();
        $modelPegawaiId = SuratTugasAssignee::find()->where(['surat_tugas_id' => $id])->all();
        $arrayPegawaiId = array();
        foreach($modelPegawaiId as $pegawai){
            array_push($arrayPegawaiId, $pegawai['id_pegawai']);
        }
        $modelPeserta = Pegawai::find()->where(['in', 'pegawai_id', $arrayPegawaiId])->all();
        $mPDF = new mPDF('utf-8', 'A4', 10.5, 'arial');
        $mPDF->WriteHTML($this->renderPartial('mpdf', array('model' => $modelLaporan, 'pesertas' => $modelPeserta)));
        $mPDF->debug = true;
        $mPDF->Output($modelLaporan->agenda . ".pdf", "I");
        exit;
    }

    /**
     * action-id: terima-laporan
     * action-desc: Accept report of specific surat tugas
     */
    public function actionTerimaLaporan($id){
        $model = LaporanSuratTugas::find()->where(['surat_tugas_id' => $id])->one();
        // if($model->load(Yii::$app->request->post(), "")){
        if($model != null && $model->nama_file != null){
            $model->status_id = 9;
            if($model->validate()){
                $model->save();
                return $this->redirect(['view-wr', 'id' => $model->surat_tugas_id]);
            }else{
                $errors = $model->errors;
                print_r(array_values($errors));
            }
        }else{
            \Yii::$app->messenger->addErrorFlash("Surat tugas belum diterbitkan / laporan belum dimasukkan");
            $this->redirect('index-wr');
        }
    }

    /**
     * action-id: tolak-laporan
     * action-desc: Reject report of specific surat tugas
     */
    public function actionTolakLaporan($id){
        $model = LaporanSuratTugas::find()->where(['surat_tugas_id' => $id])->one();
        if($model != null  && $model->nama_file != null){
            $model->status_id = 10;
            if($model->validate()){
                $model->save();
                return $this->redirect(['view-wr', 'id' => $model->surat_tugas_id]);
            }else{
                $errors = $model->errors;
                print_r(array_values($errors));
            }
        }else{
            \Yii::$app->messenger->addErrorFlash("Surat tugas belum diterbitkan / laporan belum dimasukkan");
            $this->redirect('index-wr');
        }
    }

    /**
     * action-id: add-penugasan-luar-kampus
     * action-desc: If there are post request, call save function else render _formPenugasanLuarKampus
     */
    public function actionAddPenugasanLuarKampus(){
        $model = new SuratTugas();
        $modelPegawai = Pegawai::find()->where(['user_id' => Yii::$app->user->identity->id])->one();

        if($model->load(Yii::$app->request->post())){
            $model->perequest = $modelPegawai->pegawai_id;
            $model->jenis_surat_id = 3;
            $model->name = 6;

            if($model->validate()){
                $model->save();

                //Atasan Handler
                if($model->atasan != null){
                    foreach($model->atasan as $data){
                        $modelAtasanSuratTugas = new AtasanSuratTugas();
                        $modelAtasanSuratTugas->id_pegawai = $data;
                        $modelAtasanSuratTugas->surat_tugas_id = $model->surat_tugas_id;
                        $modelAtasanSuratTugas->perequest = $model->perequest;
                        if($modelAtasanSuratTugas->validate()){
                            $modelAtasanSuratTugas->save();
                        }else{
                            $errors = $modelAtasanSuratTugas->errors;
                            print_r(array_values($errors));
                            die();
                        }
                    }
                }
                
                //Participants Handler
                foreach(Yii::$app->request->post()['Peserta'] as $data){
                    if($data['id_pegawai'] == "empty"){
                        continue;
                    }else{
                        $modelAssignee = new SuratTugasAssignee();
                        $modelAssignee->id_pegawai = $data['id_pegawai'];
                        $modelAssignee->surat_tugas_id = $model->surat_tugas_id;
                        $modelAssignee->deleted = 0;
                        $pegawai = Pegawai::find()->where(['pegawai_id' => $modelAssignee->id_pegawai]);
                        if($modelAssignee->validate()){
                            $modelAssignee->save();
                            \Yii::$app->messenger->sendNotificationToUser((int) $pegawai->user_id, "Ada surat tugas dari atasan");
                        }else{
                            $errors = $modelAssignee->errors;
                            print_r(array_values($errors));
                            die();
                        }
                    }
                }

                //Files Handler
                $status = \Yii::$app->fileManager->saveUploadedFiles();
                        if($status != null && $status->status == 'success'){
                            $total = count($status->fileinfo);
                            for ($i=0;$i<$total;$i++)
                            {
                                $modelFile = new SuratTugasFile();
                                $modelFile->surat_tugas_id = $model->surat_tugas_id;
                                $modelFile->nama_file = $status->fileinfo[$i]->name;
                                //$modelFile->lokasi_file = $fileDir;
                                $modelFile->kode_file = $status->fileinfo[$i]->id;
                                if($modelFile->validate()){
                                    //Save file to directory $fileDir
                                    //$file->saveAs($fileDir);

                                    $modelFile->save();
                                }else{
                                    $errors = $modelFile->errors;
                                    print_r(array_values($errors));
                                    die();
                                }
                            }
                        }
                
                // $model->files = UploadedFile::getInstances($model, 'files');
                // if($model->files != null){
                //     foreach($model->files as $file){
                //         $modelFile = new SuratTugasFile();
                //         $fileDir = 'uploads/attachments/' . $file->baseName . '.' . $file->extension;
                //         $modelFile->surat_tugas_id = $model->surat_tugas_id;
                //         $modelFile->nama_file = $file->baseName;
                //         $modelFile->lokasi_file = $fileDir;
                //         $modelFile->deleted = 0;
                //         if($modelFile->validate()){
                //             //Save file to directory $fileDir
                //             $file->saveAs($fileDir);
                            
                //             $modelFile->save();
                //         }else{
                //             $errors = $modelFile->errors;
                //             print_r(array_values($errors));
                //             die();
                //         }
                //     }
                // }

                return $this->redirect(['view-pegawai', 'id' => $model->surat_tugas_id]);
            }else{
                $errors = $model->errors;
                print_r(array_values($errors));
            }

        }else{
            // $pegawai = Pegawai::find()->where(['user_id' => Yii::$app->user->identity->id])->one();

            return $this->render('PenugasanLuar', [
                'model' => $model,
                'pegawai' => $modelPegawai,
            ]);
        }
    }
    
    /**
     * action-id: add-keterangan
     * action-desc: Add description of specific surat tugas
     */
    public function actionAddKeterangan($id){
        $model = $this->findModel($id);

        if($model->load(Yii::$app->request->post())){
            if($model->validate()){
                $model->save();
            }else{
                $errors = $model->errors;
                print_r(array_values($errors));
            }
        }
        
        return $this->redirect(['view-hrd', 'id' => $model->surat_tugas_id]);
    }

    /**
     * action-id: add-catatan
     * action-desc: Give note to specific surat tugas
     */
    public function actionAddCatatan($id){
        $model = $this->findModel($id);
    
        if($model->load(Yii::$app->request->post())){
            if($model->validate()){
                $model->save();
            }else{
                $errors = $model->errors;
                print_r(array_values($errors));
            }
        }
        
        return $this->redirect(['view-hrd', 'id' => $model->surat_tugas_id]);
    }

    /**
     * action-id: tolak-surat-tugas
     * action-desc: Confirmation before rejecting surat tugas
     */
    public function actionTolakSuratTugas($id){
        return $this->render('TolakSuratTugas', [
            'id' => $id,
        ]);
    }

    /**
     * action-id: tolak-laporan-tugas
     * action-desc: Confirmation before rejecting report of surat tugas
     */
    public function actionTolakLaporanTugas($id){
        return $this->render('TolakLaporanTugas', [
            'id' => $id,
        ]);
    }

}
