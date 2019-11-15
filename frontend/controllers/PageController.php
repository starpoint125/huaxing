<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2016-04-02 22:48
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Article;
use yii\web\NotFoundHttpException;

class PageController extends Controller
{

    /**
     * 单页
     *
     * @param string $name
     * @return string
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionView($name = '',$id)
    {
        if ($name == '') {
            $name = Yii::$app->getRequest()->getPathInfo();
        }
        $menus = [];
        if(isset($id) && !empty($id) && $id==2){
            $menus = Article::find()->where(['type' => Article::SINGLE_PAGE,'id'=>[50,51,53,65]])->all();
        }elseif(isset($id) && !empty($id) && $id==3){
            $menus = Article::find()->where(['type' => Article::SINGLE_PAGE,'id'=>[55,56,57,58,59]])->all();
        }else{
            $menus = Article::find()->where(['type' => Article::SINGLE_PAGE,'id'=>[27,24,26,23]])->all();

        }

        if ($id == 2){
            $name = $name == 'about' ? "jnzs":$name;
            if ($name == 'about'){
                $model = Article::findOne(['type' => Article::SINGLE_PAGE, 'sub_title' => $name,'id'=>50]);
            }else{
                $model = Article::findOne(['type' => Article::SINGLE_PAGE, 'sub_title' => $name]);
            }
        }elseif ($id == 3){
            $name = $name == 'about' ? "xmbj":$name;
            if ($name == 'about') {
                $model = Article::findOne(['type' => Article::SINGLE_PAGE, 'sub_title' => $name, 'id' => 55]);
            }else{
                $model = Article::findOne(['type' => Article::SINGLE_PAGE, 'sub_title' => $name]);
            }
        }else{
            $model = Article::findOne(['type' => Article::SINGLE_PAGE, 'sub_title' => $name]);
        }
        if (empty($model)) {
            throw new NotFoundHttpException('None page named ' . $name);
        }
        $template = "view";
        isset($model->category) && $model->category->template != "" && $template = $model->category->template;
        $model->template != "" && $template = $model->template;
        return $this->render($template, [
            'model' => $model,
            'menus' => $menus,
            'id' => $id,
        ]);
    }

}
