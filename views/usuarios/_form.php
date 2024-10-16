<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Estatus;
use app\models\Gerencia;
use app\models\AuthRbac;

/** @var yii\web\View $this */
/** @var app\models\Usuarios $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="usuarios-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ci')->textInput(['placeholder'=>'V12345678']) ?>

    <?= $form->field($model, 'username')->textInput(['placeholder'=>'Ejemplo: A1234567']) ?>

    <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'escriba su contraseña']) ?>

    <?= $form->field($model, 'name', [
        'template' => "<div>{input}\n{error}</div>",
    ])->checkboxList(ArrayHelper::map(Yii::$app->authManager->getRoles(),'name','name'), [
        'itemOptions' => [
            'labelOptions' => ['class' => 'custom-control-label w-100 my-1'],
            'wrapperOptions' => ['class'=>'form-check'],
        ],
    ]) ?>

    <?= $form->field($model, 'id_estatus')->dropDownList(
    ArrayHelper::map(Estatus::find()->all(),'id_estatus','descripcion'),
    ['prompt'=> 'seleccionar status']);?>
  


    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    

</div>
