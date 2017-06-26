<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Advert */

if(is_numeric($model->id)) {
    $this->title = 'Insert Item: ' . $model->name;
} else {
    $this->title = 'Insert Root Item: ' . $model->name;
}

$this->params['breadcrumbs'][] = ['label' => 'Treemenu', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Insert';
?>
<div class="advert-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
