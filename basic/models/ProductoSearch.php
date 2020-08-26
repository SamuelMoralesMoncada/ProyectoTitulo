<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Producto;

/**
 * ProductoSearch represents the model behind the search form of `app\models\Producto`.
 */
class ProductoSearch extends Producto
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['F_IDPROD', 'F_IDMARCA', 'F_IDCAT', 'F_IDUBICA', 'F_IDPROV'], 'integer'],
            [['F_NOMBREPROD', 'F_FECHAREGISTROPRO'], 'safe'],
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
        $query = Producto::find();

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
            'F_IDPROD' => $this->F_IDPROD,
            'F_IDMARCA' => $this->F_IDMARCA,
            'F_IDCAT' => $this->F_IDCAT,
            'F_IDUBICA' => $this->F_IDUBICA,
            'F_IDPROV' => $this->F_IDPROV,
            'F_FECHAREGISTROPRO' => $this->F_FECHAREGISTROPRO,
        ]);

        $query->andFilterWhere(['like', 'F_NOMBREPROD', $this->F_NOMBREPROD]);

        return $dataProvider;
    }
}
