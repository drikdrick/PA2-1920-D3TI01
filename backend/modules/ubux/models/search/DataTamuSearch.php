<?php

namespace backend\modules\ubux\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\ubux\models\DataTamu;

/**
 * DataTamuSearch represents the model behind the search form about `backend\modules\askm\models\DataTamu`.
 */
class DataTamuSearch extends DataTamu
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data_tamu_id', 'deleted'], 'integer'],
            [['nik', 'nama', 'waktu_kedatangan', 'desc', 'waktu_kembali', 'deleted_at', 'deleted_by', 'created_by', 'created_at', 'updated_at', 'updated_by'], 'safe'],
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
        $query = DataTamu::find()->andWhere('deleted!=1');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['data_tamu_id' => SORT_ASC, 'updated_at' => SORT_DESC, 'created_at' => SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'data_tamu_id' => $this->data_tamu_id,
            'waktu_kedatangan' => $this->waktu_kedatangan,
            'waktu_kembali' => $this->waktu_kembali,
            'deleted' => $this->deleted,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'nik', $this->nik])
            ->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'deleted_by', $this->deleted_by])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by])
            ->andFilterWhere(['not', ['deleted' => 1]]);

        return $dataProvider;
    }
}
