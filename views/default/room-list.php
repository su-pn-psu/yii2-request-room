<?php

use yii\widgets\ListView;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php /* Pjax::begin(['id' => 'form']); ?> 
  <?php $form = ActiveForm::begin([
  //'action' => ['create'],
  'options' => ['data-pjax' => true ],
  'method' => 'post',
  ]); ?>

  <?= $form->field($searchModel, 'date_start') ?>

  <?php ActiveForm::end(); ?>
  <?php Pjax::end(); */ ?> 


<?php

Pjax::begin([
    'id' => 'room-list',
    'enablePushState' => false,
]);
?> 
<?=

GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
        //'id',
        //'code',
        'title',
        'details',
            [
            'content' => function($model) {
                return Html::button('เลือกห้อง', ['value' => $model->id, 'class' => 'btn select_room', 'data-key' => json_encode($model->activities)]);
            }
        ],
    ],
    'tableOptions' => ['class' => 'table table-striped'],
]);
?>
<?php Pjax::end(); ?>   

<?php

$this->registerJs(" 
    
/*
$('#room-list').on('pjax:end', function() {
            //$.pjax.reload({container:'#room-list'});  //Reload GridView
            alert(11);
        });
          */  
");
/*
  if (isset($ajax)) {

  $(".btnAjaxUpdate").click(function(){
  $.get( "' . Yii::$app->urlManager->createUrl('/activity/default/update') . '",
  {
  "id":' . $model->id . ',
  },
  function(data){
  $("#modalForm").find("#modalContent").html(data);
  $("#modalForm").modal("show");
  // console.log(data);
  });
  $("#calendar").fullCalendar("unselect");

  return false;
  });
  ');
  }
 */
?>