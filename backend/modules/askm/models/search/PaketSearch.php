<?php

namespace backend\modules\askm\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\askm\models\Paket;

/**
 * PaketSearch represents the model behind the search form about `backend\modules\askm\models\Paket`.
 */
class PaketSearch extends Paket
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data_paket_id', 'deleted'], 'integer'],
            [['penerima', 'pengirim', 'tanggal_kedatangan', 'diambil_oleh', 'tanggal_diambil', 'posisi', 'desc', 'deleted_at', 'deleted_by', 'created_at', 'updated_at', 'updated_by'], 'safe'],
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
        $query = Paket::find()->where(['deleted'=>0])->orderBy(['tanggal_diambil'=>SORT_ASC,'tanggal_kedatangan'=>SORT_DESC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>['pageSize'=>10],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'data_paket_id' => $this->data_paket_id,
            'tanggal_diambil' => $this->tanggal_diambil,
            'deleted' => $this->deleted,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'penerima', $this->penerima])
            ->andFilterWhere(['like', 'pengirim', $this->pengirim])
            ->andFilterWhere(['like', 'tanggal_kedatangan',SUBSTR($this->tanggal_kedatangan,1,10)])
            ->andFilterWhere(['like', 'diambil_oleh', $this->diambil_oleh])
            ->andFilterWhere(['like', 'posisi', $this->posisi])
            ->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'deleted_by', $this->deleted_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }
}
