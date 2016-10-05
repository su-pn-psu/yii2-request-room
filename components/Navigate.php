<?php

namespace suPnPsu\reserveRoom\components;

//use yii\base\Model;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * Description of navigate
 *
 * @author madone
 */
class Navigate extends \firdows\menu\models\Navigate {       

    public function getCount($router) {
        $count = '';      
        $module = Url::base().'/'.Yii::$app->controller->module->id;

        switch ($router) {            

            case "{$module}":
                $searchModel = new \suPnPsu\reserveRoom\models\RoomReserveDefaultIndexSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $count = $dataProvider->getTotalCount();
                //$count = $count ? Html::tag('b',  ' ('.$count.')',['class'=>'text-default']) : '';
                $count = $count ? Html::tag('span',  $count,['class'=>'badge pull-right']) : '';
                break;
        }
        
        return $count;
    }

}
