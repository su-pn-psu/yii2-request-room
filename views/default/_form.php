<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use kartik\widgets\DatePicker;
use kartik\widgets\TimePicker;

/* @var $this yii\web\View */
/* @var $model suPnPsu\reserveRoom\models\RoomReserve */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-md-12">


        <div class="row">
            <div class="col-md-12 text-center">
                <?php
                echo Html::img(['/uploads/images/PSU.png'], ['width' => '75px']);
                ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-10 text-center col-sm-offset-1">
                <h3>แบบฟอร์มการขอยืมใช้ห้องประชุม</h3>
                <h4>องค์การบริหาร องค์การนักศึกษา มหาวิทยาลัยสงขลานครินทร์ วิทยาเขตปัตตานี</h4>
            </div>
        </div>


        <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>        

        <div class="row">
            <div class="col-md-6">
                <?=
                $form->field($model, 'date_start')->widget(DatePicker::className(), [
                    'options' => ['placeholder' => 'กรุณาเลือกวัน'],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'todayHighlight' => true,
                        'format'=>'yyyy-mm-dd'
                    ]
                ])
                ?>
            </div>
            <div class="col-md-3">
                <?=
                $form->field($model, 'time_start')->widget(TimePicker::className(), [
                    'pluginOptions' => [
                        'autoclose' => true,
                        'showMeridian' => false,
                    ]
                ])
                ?>
            </div>
            <div class="col-md-3">
                <?=
                $form->field($model, 'time_end')->widget(TimePicker::className(), [
                    'pluginOptions' => [
                        'autoclose' => true,
                        'showMeridian' => false,
                    ]
                ])
                ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                <?= Html::button('+ เลือกห้อง', ['value' => Url::to(['/reserve-room/default/room-list']), 'title' => 'เลือกห้อง', 'class' => 'showModalButton btn btn-primary']); ?>
                </div>
                <?= $form->field($model, 'room_id')->textInput() ?>

                
            </div>
        </div>



        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

    <?php
    Modal::begin([
        'headerOptions' => ['id' => 'modalHeader'],
        'id' => 'modal',
        'size' => 'modal-lg',
        'clientOptions' => [
            'backdrop' => 'static', 
            //'keyboard' => FALSE
            ],
        'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">ปิด</a>',
    ]);
    echo "<div id='main-content'>" . Yii::$app->runAction('/reserve-room/default/room-list') . "</div>";
    Modal::end();
    ?>

    <?php
    $js = " 
       $(function(){
    
      $(document).on('click', '.showModalButton', function(){ 
      $('#modal').modal('show');
      $('#modalHeader').html('<h4>' + $(this).attr('title') + '</h4>');

//$('#new_country').on('pjax:end', function() {
            $.pjax.reload({container:'#room-list'});  //Reload GridView
        //});


      /*
        if ($('#modal').data('bs.modal').isShown) {
            //$('#modal').find('#modalContent').load($(this).attr('value'));
            $('#main-content').load($(this).val());            
            $('#modalHeader').html('<h4>' + $(this).attr('title') + '</h4>');
        } else {
            //if modal isn't open; open it and load content
            $('#modal').modal('show').find('#main-content').load($(this).val());
            document.getElementById('modalHeader').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
        }
        */
    });
    





        $('.select_room').click(function(e) { 
            var room_id = $(this).closest('tr').data('key'); 
            //alert(fID);
            $('input#roomreserve-room_id').val(room_id);
            $('#modal').modal('hide');

            /*
                $.get( 'view', { id: fID }, 
                function (data) { 
                    $('#activity-modal').find('.modal-body').html(data); 
                    $('.modal-body').html(data); 
                    $('.modal-title').html('เปิดดูข้อมูลสมาชิก'); 
                    $('#activity-modal').modal('show'); 
                }); 
                */
           });
            
        });
        ";

    $this->registerJs($js);
    