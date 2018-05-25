<?php

namespace backend\modules\askm\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\askm\models\DimKamar;

/**
 * DimKamarSearch represents the model behind the search form about `backend\modules\askm\models\DimKamar`.
 */
class DimKamarSearch extends DimKamar
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dim_kamar_id', 'status_dim_kamar', 'dim_id', 'kamar_id', 'deleted'], 'integer'],
            [['deleted_at', 'deleted_by', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'safe'],
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
        $query = DimKamar::find();
        $query->joinWith(['dim']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => ['defaultOrder' => ['updated_at' => SORT_DESC, 'created_at' => SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'dim_kamar_id' => $this->dim_kamar_id,
            'status_dim_kamar' => $this->status_dim_kamar,
            'dim_id' => $this->dim_id,
            'kamar_id' => $this->kamar_id,
            'deleted' => $this->deleted,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'deleted_by', $this->deleted_by])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by])
            ->andFilterWhere(['like', 'dimx_dim.status_akhir', 'Aktif'])
            ->andFilterWhere(['not', ['askm_dim_kamar.deleted' => 1]]);

        return $dataProvider;
    }
}
