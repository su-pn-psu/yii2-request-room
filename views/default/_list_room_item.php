<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<article class="item" data-key="<?= $model->id; ?>">
    <h2 class="title">
    <?= Html::a(Html::encode($model->title), Url::toRoute(['post/show', 'id' => $model->id]), ['title' => $model->title]) ?>
    </h2>

    <div class="item-excerpt">
    <?= Html::encode($model->title); ?>
    </div>
    
</article>