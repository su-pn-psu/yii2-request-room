<?php

namespace suPnPsu\reserveRoom;

/**
 * reserveRoom module definition class
 */
class Module extends \yii\base\Module
{
    
    
    public $uploadDir = '';
    public $uploadUrl = '';
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'suPnPsu\reserveRoom\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
