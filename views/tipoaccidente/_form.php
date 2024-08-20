<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Estatus;

/** @var yii\web\View $this */
/** @var app\models\TipoAccidente $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tipo-accidente-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_sub2_tipo_accid')->textInput() ?>

    <?= $form->field($model, 'id_sub_tipo_accid')->textInput() ?>

    <?= $form->field($model, 'id_tipo_accid1')->textInput() ?>

    <?= $form->field($model, 'id_tipo_accid')->textInput() ?>

    <?= $form->field($model, 'descripcion')->textInput() ?>

    <?= $form->field($model, 'codigo')->textInput() ?>

    <?= $form->field($model, 'id_estatus')->dropDownList(
    ArrayHelper::map(Estatus::find()->all(),'id_estatus','descripcion'),
    ['prompt'=> 'seleccionar status']);?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
