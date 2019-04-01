<?php

namespace backend\modules\askm\controllers;

use Yii;
use backend\modules\askm\models\LogMahasiswa;
use backend\modules\askm\models\IzinKeluar;
use backend\modules\askm\models\IzinBermalam;
use backend\modules\askm\models\Dim;
use backend\modules\askm\models\LokasiLog;

use backend\modules\askm\models\search\LogMahasiswaSearch;
use backend\modules\askm\models\search\IzinKeluarSearch;
use backend\modules\askm\models\search\IzinBermalamSearch;

use yii\rest\ActiveController;
use yii\helpers\Json;
use yii\data\ArrayDataProvider;

class AskmApiController extends ActiveController
{

	public $modelClass = 'backend\modules\askm\models\LogMahasiswa';
    private $_pageSize = 10;

	public function beforeAction($action){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return true;
    }

    // list log mahasiswa keluar masuk
	public function actionLogMahasiswaAll(){
		$searchModel = new LogMahasiswaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$data = [];
		foreach ($dataProvider->models as $d) {
			$temp = $this->actionLogMahasiswaView($d->log_mahasiswa_id);
			$data[] = $temp;
		}
		$res = new ArrayDataProvider([
			'allModels' => $data,
			'pagination' => [
				'pageSize' => $this->_pageSize,
			],
		]);
		return $res;
	}

	// lihat detail log mahasiswa 
	public function actionLogMahasiswaView($id){
		$log = LogMahasiswa::find()->where('deleted!=1')->andWhere(['log_mahasiswa_id'=>$id])->one();
		$mhs = Dim::find()->where('deleted!=1')->andWhere(['dim_id'=>$log->dim_id])->one();
		$lokasi = LokasiLog::find()->where(['lokasi_log_id'=>$log->lokasi_log_id])->andWhere('deleted != 1')->one();
		
		$temp = (object)[
        		"log_mahasiswa_id" => $log->log_mahasiswa_id,
			    "dim_id" => $log->dim_id,
			    "dim_nama" => $mhs->nama,
			    'dim_nim' => $mhs->nim,
			    "tanggal_keluar" => $log->tanggal_keluar,
			    "tanggal_masuk" => $log->tanggal_masuk,
			    "lokasi_log_id" => $log->lokasi_log_id,
			    "lokasi" => $lokasi ? $lokasi->name:'-',
            ];

		return $temp;
	}

	// action untuk mencari log mahasiswa 
	public function actionLogMahasiswaCari(){
		$nim = Yii::$app->request->post('nim');
		$lokasi_log_id = Yii::$app->request->post('lokasi_log_id');
		if(!$nim || !$lokasi_log_id){
			return (object)[ 'result' => false,'message' => "nim dan lokasi_log_id harus diisi"]; 
		}

        $mahasiswa = Dim::find()->where(['nim'=>$nim])->andWhere(['status_akhir'=>'Aktif'])->one();
        $lokasi = LokasiLog::find()->where(['lokasi_log_id'=>$lokasi_log_id])->andWhere('deleted != 1')->one();

        if (is_object($mahasiswa)){
            $dim_id = $mahasiswa->dim_id;
            $model = new LogMahasiswa();
            /* Untuk mengambil log terakhir mahasiswa yang tanggal masuknya Null*/
            $LogMahasiswa = LogMahasiswa::find()
		            	->where(['dim_id' => $dim_id])
		            	->andWhere(['is' ,'tanggal_masuk', NULL])
		            	->andWhere(['lokasi_log_id' => $lokasi_log_id])
		            	->orderBy(['log_mahasiswa_id'=>SORT_DESC])
		            	->one();
            /** Menyimpan tanggal Masuk Mahasiswa */
            if (is_object($LogMahasiswa)){
                $LogMahasiswa->tanggal_masuk = date('Y-m-d H:i:s');
                $LogMahasiswa->lokasi_log_id = $lokasi_log_id;
			           
                if($LogMahasiswa->save()){
                	$res = (object)[
                		"log_mahasiswa_id" => $LogMahasiswa->log_mahasiswa_id,
					    "dim_id" => $LogMahasiswa->dim_id,
					    "dim_nama" => $mahasiswa->nama,
					    "kode_foto" => $mahasiswa->kode_foto,
					    "tanggal_keluar" => $LogMahasiswa->tanggal_keluar,
					    "tanggal_masuk" => $LogMahasiswa->tanggal_masuk,
					    "lokasi_log_id" => $LogMahasiswa->lokasi_log_id,
					    "lokasi" => $lokasi->name,
                	];
                	return $res;
                }
            }
            /* Menyimpan Tanggal Keluar Mahasiswa */
            else {
                    $model->dim_id = $dim_id;
                    $model->tanggal_keluar = date('Y-m-d H:i:s');
                    $model->lokasi_log_id = $lokasi_log_id;
                    
                    if ($model->save()){
                    	$res = (object)[
	                		"log_mahasiswa_id" => $model->log_mahasiswa_id,
						    "dim_id" => $model->dim_id,
						    "dim_nama" => $mahasiswa->nama,
						    "kode_foto" => $mahasiswa->kode_foto,
						    "tanggal_keluar" => $model->tanggal_keluar,
						    "tanggal_masuk" => $model->tanggal_masuk,
						    "lokasi_log_id" => $model->lokasi_log_id,
					    	"lokasi" => $lokasi->name,
	                	];
                	return $res;
                    }
                }
            }
        return (object)[ 'result' => false,'message' => "nim tidak ditemukan"]; 
	}

