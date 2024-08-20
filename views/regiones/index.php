<?php

use app\models\Regiones;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\RegionesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Regiones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="regiones-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear Regiones', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
            'header' => 'Nº'],

            //'id_regiones',
            
            //'descripcion',
            [   
                'attribute' => 'descripcion',
                'label' => 'Descripcion',
                'filterInputOptions' => [
                    'class' => 'form-control',
                    'placeholder' => 'Busqueda',
                ]
            ],
            //'id_estatus',
            

            //Esto es Para que muestre el estatus en vez del id almacenado en la tabla regiones
            [   
                'attribute' => 'id_estatus',
                'label' => 'Estatus',
                'filterInputOptions' => [
                    'class' => 'form-control',
                    'placeholder' => 'Busqueda',
                ],
                
                'value' => function($model){
                    return   $model->estatus->descripcion;},
            ],
            //'created_at',
           // 'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Regiones $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_regiones' => $model->id_regiones]);
                 }
            ],
        ],
    ]); ?>


</div>
