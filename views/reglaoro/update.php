<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ReglaOro $model */

$this->title = 'Editar Regla Oro: ' . $model->descripcion;
$this->params['breadcrumbs'][] = ['label' => 'Regla de Oro', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->descripcion, 'url' => ['view', 'id_regla_oro' => $model->id_regla_oro]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="regla-oro-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
