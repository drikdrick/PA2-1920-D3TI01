<?php

namespace backend\modules\baak\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\baak\models\KaosDel;

/**
 * KaosDelSearch represents the model behind the search form about `backend\modules\baak\models\KaosDel`.
 */
class KaosDelSearch extends KaosDel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kaos_del_id', 'stok', 'pegawai_id', 'deleted'], 'integer'],
            [['ukuran', 'created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at', 'deleted_by'], 'safe'],
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
        $query = KaosDel::find();

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
            'kaos_del_id' => $this->kaos_del_id,
            'stok' => $this->stok,
            'pegawai_id' => $this->pegawai_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted' => $this->deleted,
            'deleted_at' => $this->deleted_at,
        ]);

        $query->andFilterWhere(['like', 'ukuran', $this->ukuran])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by])
            ->andFilterWhere(['like', 'deleted_by', $this->deleted_by]);

        return $dataProvider;
    }
}
