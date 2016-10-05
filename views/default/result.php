<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\widgets\DateTimePicker;
use suPnPsu\reserveRoom\models\RoomReserve;

/* @var $this yii\web\View */
/* @var $searchModel suPnPsu\reserveRoom\models\RoomReserveSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'รายการขอใช้ทั้งหมด');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class='box'>

    <div class='box-body'>

        <?php //echo $this->render('_search', ['model' => $searchModel]);  ?>

        <?php Pjax::begin(); ?>                            
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                // 'id',
                //'room_id',
                [
                    'attribute' => 'room_id',
                    //    'format'=>'html',
                    //'filter' => RoomReserve::getItemStatus(),
                    'value' => 'room.title'
                ],
                'subject',
                    [
                    'attribute' => 'date_range',
                    'format' => 'html',
                    'filter' => DateTimePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'date_range',
                        'type' => DateTimePicker::TYPE_INPUT,
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd hh:ii'
                        ]
                    ]),
                    'value' => 'dateRange'
                ],
                    [
                    'attribute' => 'status',
                    'format' => 'html',
                    'filter' => RoomReserve::getItemStatus(),
                    'value' => 'statusLabel'
                ],
                    [
                    'content' => function($model) {
                        return Html::a('ตรวจสอบ', ['view', 'id' => $model->id], ['class' => 'btn btn-primary']);
                    }
                ],
            //['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
        ?>
        <?php Pjax::end(); ?>        

    </div><!--box-body pad-->
</div><!--box box-info-->
