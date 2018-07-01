<?php

namespace backend\modules\baak\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\baak\models\KartuTandaMahasiswa;

/**
 * KtmSearch represents the model behind the search form about `backend\modules\baak\models\Ktm`.
 */
class KartuTandaMahasiswaSearch extends KartuTandaMahasiswa
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kartu_tanda_mahasiswa_id', 'pemohon_id', 'deleted'], 'integer'],
            [['alasan', 'status_pengajuan_id', 'dim_id', 'deleted_at', 'deleted_by', 'created_at', 'created_by', 'updated_at', 'updated_by', 'waktu_pengambilan'], 'safe'],
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
        $query = KartuTandaMahasiswa::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['status_pengajuan_id' => SORT_ASC, 'updated_at' => SORT_DESC, 'created_at' => SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('statusPengajuan');
        $query->joinWith('dim');

        $query->andFilterWhere([
            'kartu_tanda_mahasiswa_id' => $this->kartu_tanda_mahasiswa_id,
            'pemohon_id' => $this->pemohon_id,
            'deleted' => $this->deleted,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            // 'dimx_dim_dim_id' => $this->dimx_dim_dim_id,
            // 'hrdx_pegawai_pegawai_id' => $this->hrdx_pegawai_pegawai_id,
            //'status' => $this->status,
            'waktu_pengambilan' => $this->waktu_pengambilan,
        ]);

        $query->andFilterWhere(['like', 'alasan', $this->alasan])
            ->andFilterWhere(['like', 'deleted_by', $this->deleted_by])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by])
            ->andFilterWhere(['like', 'baak_r_status_pengajuan.name', $this->status_pengajuan_id])
            ->andFilterWhere(['like', 'dimx_dim.nama', $this->dim_id])
            ->andFilterWhere(['not', ['baak_kartu_tanda_mahasiswa.deleted' => 1]]);

        return $dataProvider;
    }
}
