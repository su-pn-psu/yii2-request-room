<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

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

                <?php $form = ActiveForm::begin(); ?> 
                <?= $form->field($model, 'id')->hiddenInput()->label(false); ?>

                <br />
                <div class="form-group">
                    <?= Html::a(Yii::t('app', 'แก้ไข'),['update','id'=>$model->id], ['class' => 'btn btn-primary', 'name' => 'edit']) ?>
                    <?= Html::submitButton(Yii::t('app', 'ยืนยัน'), ['class' => 'btn btn-success', 'name' => 'confirm']) ?>
                </div>
                <?php ActiveForm::end(); ?>


            </div>
        </div>
    </div><!--box-body pad-->
</div><!--box box-info-->
