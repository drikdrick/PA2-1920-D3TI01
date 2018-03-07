<?php

namespace backend\modules\askm\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\askm\models\AskmAsrama;

/**
 * AskmAsramaSearch represents the model behind the search form about `backend\modules\askm\models\AskmAsrama`.
 */
class AskmAsramaSearch extends AskmAsrama
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['asrama_id', 'jumlah_mahasiswa', 'kapasitas'], 'integer'],
            [['name', 'lokasi'], 'safe'],
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
        $query = AskmAsrama::find();

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
            'asrama_id' => $this->asrama_id,
            'jumlah_mahasiswa' => $this->jumlah_mahasiswa,
            'kapasitas' => $this->kapasitas,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'lokasi', $this->lokasi]);

        return $dataProvider;
    }
}
