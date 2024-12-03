<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\RegistroSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="registro-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_registro') ?>

    <?= $form->field($model, 'id_estado') ?>

    <?= $form->field($model, 'fecha_hora') ?>

    <?= $form->field($model, 'lugar') ?>

    <?= $form->field($model, 'nro_accidente') ?>

    <?php // echo $form->field($model, 'cedula_supervisor_60min') ?>

    <?php // echo $form->field($model, 'observaciones_60min') ?>

    <?php // echo $form->field($model, 'autorizado_60m')->checkbox() ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'id_estatus_proceso') ?>

    <?php // echo $form->field($model, 'id_region') ?>

    <?php // echo $form->field($model, 'acciones_tomadas_60min') ?>

    <?php // echo $form->field($model, 'cedula_reporta') ?>

    <?php // echo $form->field($model, 'cedula_pers_accide') ?>

    <?php // echo $form->field($model, 'cedula_validad_60min') ?>

    <?php // echo $form->field($model, 'id_magnitud') ?>

    <?php // echo $form->field($model, 'id_tipo_accidente') ?>

    <?php // echo $form->field($model, 'id_tipo_trabajo') ?>

    <?php // echo $form->field($model, 'id_peligro_agente') ?>

    <?php // echo $form->field($model, 'id_sujeto_afectacion') ?>

    <?php // echo $form->field($model, 'id_afecta_bienes_perso') ?>

    <?php // echo $form->field($model, 'cedula_24horas') ?>

    <?php // echo $form->field($model, 'acciones_tomadas_24horas') ?>

    <?php // echo $form->field($model, 'observaciones_24horas') ?>

    <?php // echo $form->field($model, 'recomendaciones_24horas') ?>

    <?php // echo $form->field($model, 'autorizado_24horas')->checkbox() ?>

    <?php // echo $form->field($model, 'cedula_valid_24horas') ?>

    <?php // echo $form->field($model, 'descripcion_accidente_60min') ?>

    <?php // echo $form->field($model, 'id_gerencia') ?>

    <?php // echo $form->field($model, 'recomendaciones_60m') ?>

    <?php // echo $form->field($model, 'anno') ?>

    <?php // echo $form->field($model, 'correlativo') ?>

    <?php // echo $form->field($model, 'id_naturaliza_incidente') ?>

    <?php // echo $form->field($model, 'ocurrencia_hecho_60m') ?>

    <?php // echo $form->field($model, 'acciones_tomadas_24h') ?>

    <?php // echo $form->field($model, 'observaciones_24h') ?>

    <?php // echo $form->field($model, 'validado_por_24h') ?>

    <?php // echo $form->field($model, 'id_requerimiento_trabajo_24h') ?>

    <?php // echo $form->field($model, 'cumple_regla_oro')->checkbox() ?>

    <?php // echo $form->field($model, 'id_afec_per_categoria') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
