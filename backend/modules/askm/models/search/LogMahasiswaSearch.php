<?php

namespace backend\modules\askm\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\askm\models\LogMahasiswa;

/**
 * LogMahasiswaSearch represents the model behind the search form about `backend\modules\askm\models\LogMahasiswa`.
 */
class LogMahasiswaSearch extends LogMahasiswa
{
    public $dim_nama;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['log_mahasiswa_id', 'dim_id', 'deleted'], 'integer'],
            [['tanggal_keluar', 'tanggal_masuk', 'deleted_at', 'deleted_by', 'created_at', 'created_by', 'updated_at', 'updated_by', 'dim_nama'], 'safe'],
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
        $query = LogMahasiswa::find();
        $query->joinWith(['dim']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['updated_at' => SORT_DESC, 'created_at' => SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'log_mahasiswa_id' => $this->log_mahasiswa_id,
            'dim_id' => $this->dim_id,
            'tanggal_keluar' => $this->tanggal_keluar,
            'tanggal_masuk' => $this->tanggal_masuk,
            'deleted' => $this->deleted,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'deleted_by', $this->deleted_by])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by])
            ->andFilterWhere(['like', 'dimx_dim.nama', $this->dim_nama])
            ->andFilterWhere(['like', 'dimx_dim.status_akhir', 'Aktif'])
            ->andFilterWhere(['not', ['askm_log_mahasiswa.deleted' => 1]]);

        return $dataProvider;
    }
}
