<?php

namespace sitronik\treemenu\controllers;

use Yii;
use yii\web\Controller;
use sitronik\treemenu\models\TreeMenu;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `treemenu` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionInsert($id) {
        $model = new TreeMenu();
        if($model->load(Yii::$app->request->post())) {
            if($model->parent == 0) {
                $model->parent = 1;
            } else {
                $model->parent = 0;
            }

            if($id == 'root') {
                $model->parent_id = 0;
            } else {
                $model->parent_id = $id;
            }

            if($model->save()) {
                $this->redirect(['index']);
            }

        }else {

            if($id != 'root') {
                $model = TreeMenu::findOne($id);
                $model->isNewRecord = true;
                $model->name = '';
                $model->url = '';
            } else {
                $model->parent = 0;
            }

            return $this->render('insert', [
                'model' => $model,
            ]);
        }

     }

    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {
            if($model->save()) {
                $this->redirect(['index']);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        TreeMenu::deleteAll(['parent_id' => $id]);
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = TreeMenu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
