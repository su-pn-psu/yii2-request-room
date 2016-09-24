<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel suPnPsu\reserveRoom\models\RoomReserveSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Room Reserves');
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class='box box-info'>
        <div class='box-header'>
            <h3 class='box-title'><?= Html::encode($this->title) ?></h3>
        </div><!--box-header -->

        <div class='box-body pad'>
            <div class="room-reserve-index">
            
            <!--<h1><?= Html::encode($this->title) ?></h1>-->
                                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                        <p>
                <?= Html::a(Yii::t('app', 'Create Room Reserve'), ['create'], ['class' => 'btn btn-success']) ?>
            </p>
            <?php Pjax::begin(); ?>                            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
        'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                            'id',
            'room_id',
            'subject',
            'date_start',
            'date_end',
            // 'time_start',
            // 'time_end',
            // 'status',
            // 'user_id',
            // 'staff_id',
            // 'staff_at',
            // 'note',
            // 'created_at',
            // 'created_by',
            // 'updated_at',
            // 'updated_by',

                ['class' => 'yii\grid\ActionColumn'],
                ],
                ]); ?>
                        <?php Pjax::end(); ?>        </div>
    </div><!--box-body pad-->
</div><!--box box-info-->
