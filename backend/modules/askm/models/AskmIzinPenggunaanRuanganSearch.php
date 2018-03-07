<?php

namespace backend\modules\askm\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\askm\models\AskmIzinPenggunaanRuangan;

/**
 * AskmIzinPenggunaanRuanganSearch represents the model behind the search form about `backend\modules\askm\models\AskmIzinPenggunaanRuangan`.
 */
class AskmIzinPenggunaanRuanganSearch extends AskmIzinPenggunaanRuangan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['izin_penggunaan_ruangan_id', 'dim_id', 'staf_id', 'status_request_id'], 'integer'],
            [['rencana_mulai', 'rencana_berakhir', 'desc'], 'safe'],
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
        $query = AskmIzinPenggunaanRuangan::find();

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
            'izin_penggunaan_ruangan_id' => $this->izin_penggunaan_ruangan_id,
            'rencana_mulai' => $this->rencana_mulai,
            'rencana_berakhir' => $this->rencana_berakhir,
            'dim_id' => $this->dim_id,
            'staf_id' => $this->staf_id,
            'status_request_id' => $this->status_request_id,
        ]);

        $query->andFilterWhere(['like', 'desc', $this->desc]);

        return $dataProvider;
    }
}
