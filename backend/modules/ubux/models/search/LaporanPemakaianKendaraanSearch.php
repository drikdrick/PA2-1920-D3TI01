<?php

namespace backend\modules\ubux\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\ubux\models\LaporanPemakaianKendaraan;

/**
 * LaporanPemakaianKendaraanSearch represents the model behind the search form about `backend\modules\ubux\models\LaporanPemakaianKendaraan`.
 */
class LaporanPemakaianKendaraanSearch extends LaporanPemakaianKendaraan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['laporan_pemakaian_kendaraan_id', 'jumlah_penumpang', 'deleted', 'kendaraan_id', 'supir_id'], 'integer'],
            [['tujuan', 'desc', 'keperluan', 'waktu_keberangkatan', 'waktu_tiba', 'deleted_at', 'deleted_by', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'safe'],
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
        $query = LaporanPemakaianKendaraan::find()->where(['deleted' => 0]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['updated_at' => SORT_DESC, 'created_at' => SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'laporan_pemakaian_kendaraan_id' => $this->laporan_pemakaian_kendaraan_id,
            'jumlah_penumpang' => $this->jumlah_penumpang,
            'waktu_keberangkatan' => $this->waktu_keberangkatan,
            'waktu_tiba' => $this->waktu_tiba,
            'deleted' => $this->deleted,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'kendaraan_id' => $this->kendaraan_id,
            'supir_id' => $this->supir_id,
        ]);

        $query->andFilterWhere(['like', 'tujuan', $this->tujuan])
            ->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'keperluan', $this->keperluan])
            ->andFilterWhere(['like', 'deleted_by', $this->deleted_by])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by]);

        $query->andFilterWhere(['not', ['deleted' => 1]]);

        return $dataProvider;
    }
}
