<?php

use app\models\Permission;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\PermissionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Permisos';
?>
<div class="roles-index mb-4">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear Permisos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php /*var_dump(\app\models\AuthRbac::getRoles())*/ ?>

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
            'contentOptions' => ['class'=>'text-center align-middle'], // Cambia el tamaño de la columna
            ], 

            //'id_roles',
            //'descripcion',
            [   
                'attribute' => 'name',
                'label' => 'Nombre',
                'filterInputOptions' => [
                    'class' => 'form-control',
                    'placeholder' => 'Búsqueda',
                ],
                'contentOptions' => ['class'=>'align-middle'],
            ],
            [   
                'attribute' => 'description',
                'label' => 'Descripcion',
                'filterInputOptions' => [
                    'class' => 'form-control',
                    'placeholder' => 'Búsqueda',
                ],
                'contentOptions' => ['class'=>'align-middle'],
            ],
            //'guard_name',
            //'id_estatus',

            //'created_at',
            //'updated_at',
            [
                'class' => ActionColumn::className(),
                'template' => '{view}{update}{delete}',
                'contentOptions' => ['class'=>'text-center align-middle'],
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        $id = $model->name;
                        $url = ['view', 'id'=>$id];
                        $link = Html::a('<i class="fas fa-eye"></i>', $url, [
                            'title' => Yii::t('yii', 'View'),
                            'aria-label' => Yii::t('yii', 'View'),
                            'data-pjax' => '0',
                            'class' => 'me-1',
                        ]);
                        return $link;
                    },
                    'update' => function ($url, $model, $key) {
                        $id = $model->name;
                        $url = ['update', 'id'=>$id];
                        $link = Html::a('<i class="fas fa-pencil-alt"></i>', $url, [
                            'title' => Yii::t('yii', 'Update'),
                            'aria-label' => Yii::t('yii', 'Update'),
                            'data-pjax' => '0',
                            'class' => 'me-1',
                        ]);
                        return  $link;
                    },
                    'delete' => function ($url, $model, $key) {
                        $id = $model->name;
                        $url = ['delete', 'id'=>$id];
                        $link = Html::a('<i class="fas fa-trash-alt"></i>', $url, [
                            'title' => Yii::t('yii', 'Desactivar'),
                            'aria-label' => Yii::t('yii', 'Delete'),
                            'data-pjax' => '0',
                            'class' => 'me-1',
                            'data' => [
                                'confirm' => Yii::t('app', 'Está seguro que desea eliminar este ícono?'),
                                'method' => 'post',
                            ],
                        ]);
                        return $link;
                    },
                ],
            ],
        ],
    ]); ?>


</div>
