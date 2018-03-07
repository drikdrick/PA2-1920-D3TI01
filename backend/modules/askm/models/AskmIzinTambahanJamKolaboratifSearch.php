<?php

namespace backend\modules\askm\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\askm\models\AskmIzinTambahanJamKolaboratif;

/**
 * AskmIzinTambahanJamKolaboratifSearch represents the model behind the search form about `backend\modules\askm\models\AskmIzinTambahanJamKolaboratif`.
 */
class AskmIzinTambahanJamKolaboratifSearch extends AskmIzinTambahanJamKolaboratif
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['izin_tambahan_jam_kolaboratif_id', 'dim_id', 'status_request_id', 'staf_id'], 'integer'],
            [['rencana_mulai', 'rencana_berakhir', 'decs'], 'safe'],
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
        $query = AskmIzinTambahanJamKolaboratif::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'izin_tambahan_jam_kolaboratif_id' => $this->izin_tambahan_jam_kolaboratif_id,
            'rencana_mulai' => $this->rencana_mulai,
            'rencana_berakhir' => $this->rencana_berakhir,
            'dim_id' => $this->dim_id,
            'status_request_id' => $this->status_request_id,
            'staf_id' => $this->staf_id,
        ]);

        $query->andFilterWhere(['like', 'decs', $this->decs]);

        return $dataProvider;
    }
}