	// action untuk mencari isin keluar mahasiswa
	public function actionIzinKeluarCari(){
        $nim = Yii::$app->request->post('nim');
		$lokasi_log_id = Yii::$app->request->post('lokasi_log_id');
		if(!$nim || !$lokasi_log_id){
			return (object)[ 'result' => false,'message' => "nim dan lokasi_log_id harus diisi"]; 
		}

        $mahasiswa = Dim::find()->where(['nim'=>$nim])->andWhere(['status_akhir'=>'Aktif'])->one();
        $lokasi = LokasiLog::find()->where(['lokasi_log_id'=>$lokasi_log_id])->andWhere('deleted != 1')->one();

        if(is_object($mahasiswa)){
            $dim_id = $mahasiswa->dim_id;
            $izinKeluar = IzinKeluar::find()
            		->where(['dim_id'=>$dim_id])
            		->andWhere(['deleted'=>0])
            		->andWhere(['status_request_baak'=>2])
            		->orderBy(['izin_keluar_id' => SORT_DESC])
            		->one();

            if(is_object($izinKeluar)){
                if($izinKeluar->realisasi_berangkat==NULL){
                    $izinKeluar->realisasi_berangkat= date('Y-m-d H:i:s');
                    $izinKeluar->lokasi_log_id = $lokasi_log_id;
                }else if ($izinKeluar->realisasi_kembali==NULL){
                    $izinKeluar->realisasi_kembali= date('Y-m-d H:i:s');
                    $izinKeluar->lokasi_log_id = $lokasi_log_id;
                }else{
                	return (object)[ 'result' => false,'message' => "data izin keluar tidak ditemukan"]; 
                }
                
                if ($izinKeluar->save()){
                	$res = (object)[
                		'izin_keluar_id' => $izinKeluar->izin_keluar_id,
			            'rencana_berangkat' => $izinKeluar->rencana_berangkat,
			            'rencana_kembali' => $izinKeluar->rencana_kembali,
			            'realisasi_berangkat' => $izinKeluar->realisasi_berangkat,
			            'realisasi_kembali' => $izinKeluar->realisasi_kembali,
			            'dim_id' => $izinKeluar->dim_id,
			            'dim_nama' => $mahasiswa->nama,
			            'kode_foto' => $mahasiswa->kode_foto,
			            'lokasi_log_id' => $lokasi_log_id,
			            'lokasi' => $lokasi->name,
			            'created_at' => $izinKeluar->created_at,
                	];
	                return $res;
                }
            }else{
                return (object)[ 'result' => false,'message' => "data izin keluar tidak ditemukan"]; 
            }
        }
        return (object)[ 'result' => false,'message' => "nim tidak ditemukan"]; 
    }

