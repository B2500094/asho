<?php

use app\models\ClasificacionAccidente;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Estatus;

/** @var yii\web\View $this */
/** @var app\models\ClasificacionaccidenteSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Clasificacion de Accidente';
?>
<div class="clasificacion-accidente-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <!-- <p>
        <?= Html::a('Crear Clasificacion de Accidente', ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pager' => [
            'options' => ['class'=> 'pagination'],
            'firstPageCssClass' => 'page-item',
            'lastPageCssClass' => 'page-item', 
            'nextPageCssClass' => 'page-item',
            'prevPageCssClass' => 'page-item',
            'pageCssClass' => 'page-item',
            'disabledPageCssClass' => 'disabled d-none',
            'linkOptions' => ['style' => 'text-decoration: none;', 'class' => 'page-link'],
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
            'header' => 'Nº', //Para que no aparezca el # sino la letra que se requiera],
            'contentOptions' => ['style' => 'text-align: center; vertical-align: middle;'], // Cambia el tamaño de la columna
            ], 

            //'id_clasif_accid_lab_ope_amb',
           // 'descripcion',
            [   
                'attribute' => 'descripcion',
                'label' => 'Descripcion',
                'filterInputOptions' => [
                    'class' => 'form-control',
                    'placeholder' => 'Busqueda',
                ],
                
                
            ],

           // 'codigo',
            [   
                'attribute' => 'codigo',
                'label' => 'Codigo',
                'filterInputOptions' => [
                    'class' => 'form-control',
                    'placeholder' => 'Busqueda',
                ],
                
                
            ],

            //Esto es Para que muestre el estatus en vez del id almacenado en la tabla regiones
            [   
                'attribute' => 'id_estatus',
                'value' => array($searchModel, 'buscarEstatus'),
                'filter' => 
                Html::activeDropDownList($searchModel, 'id_estatus',
                ArrayHelper::map(Estatus::find()
                ->where(['in', 'descripcion', ['ACTIVO', 'INACTIVO']])
                ->all(),
                'id_estatus',
                'descripcion'),
                ['prompt'=> 'Busqueda', 'class' => 'form-control']),
                'headerOptions' => ['class' => 'col-lg-03 text-center'],
                'contentOptions' => ['class' => 'col-lg-03 text-center'],
            ],



            //'created_at',
            //'updated_at',
            
            [
                'class' => ActionColumn::className(),
                //'hiddenFromExport' => true,
                'contentOptions' => ['class'=>'text-center align-middle', 'style'=>'min-width:110px;'],
                'template' => '{toggle-status}',
                'buttons' => [                  
                    'toggle-status' => function ($url, $model, $key) {
                        if ($model->id_estatus == 1) {
                            $url = ['toggle-status', 'id_clasif_accid_lab_ope_amb' => $model->id_clasif_accid_lab_ope_amb];
                            $icon = '<i class="fa-solid fa-toggle-off"></i>';
                            $title = Yii::t('yii', 'Desactivar');
                            $confirmMessage = Yii::t('app', '¿Está seguro que desea desactivar este ítem?');
                        } else {
                            $url = ['toggle-status', 'id_clasif_accid_lab_ope_amb' => $model->id_clasif_accid_lab_ope_amb];
                            $icon = '<i class="fa-solid fa-toggle-on"></i>';
                            $title = Yii::t('yii', 'Activar');
                            $confirmMessage = Yii::t('app', '¿Está seguro que desea activar este ítem?');
                        }
                        $link = Html::a($icon, $url, [
                            'title' => $title,
                            'aria-label' => $title,
                            'data-pjax' => '0',
                            'class' => 'mx-0',
                            'data' => [
                                'confirm' => $confirmMessage,
                                'method' => 'post',
                            ],
                        ]);
                        return (\Yii::$app->user->can('clasificacionaccidente/delete') || \Yii::$app->user->can('admin')) ? $link : '';
                    },
                ],
            ],

            // [
            //     'class' => ActionColumn::className(),
            //     'urlCreator' => function ($action, ClasificacionAccidente $model, $key, $index, $column) {
            //         return Url::toRoute([$action, 'id_clasif_accid_lab_ope_amb' => $model->id_clasif_accid_lab_ope_amb]);
            //      }
            // ],
        ],
    ]); ?>


</div>
