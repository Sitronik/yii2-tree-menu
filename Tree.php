<?php

namespace sitronik\treemenu;

use Yii;
use \yii\base\Widget;
use sitronik\treemenu\models\TreeMenu;
use yii\helpers\Html;

class Tree extends Widget
{
    public $isAdmin = false;

    public function init()
    {
        parent::init();
        $this->registerAssets();
    }

    public function run()
    {
        return $this->renderWidget();
    }

    public function registerAssets() {
        $view = $this->getView();
        TreeMenuAsset::register($view);
    }

    public $mainTemplate = <<< HTML
       <div class="container">
        <div class="col-md-3">
            <div class="well well-lg">
              {tree-menu}
             </div>
           </div>
           <div class="form-group">
           {button}
          </div>
       </div>    
HTML;


    public function renderTree() {
        $content = $this->getContent();
        if(empty($content)) {
            $out = 'Tree menu is empty. Please add root item. ';
            if(!$this->isAdmin)
                $out .= Html::tag('a', 'Manage Treemenu', ['href' => '/treemenu']);
            return $out;
        }

        return $this->recurseTree($content, 0);

    }

    public function recurseTree($content, $parent_id) {
        $out = '';
        if(isset($content[$parent_id])) {
            if($parent_id == 0) {
                $out .= Html::beginTag('ul', ['class' => 'nav nav-list']) . "\n";
            } else {
                $out .= Html::beginTag('ul', ['class' => 'nav nav-list tree']) . "\n";
            }

            $parents_count = count($content[$parent_id]);
            $count = 0;
            foreach ($content[$parent_id] as $a) {
                $count++;
                $url = Html::tag('a', $a->name, ['href' => $a->url]);
                if($this->isAdmin) {
                    $adminButtons = $this->adminButtons($a->id);
                   $url .= $adminButtons;
                } else {
                    $adminButtons = '';
                }

                if($a->parent == 1) {
                    $out .= '<li>'.Html::tag('label', $url, ['class' => 'tree-toggler nav-header']);
                } else {
                    $out .= '<li><span>' . Html::tag('a', $a->name, ['href' => $a->url]). $adminButtons. '</span></li>';
                }

                $out .= $this->recurseTree($content, $a->id);
                $out .= '</li>';

                if($a->parent_id == 0 && $parents_count != $count)
                    $out .= '<li class="nav-divider"></li>';
            }

          $out .= '</ul>';

        }

        return $out;
    }

    public function adminButtons($id) {
        $out = Html::tag('a', ' <span class="glyphicon glyphicon-plus"></span>', ['href' => '/treemenu/default/insert?id='.$id, 'title' => 'Insert']);
        $out .= Html::tag('a', ' <span class="glyphicon glyphicon-pencil"></span>', ['href' => '/treemenu/default/update?id='.$id, 'title' => 'Update']);
        $out .= Html::tag('a', ' <span class="glyphicon glyphicon-trash"></span>', ['href' => '/treemenu/default/delete?id='.$id, 'title' => 'Delete',
            'data' => [
            'confirm' => 'Are you sure you want to delete this item?',
            'method' => 'post',
            ],
        ]);
        return $out;
    }

    public function getContent() {
        $model = TreeMenu::find()->all();
        $arr = array();

        foreach ($model as $content) {
            $arr[$content->parent_id][$content->id] = $content;
        }

        return $arr;
    }

    public function renderButton() {
        if($this->isAdmin) {
            $button = '<a href="/treemenu/default/insert?id=root" class="btn btn-success" >Insert root item</a>';
        } else {
            $button = '';
        }

        return $button;
    }

    public function renderWidget()
    {


        $content = strtr(
            $this->mainTemplate, [
                '{tree-menu}' => $this->renderTree(),
                '{button}' =>  $this->renderButton()
             ]
        );
        return $content;
    }

}
