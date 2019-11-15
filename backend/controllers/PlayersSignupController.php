<?php

namespace backend\controllers;

use Yii;
use backend\models\search\PlayersSignupSearch;
use backend\models\PlayersSignup;
use backend\models\Product;
use backend\actions\CreateAction;
use backend\actions\UpdateAction;
use backend\actions\IndexAction;
use backend\actions\DeleteAction;
use backend\actions\SortAction;
use backend\actions\ViewAction;
use yii\helpers\Html;
use yii\helpers\Url;
/**
 * PlayersSignupController implements the CRUD actions for PlayersSignup model.
 */
class PlayersSignupController extends \yii\web\Controller
{
    /**
    * @auth
    * - item group=未分类 category=报名登记 description-get=列表 sort=000 method=get
    * - item group=未分类 category=报名登记 description-get=查看 sort=001 method=get  
    * - item group=未分类 category=报名登记 description=创建 sort-get=002 sort-post=003 method=get,post  
    * - item group=未分类 category=报名登记 description=修改 sort=004 sort-post=005 method=get,post  
    * - item group=未分类 category=报名登记 description-post=删除 sort=006 method=post  
    * - item group=未分类 category=报名登记 description-post=排序 sort=007 method=post  
    * @return array
    */
    public function actions()
    {
        return [
            'index' => [
                'class' => IndexAction::className(),
                'data' => function(){

                        $searchModel = new PlayersSignupSearch();
                        $dataProvider = $searchModel->search(yii::$app->getRequest()->getQueryParams());
                        return [
                            'dataProvider' => $dataProvider,
                            'searchModel' => $searchModel,
                        ];

                }
            ],
            'create' => [
                'class' => CreateAction::className(),
                'modelClass' => PlayersSignup::className(),
            ],
            'update' => [
                'class' => UpdateAction::className(),
                'modelClass' => PlayersSignup::className(),
            ],
            'delete' => [
                'class' => DeleteAction::className(),
                'modelClass' => PlayersSignup::className(),
            ],
            'sort' => [
                'class' => SortAction::className(),
                'modelClass' => PlayersSignup::className(),
            ],
            'view-layer' => [
                'class' => ViewAction::className(),
                'modelClass' => PlayersSignup::className(),
            ],
        ];
    }

    public function actionSelname(){
        $id = Yii::$app->request->get('id');
        $result = Product::find()->select(['money'])->where(['id'=>trim($id)])->one();
        echo $result['money']?$result['money']:'';exit;
    }
    /**
     * 自动计算出钱数
     * @return [type] [description]
     */
    public function actionAutomoey(){
        $id = Yii::$app->request->get('id');
        $result = \backend\models\PlayersPeriod::find()->select(['youhui'])->where(['id'=>trim($id)])->one();
        echo $result['youhui']?$result['youhui']:'';exit;
    }
    /**
     * 激费记录
     * @return [type] [description]
     */
    public function actionJifei(){
        $id = Yii::$app->request->get('id');
        $this->redirect(['/players-money/index','id'=>$id]);
    }
}
