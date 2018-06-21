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
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;

/**
 * SuratTugasController implements the CRUD actions for SuratTugas model.
 */
class SuratTugasController extends Controller
{
    public function behaviors()
    {
        return [
            //TODO: crud controller actions are bypassed by default, set the appropriate privilege
            'privilege' => [
                 'class' => \Yii::$app->privilegeControl->getAppPrivilegeControlClass(),
                 'skipActions' => ['*'],
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
     * Lists all SuratTugas models.
     * @return mixed
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

    public function actionIndexHrd(){
        $searchModel = new SuratTugasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        // $dataProvider->query->where("status_id = 6 or status_id = 3")->orderBy(['created_at' => SORT_DESC]);
        $jenisSurat = JenisSurat::find()->all();
        $status = Status::find()->where(['in', 'status_id', [6, 3]])->andWhere('deleted!=1')->all();

        return $this->render('IndexHrd', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'jenisSurat' => $jenisSurat,
            'status' => $status,
        ]);
    }

    public function actionIndexWr(){
        $searchModel = new SuratTugasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        // $dataProvider->query->where("status_id = 6 or status_id = 3")->orderBy(['created_at' => SORT_DESC]);
        $jenisSurat = JenisSurat::find()->all();
        $status = Status::find()->where(['in', 'status_id', [6, 3]])->all();

        return $this->render('IndexWr', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'jenisSurat' => $jenisSurat,
            'status' => $status,
        ]);
    }

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
     * Displays a single SuratTugas model.
     * @param integer $id
     * @return mixed
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
    * Add Luar Kampus
    */
    public function actionAddLuarKampus()
    {
        $model = new SuratTugas();
        $modelPegawai = Pegawai::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
        $modelAtasan = InstApiModel::getAtasanByPegawaiId($modelPegawai->pegawai_id);

        if ($model->load(Yii::$app->request->post())) {
            //Set Default Information
            $model->perequest = $modelPegawai->pegawai_id;
            $model->jenis_surat_id = 1;
            $model->status_id = 1;

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
                //if($model->files != null){
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
                                if(!$modelFile->save()){
                                    $errors = $modelFile->errors;
                                    print_r(array_values($errors));
                                    die();
                                }
                            }
                        }
                
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
    * Add Dalam Kampus
    */
    public function actionAddDalamKampus()
    {
        $model = new SuratTugas();
        $modelPegawai = Pegawai::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
        $modelAtasan = InstApiModel::getAtasanByPegawaiId($modelPegawai->pegawai_id);

        if ($model->load(Yii::$app->request->post())) {
            //Set Default Information
            $model->perequest = $modelPegawai->pegawai_id;
            $model->status_id = 1;
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
                                $modelFile->kode_file = $status->fileinfo[$i]->id;
                                if(!$modelFile->save()){
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
     * Updates an existing SuratTugas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
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
                                $modelFile->kode_file = $status->fileinfo[$i]->id;
                                if(!$modelFile->save()){
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
     * Ubah Luar Kampus
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
                                $modelFile->kode_file = $status->fileinfo[$i]->id;
                                if(!$modelFile->save()){
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
                    return $this->redirect(['view-pegawai', 'id' => $model->surat_tugas_id]);
                //}
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
     * Finds the SuratTugas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SuratTugas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
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
     * Other action
     */

    /**
    * Get data from Pegawai table
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

    public function actionPegawaisBawahan($id){
        if(null !== Yii::$app->request->post()){
            $pegawais = InstApiModel::getBawahanByPegawaiId($id);
            $data = ArrayHelper::toArray($pegawais);
           
            return json_encode($data);
        }else{
            return "Ajax failed";
        }
    }

    /**
    * Download attachments from surat tugas
    */
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

    /**
     * Download reports from surat tugas
     */
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
    * Review Surat Tugas
    */
    public function actionReview($id){
        $model = $this->findModel($id);
        if($model->load(Yii::$app->request->post())){
            $model->status_id = 2;
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
    * Terima Surat Tugas
    */
    public function actionTerbitkan($id){
        $model = $this->findModel($id);
        $modelLaporan = new LaporanSuratTugas();

        if($model->load(Yii::$app->request->post())){
            $model->status_id = 3;
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

    public function actionTerima($id){
        $model = $this->findModel($id);
        // if($model->load(Yii::$app->request->post(), "")){
            $model->status_id = 6;
            if($model->validate()){
                $model->save();
                return $this->redirect(['view-surat-bawahan', 'id' => $model->surat_tugas_id]);
            }else{
                $errors = $model->errors;
                print_r(array_values($errors));
            }
        // }
    }

    /**
    * Tolak Surat Tugas
    */
    public function actionTolak($id){
        $model = $this->findModel($id);
        // if($model->load(Yii::$app->request->post(), "")){
            $model->status_id = 4;
            if($model->validate()){
                $model->save();
                return $this->redirect(['view-surat-bawahan', 'id' => $model->surat_tugas_id]);
            }else{
                $errors = $model->errors;
                print_r(array_values($errors));
            }
        // }
    }

    /**
    * Buka Submission
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
    * Ubah Submission
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
    * Hapus Peserta
    */
    public function actionDeletePeserta($id, $surattugas){
        $model = SuratTugasAssignee::find()->where(['id_pegawai' => $id])->andWhere(['surat_tugas_id' => $surattugas])->one();
        $model->forceDelete();

        return $this->redirect(['edit-dalam-kampus', 'id' => $surattugas]);
    }

    public function actionDeletePesertaLuar($id, $surattugas){
        $model = SuratTugasAssignee::find()->where(['id_pegawai' => $id])->andWhere(['surat_tugas_id' => $surattugas])->one();
        $model->forceDelete();

        return $this->redirect(['edit-luar-kampus', 'id' => $surattugas]);
    }

    /**
     * Hapus Lampiran
     */
    public function actionDeleteFile($id, $surattugas){
        $model = SuratTugasFile::find()->where(['file_id' => $id])->andWhere(['surat_tugas_id' => $surattugas])->one();
        // $path = Yii::getAlias('@webroot').'/';
        // $file = $path.$model->lokasi_file;
        //if(file_exists($file)){
            //unlink($file);
            if($model->forceDelete()){
                return $this->redirect(['edit-dalam-kampus', 'id' => $surattugas]);        
            }
            else{
                echo '<pre>';
                print_r($model->errors);
                die;
            }
        //}

        
    }

    /**
     * Ambil Sisa Atasan
     */
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
     * Hapus Atasan
     */
    public function actionDeleteAtasan($id, $surattugas){
        $modelAtasan = AtasanSuratTugas::find()->where(['id_pegawai' => $id])->andWhere(['surat_tugas_id' => $surattugas])->one();
        if($modelAtasan->forceDelete()){
            return $this->redirect(['edit-dalam-kampus', 'id' => $surattugas]);
        }else{
                echo '<pre>';
                print_r($modelAtasan->errors);
                die;
            }
    }

    /**
     * Submit Laporan
     */
    public function actionSubmitLaporan($id){
        $model = $this->findModel($id);
        $modelLaporan = SuratTugas::getLaporan($id);
        $today = time();
        $datediff = strtotime($modelLaporan->batas_submit) - $today;

        if(round($datediff / (60 * 60 * 24)) >= 2){
            //Files Handler
            $status = \Yii::$app->fileManager->saveUploadedFiles();
                        if($status != null && $status->status == 'success'){
                            $total = count($status->fileinfo);
                            for ($i=0;$i<$total;$i++)
                            {
                                $modelLaporan->status_id = 7;
                                $modelLaporan->nama_file = $status->fileinfo[$i]->name;
                                //$modelFile->lokasi_file = $fileDir;
                                $modelLaporan->kode_file = $status->fileinfo[$i]->id;
                                if(!$modelLaporan->save()){
                                    $errors = $modelLaporan->errors;
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
     * Print Surat Tugas
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
     * Terima Laporan
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
     * Tolak Laporan
     */
    public function actionTolakLaporan($id){
        $model = LaporanSuratTugas::find()->where(['surat_tugas_id' => $id])->one();
        // if($model->load(Yii::$app->request->post(), "")){
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
     * Penugasan Luar Kampus
     */
    public function actionAddPenugasanLuarKampus(){
        $model = new SuratTugas();
        $modelPegawai = Pegawai::find()->where(['user_id' => Yii::$app->user->identity->id])->one();

        if($model->load(Yii::$app->request->post())){
            $model->perequest = $modelPegawai->pegawai_id;
            $model->jenis_surat_id = 3;
            $model->status_id = 6;

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
                                $modelFile->kode_file = $status->fileinfo[$i]->id;
                                if(!$modelFile->save()){
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

        }else{
            // $pegawai = Pegawai::find()->where(['user_id' => Yii::$app->user->identity->id])->one();

            return $this->render('PenugasanLuar', [
                'model' => $model,
                'pegawai' => $modelPegawai,
            ]);
        }
    }
    
    /**
     * Tambah Keterangan
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
     * Tambah Catatan
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
     * Konfimasi Tolak Surat Tugas
     */
    public function actionTolakSuratTugas($id){
        return $this->render('TolakSuratTugas', [
            'id' => $id,
        ]);
    }

    /**
     * Konfimasi Laporan Surat Tugas
     */
    public function actionTolakLaporanTugas($id){
        return $this->render('TolakLaporanTugas', [
            'id' => $id,
        ]);
    }

}
