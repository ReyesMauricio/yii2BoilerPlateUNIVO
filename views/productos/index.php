<?php
Yii::$app->language = 'es_ES';
use app\models\TblProductos;
use app\models\TblCategorias;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;

/** @var yii\web\View $this */
/** @var app\models\ProductosSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Tbl Productos';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">
        <div class="tbl-productos-index">
            <h1><?php //= Html::encode($this->title) ?></h1>
            <?php //echo $this->render('_search', ['model' => $searchModel]); 
            ?>

            <?php
            $gridColumns = [
                [
                    'class' => 'kartik\grid\SerialColumn',
                    'contentOptions' => ['class' => 'kartik-sheet-style'],
                    'width' => '36px',
                    'header' => '#',
                    'headerOptions' => ['class' => 'kartik-sheet-style']
                ],
                [
                    'class' => 'kartik\grid\DataColumn',
                    'width' => '80px',
                    'format' => 'raw',
                    'vAlign' => 'middle',
                    'hAlign' => 'center',
                    'attribute' => 'Codigo',
                    'value' => function ($model, $key, $index, $widget) {
                        return Html::tag('span', $model->id_producto, ['class' => 'badge bg-purple']);
                    },
                    'filter' => false,
                ],
                [
                    'class' => 'kartik\grid\DataColumn',
                    'attribute' => 'nombre',
                    'vAlign' => 'middle',
                    'format' => 'html',
                    'value' => function ($model, $key, $index, $widget) {
                        return Html::a($model->nombre,  ['view', 'id_producto' => $model->id_producto]);
                    },
                    'filterType' => GridView::FILTER_SELECT2,
                    'filter' => ArrayHelper::map(TblProductos::find()->orderBy('nombre')->all(), 'nombre', 'nombre'),
                    'filterWidgetOptions' => [
                        'options' => ['placeholder' => 'Todos...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ],
                ],
                [
                    'class' => 'kartik\grid\DataColumn',
                    'attribute' => 'id_categoria',
                    'vAlign' => 'middle',
                    'format' => 'html',
                    'value' => function ($model, $key, $index, $widget) {
                        return Html::a($model->categoria->nombre,  ['view', 'id_categoria' => $model->id_categoria]);
                    },
                    'filterType' => GridView::FILTER_SELECT2,
                    'filter' => ArrayHelper::map(TblCategorias::find()->orderBy('nombre')->all(), 'id_categoria', 'nombre'),
                    'filterWidgetOptions' => [
                        'options' => ['placeholder' => 'Todos...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ],
                ],
                [
                    'class' => 'kartik\grid\DataColumn',
                    'attribute' => 'fecha_ing',
                    'headerOptions' => ['class' => 'kv-sticky-column'],
                    'contentOptions' => ['class' => 'kv-sticky-column'],
                    'vAlign' => 'middle',
                    'hAlign' => 'right',
                    'width' => '250px',
                    'filterType' => GridView::FILTER_DATE,
                    'filterWidgetOptions' => ([
                        'model' => $dataProvider,
                        'attribute' => 'fecha_ing',
                        'convertFormat' => true,
                        'pluginOptions' => [
                            'format' => 'yyyy-M-dd',
                            'autoWidget' => true,
                            'autoclose' => true,
                            'todayHighlight' => true,
                        ],
                    ]),
                ],
                [
                    'class' => 'kartik\grid\DataColumn',
                    'attribute' => 'fecha_mod',
                    'headerOptions' => ['class' => 'kv-sticky-column'],
                    'contentOptions' => ['class' => 'kv-sticky-column'],
                    'vAlign' => 'middle',
                    'hAlign' => 'right',
                    'width' => '250px',
                    'filterType' => GridView::FILTER_DATE,
                    'filterWidgetOptions' => ([
                        'model' => $dataProvider,
                        'attribute' => 'fecha_mod',
                        'convertFormat' => true,
                        'pluginOptions' => [
                            'format' => 'yyyy-M-dd',
                            'autoWidget' => true,
                            'autoclose' => true,
                            'todayHighlight' => true,
                        ],
                    ]),
                ],
                [
                    'class' => 'kartik\grid\BooleanColumn',
                    'trueLabel' => 'Si',
                    'falseLabel' => 'No',
                    'attribute' => 'estado',
                    'width' => '120px',
                    'filterType' => GridView::FILTER_SELECT2,
                    'filterWidgetOptions' => [
                        'options' => ['placeholder' => 'Todos...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ],
                    'vAlign' => 'middle',
                ],
                [
                    'class' => 'kartik\grid\ActionColumn',
                    'header' => 'Acciones',
                    'urlCreator' => function ($action, TblProductos $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id_producto' => $model->id_producto]);
                    }
                ],
            ];

            $exportmenu = ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumns,
                'exportConfig' => [
                    ExportMenu::FORMAT_TEXT => false,
                    ExportMenu::FORMAT_HTML => false,
                    ExportMenu::FORMAT_CSV => false,
                ],
            ]);

            echo GridView::widget([
                'id' => 'kv-productos',
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => $gridColumns,
                'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
                'headerRowOptions' => ['class' => 'kartik-sheet-style'],
                'filterRowOptions' => ['class' => 'kartik-sheet-style'],
                'pjax' => true, // pjax is set to always true for this demo
                // set your toolbar
                'toolbar' =>  [
                    [
                        'content' =>
                        Html::a('<i class="fas fa-plus"></i> Agregar', ['create'], [
                            'class' => 'btn btn-success',
                            'data-pjax' => 0,
                        ]) . ' ' .
                            Html::a('<i class="fas fa-redo"></i>', ['index'], [
                                'class' => 'btn btn-outline-success',
                                'data-pjax' => 0,
                            ]),
                        'options' => ['class' => 'btn-group mr-2']
                    ],
                    $exportmenu,
                    '{toggleData}',
                ],
                'toggleDataContainer' => ['class' => 'btn-group mr-2'],
                // set export properties
                // parameters from the demo form
                'bordered' => true,
                'striped' => true,
                'condensed' => true,
                'responsive' => true,
                'hover' => true,
                //'showPageSummary'=>$pageSummary,
                'panel' => [
                    'type' => 'dark',
                    'heading' => 'Listado de Productos',
                ],
                'persistResize' => false,
            ]);
            ?>
        </div>
    </div>
</div>

