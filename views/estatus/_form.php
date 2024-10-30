<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Estatus $model */
/** @var yii\widgets\ActiveForm $form */
?>
    <!-- Aquí se asegura de mostrar los mensajes flash --> 
<div class="gerencia-form">
            <div
                class="gerencia-index">
                <?php if (Yii::$app->session->hasFlash('error')): ?>
                <div class="alert alert-danger"> 
                <?= Yii::$app->session->getFlash('error') ?> 
                </div> <?php endif; ?> 

                
            </div>
<div class="estatus-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'siglas')->textInput(['placeholder'=>'Escriba siglas de estatus']) ?>

    <?= $form->field($model, 'descripcion')->textInput(['placeholder'=>'Escriba nombre del estatus']) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
