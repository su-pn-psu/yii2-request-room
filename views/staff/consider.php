<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use suPnPsu\reserveRoom\models\RoomReserve;

/* @var $this yii\web\View */
/* @var $model suPnPsu\reserveRoom\models\RoomReserve */

$this->title = $model->subject;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Room Reserves'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$user = Yii::$app->user->identity->profile;
?>
<div class='box'>
    <div class='box-body'>
        <div class="row">
            <div class="col-md-12">
                <?= $this->render('../default/_viewPaper', ['model' => $model]); ?>


                <?php if ($model->status == 1): ?>
                    <br />
                    <hr />
                    <div class="box box-widget">
                        <div class="box-header with-border">
                            <?= $user->widget ?>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <?php $form = ActiveForm::begin(); ?> 


                            <?= $form->field($model, 'confirmed_status')->radioList(RoomReserve::getItemStatusConsider()) ?>
                            <?= $form->field($model, 'confirmed_comment')->textarea(); ?>                

                            <div class="form-group">                    
                                <?= Html::submitButton(Yii::t('app', 'ยืนยัน'), ['class' => 'btn btn-success', 'name' => 'confirm']) ?>  
                                <?= Html::a(Yii::t('app', 'ยกเลิก'), ['index'], ['class' => 'btn btn-primary', 'name' => 'edit']) ?>
                            </div>
                            <?php ActiveForm::end(); ?>

                        </div>
                        <!-- /.box-body -->

                        <!-- /.box-footer -->
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div><!--box-body pad-->
</div><!--box box-info-->
