<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Estatus;

/** @var yii\web\View $this */
/** @var app\models\RegistroReglaOro $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="registro-regla-oro-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_nro_accidente')->checkbox() ?>

    <?= $form->field($model, 'id_opcion1')->checkbox() ?>

    <?= $form->field($model, 'id_opcion2')->checkbox() ?>

    <?= $form->field($model, 'id_opcion3')->checkbox() ?>

    <?= $form->field($model, 'id_opcion4')->checkbox() ?>

    <?= $form->field($model, 'id_opcion_5')->checkbox() ?>

    <!-- Este if es para que lo que está dentro de él unicamente aparezca en actualizar -->
    <?php if (!$model->isNewRecord): ?>
    <?= $form->field($model, 'id_estatus')->dropDownList(
        ArrayHelper::map(
            Estatus::find()
                ->where(['in', 'descripcion', ['ACTIVO', 'INACTIVO']])
                ->all(),
            'id_estatus',
            'descripcion'
        ),
        ['prompt' => 'seleccionar status']
    ); ?>
    <?php endif; ?>

   
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
