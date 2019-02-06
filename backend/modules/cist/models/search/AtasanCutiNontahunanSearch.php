<?php

namespace backend\modules\cist\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\cist\models\AtasanCutiNontahunan;

/**
 * AtasanCutiNontahunanSearch represents the model behind the search form about `backend\modules\cist\models\AtasanCutiNontahunan`.
 */
class AtasanCutiNontahunanSearch extends AtasanCutiNontahunan
{
    public $lama_cuti;
    public $pegawai_nama;
    public $tgl_mulai;
    public $tgl_akhir;
    public $alasan_cuti;
    public $pengalihan_tugas;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['atasan_cuti_nontahunan_id', 'lama_cuti', 'permohonan_cuti_nontahunan_id', 'pegawai_id', 'deleted'], 'integer'],
            [['pegawai_nama', 'tgl_mulai', 'tgl_akhir', 'alasan_cuti', 'pengalihan_tugas', 'name', 'deleted_at', 'deleted_by', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'safe'],
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
        $query = AtasanCutiNontahunan::find();
        $query->joinWith('pmhnnCutiNthn.pegawai', 'pmhnnCutiNthn');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['updated_at' => SORT_DESC, 'created_at' => SORT_DESC]],
        ]);

        $dataProvider->sort->attributes['pegawai_nama'] = [
            'asc' => ['hrdx_pegawai.nama' => SORT_ASC],
            'desc' => ['hrdx_pegawai.nama' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['lama_cuti'] = [
            'asc' => ['cist_permohonan_cuti_nontahunan.lama_cuti' => SORT_ASC],
            'desc' => ['cist_permohonan_cuti_nontahunan.lama_cuti' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['tgl_mulai'] = [
            'asc' => ['cist_permohonan_cuti_nontahunan.tgl_mulai' => SORT_ASC],
            'desc' => ['cist_permohonan_cuti_nontahunan.tgl_mulai' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['tgl_akhir'] = [
            'asc' => ['cist_permohonan_cuti_nontahunan.tgl_akhir' => SORT_ASC],
            'desc' => ['cist_permohonan_cuti_nontahunan.tgl_akhir' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['pengalihan_tugas'] = [
            'asc' => ['cist_permohonan_cuti_nontahunan.pengalihan_tugas' => SORT_ASC],
            'desc' => ['cist_permohonan_cuti_nontahunan.pengalihan_tugas' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['alasan_cuti'] = [
            'asc' => ['cist_permohonan_cuti_nontahunan.alasan_cuti' => SORT_ASC],
            'desc' => ['cist_permohonan_cuti_nontahunan.alasan_cuti' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'atasan_cuti_nontahunan_id' => $this->atasan_cuti_nontahunan_id,
            'permohonan_cuti_nontahunan_id' => $this->permohonan_cuti_nontahunan_id,
            'cist_atasan_cuti_nontahunan.pegawai_id' => $this->pegawai_id,
            'lama_cuti' => $this->lama_cuti,
            'deleted' => $this->deleted,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'cist_permohonan_cuti_nontahunan.tgl_akhir', $this->tgl_akhir])
            ->andFilterWhere(['like', 'cist_permohonan_cuti_nontahunan.tgl_mulai', $this->tgl_mulai])
            ->andFilterWhere(['like', 'hrdx_pegawai.nama', $this->pegawai_nama])
            ->andFilterWhere(['like', 'cist_permohonan_cuti_nontahunan.alasan_cuti', $this->alasan_cuti])
            ->andFilterWhere(['like', 'cist_permohonan_cuti_nontahunan.pengalihan_tugas', $this->pengalihan_tugas])
            ->andFilterWhere(['like', 'deleted_by', $this->deleted_by])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by])
            ->andFilterWhere(['not', ['cist_permohonan_cuti_nontahunan.deleted' => 1]]);

        return $dataProvider;
    }
}
