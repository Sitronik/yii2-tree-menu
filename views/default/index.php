<?php
use yii\helpers\Html;
$this->title = 'Manage Treemenu';
$this->params['breadcrumbs'][] = 'Treemenu';
?>

<h1><?= Html::encode($this->title) ?></h1>

<?php
echo sitronik\treemenu\Tree::widget(['isAdmin' => true]);
?>
