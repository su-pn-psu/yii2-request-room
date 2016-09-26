<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use suPnPsu\reserveRoom\models\RoomReserve;

/* @var $this yii\web\View */
/* @var $searchModel suPnPsu\reserveRoom\models\RoomReserveSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'ระบบขอใช้ห้อง');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class='box box-info'>
    <div class='box-header'>
        <h3 class='box-title'><?= Html::encode($this->title) ?></h3>
    </div><!--box-header -->

    <div class='box-body pad'>
        <div class="room-reserve-index">

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
                    'date_start:date',
                    //'timeRange',
                        [
                        'attribute' => 'time_range',
                        //    'format'=>'html',
                        //'filter' => RoomReserve::getItemStatus(),
                        'value' => 'timeRange'
                    ],
                        [
                        'attribute' => 'status',
                        'format' => 'html',
                        'filter' => RoomReserve::getItemStatus(),
                        'value' => 'statusLabel'
                    ],
                    // 'time_start',
                    // 'time_end',
                    // 'status',
                    // 'user_id',
                    // 'confirmed_comment:ntext',
                    // 'confirmed_by',
                    // 'confirmed_at',
                    // 'returned_comment:ntext',
                    // 'returned_by',
                    // 'returned_at',
                    // 'note',
                    // 'created_at',
                    // 'created_by',
                    // 'updated_at',
                    // 'updated_by',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>
            <?php Pjax::end(); ?>        
        </div>
    </div><!--box-body pad-->
</div><!--box box-info-->
