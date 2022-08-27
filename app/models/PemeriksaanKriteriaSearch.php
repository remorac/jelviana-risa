<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PemeriksaanKriteria;

/**
 * PemeriksaanKriteriaSearch represents the model behind the search form of `app\models\PemeriksaanKriteria`.
 */
class PemeriksaanKriteriaSearch extends PemeriksaanKriteria
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'pemeriksaan_id', 'kriteria_id', 'subkriteria_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = PemeriksaanKriteria::find();

        // add conditions that should always apply here
        $query->joinWith(['kriteria']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => false,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'pemeriksaan_id' => $this->pemeriksaan_id,
            'kriteria_id' => $this->kriteria_id,
            'subkriteria_id' => $this->subkriteria_id,
        ]);

        $query->orderBy('kriteria.jenis ASC, kriteria.nama ASC');

        return $dataProvider;
    }
}
