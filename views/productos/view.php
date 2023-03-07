<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\TblProductos $model */

$this->title = $model->id_producto;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>


<div class="row">
    <div class="col-md-12">
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title"><?= $model->nombre ?></h3>
            </div>
            <div class="card-body">
                <table class="table table-sm table-striped table-hover table-bordered">
                <tr>
                        <td width="150px" rowspan="9">
                            <img src="<?= Yii::$app->request->hostInfo . $model->imagen ?>" width="150" />
                        </td>
                    </tr>
                    <tr>
                        <td width="16%"><b>Id:</b></td>
                        <td width="34%"><?= $model->id_producto ?></td>
                        <td width="16%"><b>Nombre:</b></td>
                        <td width="34%"> <?= $model->nombre ?></td>
                    </tr>
                    <tr>
                        <td><b>Fecha creacion:</b></td>
                        <td><?= date('d-m-Y H:m:i', strtotime($model->fecha_ing)) ?></td>
                        <td><b>Fecha modificacion:</b></td>
                        <td><?= date('d-m-Y H:m:i', strtotime($model->fecha_mod)) ?></td>
                    </tr>
                    <tr>
                        <td><b>Descripcion: </b></td>
                        <td colspan="3"><?= $model->descripcion ?></td>
                    </tr>
                    <tr>
                        <td><b>Visible: </b></td>
                        <td><span class="badge bg-<?= $model->estado == 1 ? "green" : "red"; ?>"><?= $model->estado == 1 ? "Visible" : "No Visible"; ?></span></td>
                        <td><b>Creado por: </b></td>
                        <td><?= $model->usuario->nombreCompleto ?></td>
                    </tr>

                    <tr>
                        <td><b>Categoria: </b></td>
                        <td><?= $model->categoria->nombre ?></td>
                        <td><b>Precio: </b></td>
                        <td><?= $model->precio ?></td>
                    </tr>

                </table>
            </div>
            <div class="card-footer">
                <?php echo Html::a('<i class="fa fa-edit"></i> Editar', ['update', 'id_producto' => $model->id_producto], ['class' => 'btn btn-primary', 'data-toggle' => 'tooltip', 'title' => 'Edit record']) ?>
                <?php echo Html::a('<i class="fa fa-undo"></i> Regresar', ['index'], ['class' => 'btn btn-warning', 'data-toggle' => 'tooltip', 'title' => 'Regresar']) ?>
                <?= Html::a('<i class="fa fa-trash"></i> Eliminar', ['delete', 'id_producto' => $model->id_producto], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Esta seguro de querer eliminar este registro?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>
