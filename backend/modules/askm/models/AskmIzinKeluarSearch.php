<?php

namespace backend\modules\askm\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\askm\models\AskmIzinKeluar;

/**
 * AskmIzinKeluarSearch represents the model behind the search form about `backend\modules\askm\models\AskmIzinKeluar`.
 */
class AskmIzinKeluarSearch extends AskmIzinKeluar
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['izin_keluar_id', 'dim_id', 'dosen_id', 'staf_id', 'status_request_id', 'keasramaan_id'], 'integer'],
            [['rencana_berangkat', 'rencana_kembali', 'realisasi_berangkat', 'realisasi_kembali', 'desc'], 'safe'],
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
        $query = AskmIzinKeluar::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'izin_keluar_id' => $this->izin_keluar_id,
            'rencana_berangkat' => $this->rencana_berangkat,
            'rencana_kembali' => $this->rencana_kembali,
            'realisasi_berangkat' => $this->realisasi_berangkat,
            'realisasi_kembali' => $this->realisasi_kembali,
            'dim_id' => $this->dim_id,
            'dosen_id' => $this->dosen_id,
            'staf_id' => $this->staf_id,
            'status_request_id' => $this->status_request_id,
            'keasramaan_id' => $this->keasramaan_id,
        ]);

        $query->andFilterWhere(['like', 'desc', $this->desc]);

        return $dataProvider;
    }
}
