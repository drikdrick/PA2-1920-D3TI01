<?php

namespace backend\modules\askm\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\askm\models\DimPelanggaran;
use backend\modules\askm\models\DimKamar;

/**
 * DimPelanggaranSearch represents the model behind the search form about `backend\modules\askm\models\DimPelanggaran`.
 */
class PelanggaranBrowseSearch extends DimPelanggaran
{
    public $pelanggaran_name;
    public $dim_name;
    public $pelanggaran_poin;
    public $pembinaan;
    public $tanggal_awal;
    public $tanggal_akhir;
    public $asrama_id;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tanggal_awal','tanggal_akhir'], 'cekTanggal'],
            [['tanggal_akhir'], 'cekTanggalAkhir'],
            [['pelanggaran_id', 'status_pelanggaran', 'pembinaan_id', 'penilaian_id', 'poin_id', 'deleted'], 'integer'],
            [['pembinaan', 'pelanggaran_poin', 'pelanggaran_name', 'dim_name','desc_pembinaan', 'desc_pelanggaran', 'tanggal', 'deleted_at', 'deleted_by', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'safe'],
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

    public function cekTanggalAkhir($attribute, $params)
    {
        if(strtotime($this->tanggal_akhir)<=strtotime($this->tanggal_awal)){
            $this->addError($attribute, 'Tidak boleh lebih awal atau sama dengan tanggal awal !');
        }
    }

    public function cekTanggal($attribute, $params)
    {
        if($this->tanggal_awal!="" && $this->tanggal_akhir == ""){
            $this->addError($attribute, 'Tanggal harus diisi !');
        }
        if($this->tanggal_awal=="" && $this->tanggal_akhir!=""){
            $this->addError($attribute, 'Tanggal harus diisi !');
        }
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($tanggal_awal=null,$tanggal_akhir=null,$asrama_id=null,$params)
    {
        if($tanggal_awal!=null || $tanggal_akhir!=null || $asrama_id!=null){
            $this->tanggal_awal = $tanggal_awal;
            $this->tanggal_akhir = $tanggal_akhir;
            $this->asrama_id = $asrama_id;
        }

        $query = DimPelanggaran::find();
        $query->joinWith(['pembinaan', 'poin','penilaian','penilaian.dim','penilaian.dim.dimAsrama']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['pelanggaran_name'] = [
            'asc' => ['askm_poin_pelanggaran.name' => SORT_ASC],
            'desc' => ['askm_poin_pelanggaran.name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['pelanggaran_poin'] = [
            'asc' => ['askm_poin_pelanggaran.poin' => SORT_ASC],
            'desc' => ['askm_poin_pelanggaran.poin' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['pembinaan'] = [
            'asc' => ['askm_pembinaan.name' => SORT_ASC],
            'desc' => ['askm_poin_pelanggaran.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'pelanggaran_id' => $this->pelanggaran_id,
            'status_pelanggaran' => $this->status_pelanggaran,
            'askm_pembinaan.pembinaan_id' => $this->pembinaan_id,
            'penilaian_id' => $this->penilaian_id,
            'askm_poin_pelanggaran.poin_id' => $this->poin_id,
            'askm_poin_pelanggaran.poin' => $this->pelanggaran_poin,
            'tanggal' => $this->tanggal,
            'deleted' => $this->deleted,
            'deleted_at' => $this->deleted_at,
            'askm_dim_pelanggaran.created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'deleted_by', $this->deleted_by])
            ->andFilterWhere(['like', 'askm_poin_pelanggaran.name', $this->pelanggaran_name])
            ->andFilterWhere(['like', 'dimx_dim.nama', $this->dim_name])
            ->andFilterWhere(['like', 'pembinaan', $this->pembinaan])
            ->andFilterWhere(['like', 'desc_pembinaan', $this->desc_pembinaan])
            ->andFilterWhere(['like', 'desc_pelanggaran', $this->desc_pelanggaran])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by])
            ->andFilterWhere(['not', ['askm_poin_pelanggaran.deleted' => 1]]);

        if($this->tanggal_awal && $this->tanggal_akhir){
            $query->andFilterWhere(['and',
                ['>=','askm_dim_pelanggaran.tanggal',$this->tanggal_awal],
                ['<=','askm_dim_pelanggaran.tanggal',$this->tanggal_akhir]
            ]);
        } 

        if ($this->asrama_id){
            $asrama = (int)$this->asrama_id;
            $dim_arr = DimKamar::find()->select(['askm_dim_kamar.dim_id'])->where('askm_dim_kamar.deleted!=1')->joinWith(['kamar' => function($query) use($asrama){
                $query->where(['askm_kamar.asrama_id' => $asrama]);
            }]);
            $query->andFilterWhere(['in', 'askm_dim_penilaian.dim_id', $dim_arr]);
        }

        return $dataProvider;
    }
}