    // action untuk mencari izin bermalam mahasiswa
    public function actionIzinBermalamCari(){
    	$nim = Yii::$app->request->post('nim');
		$lokasi_log_id = Yii::$app->request->post('lokasi_log_id');
		if(!$nim || !$lokasi_log_id){
			return (object)[ 'result' => false,'message' => "nim dan lokasi_log_id harus diisi"]; 
		}

        $mahasiswa = Dim::find()->where(['nim'=>$nim])->andWhere(['status_akhir'=>'Aktif'])->one();
        $lokasi = LokasiLog::find()->where(['lokasi_log_id'=>$lokasi_log_id])->andWhere('deleted != 1')->one();

        if(is_object($mahasiswa)){
            $dim_id = $mahasiswa->dim_id;
            $izinBermalam = IzinBermalam::find()
            		->where(['dim_id'=>$dim_id])
            		->AndWhere(['status_request_id'=>2,'deleted'=>0])
            		->andWhere(['realisasi_kembali'=>NULL])
            		->orderBy(['izin_bermalam_id'=>SORT_DESC])
            		->one();

            if(is_object($izinBermalam)){
                if($izinBermalam->realisasi_berangkat==NULL){
                    $izinBermalam->realisasi_berangkat = date('Y-m-d H:i:s');
                    $izinBermalam->lokasi_log_id = $lokasi_log_id;
                }else if($izinBermalam->realisasi_kembali==NULL){
                    $izinBermalam->realisasi_kembali= date('Y-m-d H:i:s');
                    $izinBermalam->lokasi_log_id = $lokasi_log_id;
                }else{
                	return (object)[ 'result' => false,'message' => "data izin bermalam tidak ditemukan"]; 
                }

                if ($izinBermalam->save()){
                	return (object)[
			            'izin_bermalam_id' => $izinBermalam->izin_bermalam_id,
			            'rencana_berangkat' => $izinBermalam->rencana_berangkat,
			            'rencana_kembali' => $izinBermalam->rencana_kembali,
			            'realisasi_berangkat' => $izinBermalam->realisasi_berangkat,
			            'realisasi_kembali' => $izinBermalam->realisasi_kembali,
			            'desc' => $izinBermalam->desc,
			            'tujuan' =>$izinBermalam->tujuan,
			            'dim_id' => $izinBermalam->dim_id,
			            'dim_nama' => $mahasiswa->nama,
			            'kode_foto' => $mahasiswa->kode_foto,
			            'lokasi_log_id' => $izinBermalam->lokasi_log_id,
			            'lokasi' => $lokasi->name,
			             'created_at' =>$izinBermalam->created_at,
                	];
                }
            }else{
                return (object)[ 'result' => false,'message' => "data izin bermalam tidak ditemukan"]; 
            }
        }
        return (object)[ 'result' => false,'message' => "nim tidak ditemukan"]; 
    }

	// list izin keluar 
	public function actionIzinKeluarAll(){
		$searchModel = new IzinKeluarSearch();
    	$dataProvider = $searchModel->searchIkApi(Yii::$app->request->queryParams);
		$data = [];
		foreach ($dataProvider->models as $d) {
			$temp = $this->actionIzinKeluarView($d->izin_keluar_id);
			$data[] = $temp;
		}
		$res = new ArrayDataProvider([
			'allModels' => $data,
			'pagination' => [
				'pageSize' => $this->_pageSize,
			],
		]);
		return $res;
	}

	// detail izin keluar 
	public function actionIzinKeluarView($id){
		$ik = IzinKeluar::find()
			->where('deleted!=1')
			->AndWhere(['status_request_dosen_wali'=>2,'status_request_keasramaan'=>2,'status_request_baak'=>2])
			->AndWhere(['izin_keluar_id'=>$id])
			->one();
		$mhs = Dim::find()->where('deleted!=1')->andWhere(['dim_id'=>$ik->dim_id])->one();
		$res = (object)[
			'izin_keluar_id' => $ik->izin_keluar_id,
            'rencana_berangkat' => $ik->rencana_berangkat,
            'rencana_kembali' => $ik->rencana_kembali,
            'realisasi_berangkat' => $ik->realisasi_berangkat,
            'realisasi_kembali' => $ik->realisasi_kembali,
            'desc' => $ik->desc,
            'dim_id' => $ik->dim_id,
            'dim_nama'=> $mhs->nama,
            'dim_nim' => $mhs->nim,
		];

		return $res;
	}

	public function actionIzinBermalamAll(){
		$searchModel = new IzinBermalamSearch();
    	$dataProvider = $searchModel->searchIbApi(Yii::$app->request->queryParams);
		$data = [];
		foreach ($dataProvider->models as $d) {
			$temp = $this->actionIzinBermalamView($d->izin_bermalam_id);
			$data[] = $temp;
		}
		$res = new ArrayDataProvider([
			'allModels' => $data,
			'pagination' => [
				'pageSize' => $this->_pageSize,
			],
		]);
		return $res;
	}

	public function actionIzinBermalamView($id){
		$ib = IzinBermalam::find()
			->andWhere('askm_izin_bermalam.deleted!=1')
			->andWhere(['status_request_id'=>2])
			->andWhere(['izin_bermalam_id'=>$id])
			->one();

		$mhs = Dim::find()->where('deleted!=1')->andWhere(['dim_id'=>$ib->dim_id])->one();

		$res = (object)[
			'izin_bermalam_id' => $ib->izin_bermalam_id,
            'rencana_berangkat' => $ib->rencana_berangkat,
            'rencana_kembali' => $ib->rencana_kembali,
            'realisasi_berangkat' => $ib->realisasi_berangkat,
            'realisasi_kembali' => $ib->realisasi_kembali,
            'desc' => $ib->desc,
            'tujuan' => $ib->tujuan,
            'dim_id' => $ib->dim_id,
            'dim_nama'=> $mhs->nama,
            'dim_nim'=> $mhs->nim,
		];

		return $res;
	}
}