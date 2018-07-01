<?php

namespace backend\modules\askm\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\askm\models\IzinKeluar;
use backend\modules\hrdx\models\Pegawai;

/**
 * IzinKeluarSearch represents the model behind the search form about `backend\modules\askm\models\IzinKeluar`.
 */
class IzinKeluarSearch extends IzinKeluar
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['izin_keluar_id', 'dim_id', 'dosen_wali_id', 'baak_id', 'keasramaan_id', 'status_request_baak', 'status_request_keasramaan', 'status_request_dosen_wali', 'deleted'], 'integer'],
            [['rencana_berangkat', 'rencana_kembali', 'realisasi_berangkat', 'realisasi_kembali', 'desc', 'deleted_at', 'deleted_by', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = IzinKeluar::find();
        $query->joinWith(['dim']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 15,
            ],
            'sort' => ['defaultOrder' => [
                'status_request_dosen_wali' => SORT_ASC,
                'status_request_keasramaan' => SORT_ASC,
                'status_request_baak' => SORT_ASC,
                'updated_at' => SORT_DESC, 
                'created_at' => SORT_DESC
            ]],
        ]);


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'izin_keluar_id' => $this->izin_keluar_id,
            'rencana_berangkat' => $this->rencana_berangkat,
            'rencana_kembali' => $this->rencana_kembali,
            'realisasi_berangkat' => $this->realisasi_berangkat,
            'realisasi_kembali' => $this->realisasi_kembali,
            'dim_id' => $this->dim_id,
            'dosen_wali_id' => $this->dosen_wali_id,
            'baak_id' => $this->baak_id,
            'keasramaan_id' => $this->keasramaan_id,
            'status_request_baak' => $this->status_request_baak,
            'status_request_keasramaan' => $this->status_request_keasramaan,
            'status_request_dosen_wali' => $this->status_request_dosen_wali,
            'deleted' => $this->deleted,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'deleted_by', $this->deleted_by])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by])
            ->andFilterWhere(['not', ['status_request_baak' => 4]])
            ->andFilterWhere(['not', ['status_request_dosen_wali' => 4]])
            ->andFilterWhere(['not', ['status_request_keasramaan' => 4]])
            ->andFilterWhere(['like', 'dimx_dim.status_akhir', 'Aktif'])
            ->andFilterWhere(['not', ['askm_izin_keluar.deleted' => 1]]);

        return $dataProvider;
    }

    public function searchByMahasiswa($params)
    {
        $query = IzinKeluar::find();
        $query->joinWith(['dim']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 15,
            ],
            'sort' => ['defaultOrder' => [
                'status_request_dosen_wali' => SORT_ASC,
                'status_request_keasramaan' => SORT_ASC,
                'status_request_baak' => SORT_ASC,
                'updated_at' => SORT_DESC, 
                'created_at' => SORT_DESC
            ]],
        ]);


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'izin_keluar_id' => $this->izin_keluar_id,
            'rencana_berangkat' => $this->rencana_berangkat,
            'rencana_kembali' => $this->rencana_kembali,
            'realisasi_berangkat' => $this->realisasi_berangkat,
            'realisasi_kembali' => $this->realisasi_kembali,
            'dimx_dim.user_id' => Yii::$app->user->identity->user_id,
            'dosen_wali_id' => $this->dosen_wali_id,
            'baak_id' => $this->baak_id,
            'keasramaan_id' => $this->keasramaan_id,
            'status_request_baak' => $this->status_request_baak,
            'status_request_keasramaan' => $this->status_request_keasramaan,
            'status_request_dosen_wali' => $this->status_request_dosen_wali,
            'deleted' => $this->deleted,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'deleted_by', $this->deleted_by])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by])
            ->andFilterWhere(['not', ['status_request_baak' => 4]])
            ->andFilterWhere(['not', ['status_request_dosen_wali' => 4]])
            ->andFilterWhere(['not', ['status_request_keasramaan' => 4]])
            ->andFilterWhere(['like', 'dimx_dim.status_akhir', 'Aktif'])
            ->andFilterWhere(['not', ['askm_izin_keluar.deleted' => 1]]);

        return $dataProvider;
    }

    public function searchByDosenWali($params)
    {
        $query = IzinKeluar::find();
        $query->joinWith(['dim', 'dim.registrasis']);

        $pegawai = Pegawai::find()->where('deleted != 1')->andWhere(['user_id' => \Yii::$app->user->identity->user_id])->one();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 15,
            ],
            'sort' => ['defaultOrder' => [
                'status_request_dosen_wali' => SORT_ASC,
                'status_request_keasramaan' => SORT_ASC,
                'status_request_baak' => SORT_ASC,
                'updated_at' => SORT_DESC, 
                'created_at' => SORT_DESC
            ]],
        ]);


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'izin_keluar_id' => $this->izin_keluar_id,
            'rencana_berangkat' => $this->rencana_berangkat,
            'rencana_kembali' => $this->rencana_kembali,
            'realisasi_berangkat' => $this->realisasi_berangkat,
            'realisasi_kembali' => $this->realisasi_kembali,
            'dim_id' => $this->dim_id,
            'dosen_wali_id' => $this->dosen_wali_id,
            'baak_id' => $this->baak_id,
            'keasramaan_id' => $this->keasramaan_id,
            'status_request_baak' => $this->status_request_baak,
            'status_request_keasramaan' => $this->status_request_keasramaan,
            'status_request_dosen_wali' => $this->status_request_dosen_wali,
            'deleted' => $this->deleted,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['not', ['adak_registrasi.deleted' => 1]])
            ->andFilterWhere(['adak_registrasi.status_akhir_registrasi' => 'Aktif'])
            ->andFilterWhere(['adak_registrasi.ta' => \Yii::$app->appConfig->get('tahun_ajaran', true)])
            ->andFilterWhere(['adak_registrasi.sem_ta' => \Yii::$app->appConfig->get('semester_tahun_ajaran', true)])
            ->andFilterWhere(['adak_registrasi.dosen_wali_id' => $pegawai->pegawai_id])
            ->andFilterWhere(['like', 'deleted_by', $this->deleted_by])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by])
            ->andFilterWhere(['not', ['status_request_baak' => 4]])
            ->andFilterWhere(['not', ['status_request_dosen_wali' => 4]])
            ->andFilterWhere(['not', ['status_request_keasramaan' => 4]])
            ->andFilterWhere(['like', 'dimx_dim.status_akhir', 'Aktif'])
            ->andFilterWhere(['not', ['askm_izin_keluar.deleted' => 1]]);

        return $dataProvider;
    }
}
