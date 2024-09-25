<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AfectacionBienesProcesos;

/**
 * AfectacionbienesprocesosSearch represents the model behind the search form of `app\models\AfectacionBienesProcesos`.
 */
class AfectacionbienesprocesosSearch extends AfectacionBienesProcesos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_afec_bien_pro', 'id_estatus'], 'integer'],
            [['afectacion', 'valor', 'created_at', 'updated_at'], 'safe'],
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
        $query = AfectacionBienesProcesos::find();

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
            'id_afec_bien_pro' => $this->id_afec_bien_pro,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'id_estatus' => $this->id_estatus,
        ]);

        $query->andFilterWhere(['ilike', 'afectacion', $this->afectacion])
            ->andFilterWhere(['ilike', 'valor', $this->valor]);

        return $dataProvider;
    }
}
