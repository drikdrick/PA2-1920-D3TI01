<?php

namespace backend\modules\askm\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\askm\models\AskmRuangan;

/**
 * AskmRuanganSearch represents the model behind the search form about `backend\modules\askm\models\AskmRuangan`.
 */
class AskmRuanganSearch extends AskmRuangan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ruangan_id', 'izin_tambahan_jam_kolaboratif_id'], 'integer'],
            [['name'], 'safe'],
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
        $query = AskmRuangan::find();

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
            'ruangan_id' => $this->ruangan_id,
            'izin_tambahan_jam_kolaboratif_id' => $this->izin_tambahan_jam_kolaboratif_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
