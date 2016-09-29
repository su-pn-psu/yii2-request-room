<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use suPnPsu\room\models\Room;
use yii\helpers\StringHelper;
?>
<div class="content">
    <div class="container">
        <section >

            <div class="row">
                <div class="col-sm-6">
                    <div class="heading">
                        <?= Html::tag('h3', 'ปฎิทินการใช้ห้อง', ['class' => '']) ?>                  
                    </div>


                    <?=
                    \yii2fullcalendar\yii2fullcalendar::widget(
                            [
                                //'events' => $events,                    
                                'ajaxEvents' => Url::toRoute(['/reserve-room/default/jsoncalendar']),
                                'options' => ['lang' => Yii::$app->language],
                                'header' => [
                                    'left' => 'prev,next today',
                                    'center' => 'title',
                                    'right' => 'month,basicWeek,basicDay'
                                ],
                                'clientOptions' => [
                                    'selectable' => false,
                                    'selectHelper' => false,
                                    'draggable' => false,
                                    'editable' => false,
                                    'timeFormat' => 'H(:mm)'
                                ],
                            ]
                    );
                    ?>

                </div>
                <div class="col-sm-6">
                    <div class="heading">
                        <?= Html::tag('h3', 'แผนการใช้ห้อง', ['class' => '']) ?>                  
                    </div>

                    <?php Pjax::begin(['enablePushState' => false]); ?> 
                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        //'filterModel' => $searchModel,
                        'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                            //'id',
                            //'code',
                            //'date_start:date',
                            [
                                'attribute' => 'date_range',
                                'format' => 'html',
                                //'filter' => RoomReserve::getItemStatus(),
                                'value' => 'dateRange',
                                //'options' => ['nowrap' => 'nowrap'],
                                'contentOptions' => ['nowrap' => 'nowrap']
                            ],
                                [
                                'attribute' => 'room_id',
                                //    'format'=>'html',
                                'filter' => Room::getList(),
                                'value' => 'room.title',
                                'contentOptions' => function ($model, $key, $index, $grid) {
                                    return [
                                        'style' => 'border-left:10px solid ' . $model->room->stylies->backgroundColor . ';'
                                    ];
//                                    return [
//                                        'style' => 'border:' . $model->room->stylies->borderColor . ';'
//                                        .'background-color:' . $model->room->stylies->backgroundColor . ';'
//                                        .'color:' . $model->room->stylies->textColor . ';'
//                                    ];
                                }
                            ],
                                [
                                'attribute' => 'subject',
                                'format'=>'html',
                                //'filter' => Room::getList(),
                                'value' => function($model) {
                                    return Html::a(StringHelper::truncate($model->subject, 25), '#');
                                }
                            ],
                                [
                                'attribute' => 'user_id',
                                //    'format'=>'html',
                                //'filter' => Room::getList(),
                                'value' => function($model) {
                                    return $model->user->profile->resultInfo->fullname;
                                }
                            ],
                        //'user_'
                        //'timeRange',
                        ],
                        'tableOptions' => ['class' => 'table table-striped'],
//                        'rowOptions' => function ($model, $key, $index, $grid) {                            
//                            return array('key' => $key, 'index' => $index, 'style'=>'background-color:'.$model->room->stylies->backgroundColor.';color:'.$model->room->stylies->textColor.';');
//                        },
                    ]);
                    ?>
                    <?php Pjax::end(); ?>  


                </div>


        </section>  
    </div>    
</div>    