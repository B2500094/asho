<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\Yii::$app->session->setFlash('success', 'Se ha eliminado exitosamente.');View $this */
/** @var app\models\Cargo $model */

$this->title = 'Crear Cargo';

?>
<div class="cargo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    <!-- BOTON DE VOLVER-->
    <?= Html::button('Atrás', ['class' => 'my-custom-button', 'onclick' => 'location.href=\''.Url::toRoute(["index"]).'\'']) ?>
    

</div>
