<?php

namespace backend\modules\askm\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\askm\models\IzinRuangan;

/**
 * IzinRuanganSearch represents the model behind the search form about `backend\modules\askm\models\IzinRuangan`.
 */
class IzinRuanganSearch extends IzinRuangan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['izin_ruangan_id', 'dim_id', 'baak_id', 'lokasi_id', 'status_request_id', 'deleted'], 'integer'],
            [['rencana_mulai', 'rencana_berakhir', 'desc', 'deleted_at', 'deleted_by', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'safe'],
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
        $query = IzinRuangan::find();
        $query->joinWith(['dim']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 15,
            ],
            'sort' => ['defaultOrder' => ['status_request_id' => SORT_ASC, 'updated_at' => SORT_DESC, 'created_at' => SORT_DESC]],

        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'izin_ruangan_id' => $this->izin_ruangan_id,
            'rencana_mulai' => $this->rencana_mulai,
            'rencana_berakhir' => $this->rencana_berakhir,
            'dim_id' => $this->dim_id,
            'baak_id' => $this->baak_id,
            'lokasi_id' => $this->lokasi_id,
            'status_request_id' => $this->status_request_id,
            'deleted' => $this->deleted,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'deleted_by', $this->deleted_by])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by])
            ->andFilterWhere(['like', 'dimx_dim.status_akhir', 'Aktif'])
            ->andFilterWhere(['not', ['askm_izin_ruangan.deleted' => 1]]);

        return $dataProvider;
    }

    public function searchByMahasiswa($params)
    {
        $query = IzinRuangan::find();
        $query->joinWith(['dim']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 15,
            ],
            'sort' => ['defaultOrder' => ['status_request_id' => SORT_ASC, 'updated_at' => SORT_DESC, 'created_at' => SORT_DESC]],

        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'izin_ruangan_id' => $this->izin_ruangan_id,
            'rencana_mulai' => $this->rencana_mulai,
            'rencana_berakhir' => $this->rencana_berakhir,
            'dimx_dim.user_id' => Yii::$app->user->identity->user_id,
            'baak_id' => $this->baak_id,
            'lokasi_id' => $this->lokasi_id,
            'status_request_id' => $this->status_request_id,
            'deleted' => $this->deleted,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'deleted_by', $this->deleted_by])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by])
            ->andFilterWhere(['like', 'dimx_dim.status_akhir', 'Aktif'])
            ->andFilterWhere(['not', ['askm_izin_ruangan.deleted' => 1]]);

        return $dataProvider;
    }
}
