<?php

use yii\bootstrap\Html;
use mdm\admin\components\Helper;
use yii\helpers\Url;

$module = $this->context->module->id;

$this->beginContent('@app/views/layouts/main.php'); 
?>

<div class="row">
    <div class="col-md-3 hidden-print">


        <?php if (Yii::$app->user->can('user')): ?>
            <div class="panel panel-default sidebar-menu">

                <div class="panel-heading">
                    <h3 class="panel-title">ระบบขอใช้ห้อง</h3>
                    
                </div>

                <div class="panel-body">  
                    <p><a href="<?=Url::to(["/{$module}/default/create"])?>" class="btn btn-success btn-block"><i class="fa fa-plus"></i> ขอใช้ห้อง</a></p>

                    <?php
                    $menuItems = [
                            [
                            'label' => Html::icon('inbox') . ' ' . Yii::t('app', 'รายการใช้ห้อง'),
                            'url' => ["/{$module}/default/index"], #2
                        ],
                            [
                            'label' => Html::icon('inbox') . ' ' . Yii::t('app', 'ร่างแบบฟอร์ม'),
                            'url' => ["/{$module}/default/draft"], #0
                        ],
                            [
                            'label' => Html::icon('export') . ' ' . Yii::t('app', 'ยืนเสนอ'),
                            'url' => ["/{$module}/default/offer"], #1
                        ],
                            [
                            'label' => Html::icon('import') . ' ' . Yii::t('app', 'ผลการพิจารณา'),
                            'url' => ["/{$module}/default/result"], #2-3
                        ],                           
                        [
                            'label' => Html::icon('duplicate') . ' ' . Yii::t('app', 'รายการที่คืนห้องแล้ว'),
                            'url' => ["/{$module}/default/returned"], #4
                        ],
                    ];

                    $menuItems = Helper::filter($menuItems);
                    $menuItems = suPnPsu\reserveRoom\components\FrontendNavigate::genCount($menuItems);
                    //$nav = new Navigate();
                    echo dmstr\widgets\Menu::widget([
                        'options' => ['class' => 'nav nav-pills nav-stacked'],
                        'encodeLabels' => false,
                        //'linkTemplate' =>'<a href="{url}">{icon} {label} {badge}</a>',
                        'items' => $menuItems,
                    ])
                    ?>
                </div>
            </div>



        <?php endif; ?>

    </div>
    <!-- /.col -->


    <div class="col-md-9">        
        
        <?= $content ?>
        <!-- /. box -->
    </div>
    <!-- /.col -->


</div>


<?php $this->endContent(); ?>