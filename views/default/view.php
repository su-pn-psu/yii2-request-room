<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model suPnPsu\reserveRoom\models\RoomReserve */

$this->title = $model->subject;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Room Reserves'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$user = $model->user;
?>
<div class='box'>
    <div class='box-body'>
        <div class="row">
            <div class="col-md-12">
                <?=$this->render('_viewPaper',['model'=>$model]);?>


                <?php if ($model->status == 0 && $model->user_id == Yii::$app->user->id): ?>
                    <p>
                        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                        <?=
                        Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                'method' => 'post',
                            ],
                        ])
                        ?>
                    </p>

                <?php endif; ?>
                    
            </div>
        </div>
    </div><!--box-body pad-->
</div><!--box box-info-->
