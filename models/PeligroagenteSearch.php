<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PeligroAgente;

/**
 * PeligroagenteSearch represents the model behind the search form of `app\models\PeligroAgente`.
 */
class PeligroagenteSearch extends PeligroAgente
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pel_agen', 'id_sub2_clas_pel', 'id_sub_cla_pel', 'id_cla_pel', 'id_peligro', 'id_estatus'], 'integer'],
            [['descripcion', 'codigo', 'created_at', 'updated_at'], 'safe'],
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
    //Query para buscar el estatus (activo, inactivo, etc).
    //Parametros: $data:$searchModel /  $id: id_estatus
    public function buscarEstatus($data, $id){
        $modelbuscar = Estatus::findOne($data->id_estatus);
        $content = $modelbuscar->descripcion;
        return $content;
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
        $query = PeligroAgente::find();

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
            'id_pel_agen' => $this->id_pel_agen,
            'id_sub2_clas_pel' => $this->id_sub2_clas_pel,
            'id_sub_cla_pel' => $this->id_sub_cla_pel,
            'id_cla_pel' => $this->id_cla_pel,
            'id_peligro' => $this->id_peligro,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'id_estatus' => $this->id_estatus,
        ]);

        $query->andFilterWhere(['ilike', 'descripcion', $this->descripcion])
            ->andFilterWhere(['ilike', 'codigo', $this->codigo]);

        return $dataProvider;
    }
}
