<?php

namespace backend\modules\askm\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\askm\models\Paket;
use backend\modules\askm\models\Dim;
/**
 * PaketSearch represents the model behind the search form about `backend\modules\askm\models\Paket`.
 */
class PaketSearch extends Paket
{
    public $mahasiswa;
    public $pegawai;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data_paket_id', 'tag', 'penerima', 'posisi', 'status', 'deleted'], 'integer'],
            [['pengirim', 'tanggal_kedatangan','mahasiswa','pegawai', 'diambil_oleh', 'tanggal_diambil', 'desc', 'deleted_at', 'deleted_by', 'created_by', 'created_at', 'updated_at', 'updated_by'], 'safe'],
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
        $query = Paket::find()->where(['ubux_data_paket.deleted'=>0])->orderBy(['status'=>SORT_ASC])
        ->JoinWith('mahasiswa',false)->JoinWith('pegawai',false);
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
            'tag' => $this->tag,
            'penerima' => $this->penerima,
            'tanggal_kedatangan' => $this->tanggal_kedatangan,
            'tanggal_diambil' => $this->tanggal_diambil,
            'posisi' => $this->posisi,
            'status' => $this->status,
            'deleted' => $this->deleted,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'pengirim', $this->pengirim])
            ->andFilterWhere(['like','dimx_dim.nama',$this->mahasiswa])
            ->andFilterWhere(['like','hrdx_pegawai.nama',$this->pegawai])
            ->andFilterWhere(['like', 'diambil_oleh', $this->diambil_oleh])
            ->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'deleted_by', $this->deleted_by])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }


    public function searchUser($params)
    {
        $query = Paket::find()->where(['deleted'=>0])->andWhere(['penerima'=>(Yii::$app->user->identity->user_id)])->orWhere(['penerima'=>NULL])->orderBy(['penerima'=>SORT_DESC]);

        $userProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>['pageSize'=>10],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $userProvider;
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

        return $userProvider;
    }
}
