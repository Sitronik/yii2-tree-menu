<?php

namespace sitronik\treemenu;

use yii\web\AssetBundle;

class TreeMenuAsset extends AssetBundle
{
    public $sourcePath = '@vendor/sitronik/yii2-tree-menu/assets';
    public $css = [
        'css/tree-menu.css',
    ];

    /*public $js = [

    ];*/

    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\widgets\ActiveFormAsset',
        'yii\validators\ValidationAsset',
    ];

}