<?php

namespace backend\modules\askm\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\askm\models\AskmKeasramaan;

/**
 * AskmKeasramaanSearch represents the model behind the search form about `backend\modules\askm\models\AskmKeasramaan`.
 */
class AskmKeasramaanSearch extends AskmKeasramaan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['keasramaan_id', 'pegawai_id'], 'integer'],
            [['aktif_start', 'aktif_end'], 'safe'],
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
        $query = AskmKeasramaan::find();

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
            'keasramaan_id' => $this->keasramaan_id,
            'aktif_start' => $this->aktif_start,
            'aktif_end' => $this->aktif_end,
            'pegawai_id' => $this->pegawai_id,
        ]);

        return $dataProvider;
    }
}
