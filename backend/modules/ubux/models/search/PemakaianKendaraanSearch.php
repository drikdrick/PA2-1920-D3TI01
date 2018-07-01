<?php

namespace backend\modules\ubux\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\ubux\models\PemakaianKendaraan;

/**
 * PemakaianKendaraanSearch represents the model behind the search form about `backend\modules\ubux\models\PemakaianKendaraan`.
 */
class PemakaianKendaraanSearch extends PemakaianKendaraan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pemakaian_kendaraan_id', 'jumlah_penumpang_kendaraan', 'deleted', 'kendaraan_id', 'supir_id', 'jenis_keperluan_id', 'pegawai_id'], 'integer'],
            [['jenis_keperluan_id', 'rencana_waktu_keberangkatan', 'rencana_waktu_kembali', 'status_req_sekretaris_rektorat', 'status_request_kemahasiswaan', 'proposal', 'no_telepon', 'deleted_at', 'deleted_by', 'created_at', 'created_by', 'updated_at', 'updated_by', 'no_hp_supir', 'status_request_kabiro_KSD', 'status_request_hrd', 'status_request_keuangan', 'status_request_wr2'], 'safe'],
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
        $query = PemakaianKendaraan::find()->where(['deleted' => 0]);

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
            'pemakaian_kendaraan_id' => $this->pemakaian_kendaraan_id,
            'pegawai_id' => $this->pegawai_id,
            'jumlah_penumpang_kendaraan' => $this->jumlah_penumpang_kendaraan,
            'rencana_waktu_keberangkatan' => $this->rencana_waktu_keberangkatan,
            'rencana_waktu_kembali' => $this->rencana_waktu_kembali,
            'deleted' => $this->deleted,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'kendaraan_id' => $this->kendaraan_id,
            'supir_id' => $this->supir_id,
        ]);

        $query->andFilterWhere(['like', 'jenis_keperluan_id', $this->jenis_keperluan_id])
            ->andFilterWhere(['like', 'pegawai_id', $this->pegawai_id])
            ->andFilterWhere(['like', 'status_req_sekretaris_rektorat', $this->status_req_sekretaris_rektorat])
            ->andFilterWhere(['like', 'status_request_kemahasiswaan', $this->status_request_kemahasiswaan])
            ->andFilterWhere(['like', 'jenis_keperluan_id', $this->jenis_keperluan_id])
            ->andFilterWhere(['like', 'proposal', $this->proposal])
            ->andFilterWhere(['like', 'no_telepon', $this->no_telepon])
            ->andFilterWhere(['like', 'deleted_by', $this->deleted_by])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by])
            ->andFilterWhere(['like', 'no_hp_supir', $this->no_hp_supir])
            ->andFilterWhere(['like', 'status_request_kabiro_KSD', $this->status_request_kabiro_KSD])
            ->andFilterWhere(['like', 'status_request_hrd', $this->status_request_hrd])
            ->andFilterWhere(['like', 'status_request_keuangan', $this->status_request_keuangan])
            ->andFilterWhere(['like', 'status_request_wr2', $this->status_request_wr2]);

        $query->andFilterWhere(['not', ['deleted' => 1]]);

        return $dataProvider;
    }
}
