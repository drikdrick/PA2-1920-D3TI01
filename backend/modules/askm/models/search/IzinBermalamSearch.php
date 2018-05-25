<?php

namespace backend\modules\askm\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\askm\models\IzinBermalam;

/**
 * IzinBermalamSearch represents the model behind the search form about `backend\modules\askm\models\IzinBermalam`.
 */
class IzinBermalamSearch extends IzinBermalam
{
    public $dim_nama;
    public $dim_prodi;
    public $dim_angkatan;
    public $dim_kamar;
    public $dim_asrama;
    public $keasramaan;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['izin_bermalam_id', 'dim_id', 'keasramaan_id', 'status_request_id', 'deleted', 'dim_asrama'], 'integer'],
            [['rencana_berangkat', 'rencana_kembali', 'realisasi_berangkat', 'realisasi_kembali', 'desc', 'tujuan','dim_nama', 'dim_prodi', 'dim_angkatan', 'keasramaan', 'deleted_at', 'deleted_by', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'safe'],
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
        $query = IzinBermalam::find();
        $query->joinWith(['dim', 'dim.dimAsrama.kamar.asrama']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 15,
            ],
            'sort' => ['defaultOrder' => ['status_request_id' => SORT_ASC, 'updated_at' => SORT_DESC, 'created_at' => SORT_DESC]],

        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'izin_bermalam_id' => $this->izin_bermalam_id,
            'rencana_berangkat' => $this->rencana_berangkat,
            'rencana_kembali' => $this->rencana_kembali,
            'realisasi_berangkat' => $this->realisasi_berangkat,
            'realisasi_kembali' => $this->realisasi_kembali,
            'dim_id' => $this->dim_id,
            'keasramaan_id' => $this->keasramaan_id,
            'status_request_id' => $this->status_request_id,
            'askm_asrama.asrama_id' => $this->dim_asrama,
            'deleted' => $this->deleted,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'tujuan', $this->tujuan])
            ->andFilterWhere(['like', 'deleted_by', $this->deleted_by])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by])
            ->andFilterWhere(['like', 'dimx_dim.nama', $this->dim_nama])
            ->andFilterWhere(['like', 'dimx_dim.thn_masuk', $this->dim_angkatan])
            ->andFilterWhere(['like', 'dimx_dim.ref_kbk_id', $this->dim_prodi])
            ->andFilterWhere(['like', 'dimx_dim.status_akhir', 'Aktif'])
            ->andFilterWhere(['not', ['askm_izin_bermalam.deleted' => 1]]);

        return $dataProvider;
    }

    public function searchByMahasiswa($params)
    {
        $query = IzinBermalam::find();
        $query->joinWith(['dim', 'dim.dimAsrama.kamar.asrama']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 15,
            ],
            'sort' => ['defaultOrder' => ['status_request_id' => SORT_ASC, 'updated_at' => SORT_DESC, 'created_at' => SORT_DESC]],

        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'izin_bermalam_id' => $this->izin_bermalam_id,
            'rencana_berangkat' => $this->rencana_berangkat,
            'rencana_kembali' => $this->rencana_kembali,
            'realisasi_berangkat' => $this->realisasi_berangkat,
            'realisasi_kembali' => $this->realisasi_kembali,
            'dimx_dim.user_id' => Yii::$app->user->identity->user_id,
            'keasramaan_id' => $this->keasramaan_id,
            'status_request_id' => $this->status_request_id,
            'askm_asrama.asrama_id' => $this->dim_asrama,
            'deleted' => $this->deleted,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'tujuan', $this->tujuan])
            ->andFilterWhere(['like', 'deleted_by', $this->deleted_by])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by])
            ->andFilterWhere(['like', 'dimx_dim.nama', $this->dim_nama])
            ->andFilterWhere(['like', 'dimx_dim.thn_masuk', $this->dim_angkatan])
            ->andFilterWhere(['like', 'dimx_dim.ref_kbk_id', $this->dim_prodi])
            ->andFilterWhere(['like', 'dimx_dim.status_akhir', 'Aktif'])
            ->andFilterWhere(['not', ['askm_izin_bermalam.deleted' => 1]]);

        return $dataProvider;
    }
}
