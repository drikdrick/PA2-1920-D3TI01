<?php

namespace backend\modules\baak\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\baak\models\SuratMahasiswaAktif;

/**
 * SuratMahasiswaAktifSearch represents the model behind the search form about `backend\modules\baak\models\SuratMahasiswaAktif`.
 */
class SuratMahasiswaAktifSearch extends SuratMahasiswaAktif
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['surat_mahasiswa_aktif_id', 'deleted', 'pegawai_id'], 'integer'],
            [['nomor_surat', 'pemohon_id', 'status_pengajuan_id', 'tujuan', 'tanggal_surat', 'deleted_at', 'deleted_by', 'created_at', 'created_by', 'updated_at', 'updated_by', 'waktu_pengambilan'], 'safe'],
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
        $query = SuratMahasiswaAktif::find();

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

        //$query->joinWith('statusPengajuan');        
        $query->joinWith('pemohon');

        $query->andFilterWhere([
            'surat_mahasiswa_aktif_id' => $this->surat_mahasiswa_aktif_id,
            'tanggal_surat' => $this->tanggal_surat,
            //'pengaju' => $this->pengaju,
            'deleted' => $this->deleted,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'pegawai_id' => $this->pegawai_id,
            'status_pengajuan_id' => $this->status_pengajuan_id,
            'waktu_pengambilan' => $this->waktu_pengambilan,
        ]);

        $query->andFilterWhere(['like', 'nomor_surat', $this->nomor_surat])
            ->andFilterWhere(['like', 'tujuan', $this->tujuan])
            ->andFilterWhere(['like', 'deleted_by', $this->deleted_by])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by])
            //->andFilterWhere(['like', 'baak_r_status_pengajuan.name', $this->status_pengajuan_id])
            ->andFilterWhere(['like', 'dimx_dim.nama', $this->pemohon_id])
            ->andFilterWhere(['not', ['baak_surat_mahasiswa_aktif.deleted' => 1]]);

        return $dataProvider;
    }
}
