<?php

namespace backend\modules\ubux\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\ubux\models\DataPaket;
use backend\modules\ubux\models\Dim;
use backend\modules\ubux\models\Pegawai;

/**
 * DataPaketSearch represents the model behind the search form about `backend\modules\ubux\models\DataPaket`.
 */
class DataPaketSearch extends DataPaket
{   
    public $dim_nama;
    public $pegawai_nama;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data_paket_id', 'tag', 'dim_id', 'pegawai_id', 'posisi_paket_id', 'status_paket_id', 'deleted'], 'integer'],
            [['dim_nama','pegawai_nama','pengirim', 'tanggal_kedatangan', 'diambil_oleh', 'tanggal_diambil', 'desc', 'deleted_at', 'deleted_by', 'created_by', 'created_at', 'updated_at', 'updated_by'], 'safe'],
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
        $query = DataPaket::find()->andWhere('ubux_data_paket.deleted!=1')
        ->JoinWith('dim',false)->JoinWith('pegawai',false);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>['pageSize'=>10],
            'sort' => ['defaultOrder' => ['data_paket_id' => SORT_DESC, 'updated_at' => SORT_DESC, 'created_at' => SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'data_paket_id' => $this->data_paket_id,
            'tag' => $this->tag,
            'dim_id' => $this->dim_id,
            'pegawai_id' => $this->pegawai_id,
            'tanggal_diambil' => $this->tanggal_diambil,
            'posisi_paket_id' => $this->posisi_paket_id,
            'status_paket_id' => $this->status_paket_id,
            'deleted' => $this->deleted,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'dimx_dim.nama', $this->dim_nama])
            ->andFilterWhere(['like', 'hrdx_pegawai.nama', $this->pegawai_nama])
            ->andFilterWhere(['like', 'pengirim', $this->pengirim])
            ->andFilterWhere(['like', 'diambil_oleh', $this->diambil_oleh])
            ->andFilterWhere(['like', 'tanggal_kedatangan',SUBSTR($this->tanggal_kedatangan,1,10)])
            ->andFilterWhere(['like', 'hrdx_pegawai.nama', $this->pegawai_nama])
            ->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'deleted_by', $this->deleted_by])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by])
            ->andFilterWhere(['not', ['ubux_data_paket.deleted' => 1]]);

        return $dataProvider;
    }



    /**
     * Search Untuk Paket Mahasiswa
     */
    public function searchUserMahasiswa($params){
        $dim = Dim::find('dim_id')->where('deleted!=1')->andWhere(['user_id'=>(Yii::$app->user->identity->user_id)])->one();

        $query = DataPaket::find()->where('deleted!=1')->andWhere(['dim_id'=>$dim])->orWhere(['dim_id'=>NULL])->andWhere(['pegawai_id'=>NULL]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>['pageSize'=>10],
            'sort' => ['defaultOrder' => ['dim_id' => SORT_DESC, 'updated_at' => SORT_DESC, 'created_at' => SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'data_paket_id' => $this->data_paket_id,
            'tag' => $this->tag,
            'dim_id' => $this->dim_id,
            'tanggal_diambil' => $this->tanggal_diambil,
            'posisi_paket_id' => $this->posisi_paket_id,
            'status_paket_id' => $this->status_paket_id,
            'deleted' => $this->deleted,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'pengirim', $this->pengirim])
            ->andFilterWhere(['like', 'diambil_oleh', $this->diambil_oleh])
            ->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'deleted_by', $this->deleted_by])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by])
            ->andFilterWhere(['like', 'tanggal_kedatangan',SUBSTR($this->tanggal_kedatangan,1,10)])
            ->andFilterWhere(['not', ['deleted' => 1]]);

        return $dataProvider;
    }

    /**
     * Search untuk paket Pegawai
     */
    public function searchUserPegawai($params){
        $pegawai = Pegawai::find('pegawai_id')->where('deleted!=1')->andWhere(['user_id'=>(Yii::$app->user->identity->user_id)])->one();

        $query = DataPaket::find()->where('deleted!=1')->andWhere(['pegawai_id'=>$pegawai])->orWhere(['pegawai_id'=>NULL])->andWhere(['dim_id'=>NULL]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>['pageSize'=>10],
            'sort' => ['defaultOrder' => ['pegawai_id' => SORT_DESC, 'updated_at' => SORT_DESC, 'created_at' => SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'data_paket_id' => $this->data_paket_id,
            'tag' => $this->tag,
            'pegawai_id' => $this->pegawai_id,
            'tanggal_diambil' => $this->tanggal_diambil,
            'posisi_paket_id' => $this->posisi_paket_id,
            'status_paket_id' => $this->status_paket_id,
            'deleted' => $this->deleted,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'pengirim', $this->pengirim])
            ->andFilterWhere(['like', 'diambil_oleh', $this->diambil_oleh])
            ->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'deleted_by', $this->deleted_by])
            ->andFilterWhere(['like', 'tanggal_kedatangan',SUBSTR($this->tanggal_kedatangan,1,10)])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by])
            ->andFilterWhere(['not', ['deleted' => 1]]);

        return $dataProvider;
    }
}
