<?php

namespace backend\modules\askm\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\askm\models\PoinPelanggaran;

/**
 * PoinPelanggaranSearch represents the model behind the search form about `backend\modules\askm\models\PoinPelanggaran`.
 */
class PoinPelanggaranSearch extends PoinPelanggaran
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['poin_id', 'poin', 'bentuk_id', 'tingkat_id', 'deleted'], 'integer'],
            [['name', 'desc', 'deleted_at', 'deleted_by', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'safe'],
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
        $query = PoinPelanggaran::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'poin_id' => $this->poin_id,
            'poin' => $this->poin,
            'bentuk_id' => $this->bentuk_id,
            'tingkat_id' => $this->tingkat_id,
            'deleted' => $this->deleted,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'deleted_by', $this->deleted_by])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by])
            ->andFilterWhere(['not', ['deleted' => 1]]);

        return $dataProvider;
    }
}
