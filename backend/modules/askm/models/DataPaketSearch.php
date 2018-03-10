<?php

namespace backend\modules\askm\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\askm\models\DataPaket;

/**
 * DataPaketSearch represents the model behind the search form about `backend\modules\askm\models\DataPaket`.
 */
class DataPaketSearch extends DataPaket
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data_paket_id', 'pegawai_id'], 'integer'],
            [['tanggal_kedatangan', 'desc', 'penerima', 'pengirim', 'diambil_oleh', 'tanggal_diambil'], 'safe'],
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
        $query = DataPaket::find();

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
            'data_paket_id' => $this->data_paket_id,
            'tanggal_kedatangan' => $this->tanggal_kedatangan,
            'tanggal_diambil' => $this->tanggal_diambil,
            'pegawai_id' => $this->pegawai_id,
        ]);

        $query->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'penerima', $this->penerima])
            ->andFilterWhere(['like', 'pengirim', $this->pengirim])
            ->andFilterWhere(['like', 'diambil_oleh', $this->diambil_oleh]);

        return $dataProvider;
    }
}
