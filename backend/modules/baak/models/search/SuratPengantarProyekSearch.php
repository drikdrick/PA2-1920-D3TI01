<?php

namespace backend\modules\baak\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\baak\models\SuratPengantarProyek;

/**
 * SuratPengantarProyekSearch represents the model behind the search form about `backend\modules\baak\models\SuratPengantarProyek`.
 */
class SuratPengantarProyekSearch extends SuratPengantarProyek
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['surat_pengantar_proyek_id', 'nomor_surat', 'kuliah_id', 'pemohon_id', 'pegawai_id', 'deleted'], 'integer'],
            [['nomor_surat_lengkap', 'status_pengajuan_id', 'perihal_surat', 'alamat_tujuan', 'banyak_lampiran', 'salam_pembuka', 'tanggal_surat', 'waktu_pengambilan', 'created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at', 'deleted_by'], 'safe'],
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
        $query = SuratPengantarProyek::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['status_pengajuan_id' => SORT_ASC, 'nomor_surat' => SORT_DESC, 'updated_at' => SORT_DESC, 'created_at' => SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('statusPengajuan');

        $query->andFilterWhere([
            'surat_pengantar_proyek_id' => $this->surat_pengantar_proyek_id,
            'nomor_surat' => $this->nomor_surat,
            'kuliah_id' => $this->kuliah_id,
            'tanggal_surat' => $this->tanggal_surat,
            'pemohon_id' => $this->pemohon_id,
            'pegawai_id' => $this->pegawai_id,
            // 'status_pengajuan_id' => $this->status_pengajuan_id,
            'waktu_pengambilan' => $this->waktu_pengambilan,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted' => $this->deleted,
            'deleted_at' => $this->deleted_at,
        ]);

        $query->andFilterWhere(['like', 'nomor_surat_lengkap', $this->nomor_surat_lengkap])
            ->andFilterWhere(['like', 'perihal_surat', $this->perihal_surat])
            ->andFilterWhere(['like', 'alamat_tujuan', $this->alamat_tujuan])
            ->andFilterWhere(['like', 'banyak_lampiran', $this->banyak_lampiran])
            ->andFilterWhere(['like', 'salam_pembuka', $this->salam_pembuka])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by])
            ->andFilterWhere(['like', 'deleted_by', $this->deleted_by])
            ->andFilterWhere(['like', 'baak_r_status_pengajuan.name', $this->status_pengajuan_id])
            ->andFilterWhere(['not', ['baak_surat_pengantar_proyek.deleted' => 1]]);

        return $dataProvider;
    }
}
