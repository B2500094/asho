<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\Estatus $model */

$this->title = $model->descripcion;

\yii\web\YiiAsset::register($this);
?>
<div class="estatus-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id_estatus' => $model->id_estatus], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id_estatus' => $model->id_estatus], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id_estatus',
            'siglas',
            'descripcion',
            //'created_at',
            //'updated_at',
        ],
    ]) ?>

     <!-- BOTON DE VOLVER-->
     <?= Html::button('Atrás', ['class' => 'my-custom-button', 'onclick' => 'location.href=\''.Url::toRoute(["index"]).'\'']) ?>
    

</div>
