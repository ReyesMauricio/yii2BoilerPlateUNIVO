<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TblProductos $model */

$this->title = 'Crear producto';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-productos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
